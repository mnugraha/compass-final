<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\ExamGroup;
use App\Models\Grade;
use App\Models\Question;
use Carbon\Carbon;
use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;


class ExamController extends Controller
{
    /**
     * confirmation
     *
     * @param  mixed $id
     * @return void
     */
    public function confirmation($id)
    {
        //get exam group
        $exam_group = ExamGroup::with('exam.peran', 'exam_session', 'exam.level', 'exam.questions', 'user')
            ->where('user_id', auth()->user()->id_user)
            ->where('id', $id)
            ->first();

        //get grade / nilai
        $grade = Grade::where('exam_id', $exam_group->exam->id)
            ->where('exam_session_id', $exam_group->exam_session->id)
            ->where('user_id', auth()->user()->id_user)
            ->first();

        //return with inertia
        return inertia('User/Exams/Confirmation', [
            'exam_group' => $exam_group,
            'grade' => $grade,
        ]);
    }

    /**
     * startExam
     *
     * @param  mixed $id
     * @return void
     */
    public function startExam($id)
    {
        //get exam group
        $exam_group = ExamGroup::with('exam.peran', 'exam_session', 'exam.level')
            ->where('user_id', auth()->user()->id_user)
            ->where('id', $id)
            ->first();

        //get grade / nilai
        $grade = Grade::where('exam_id', $exam_group->exam->id)
            ->where('exam_session_id', $exam_group->exam_session->id)
            ->where('user_id', auth()->user()->id_user)
            ->first();

        //update start time di table grades
        $grade->start_time = Carbon::now();
        $grade->update();

        //cek apakah questions / soal ujian di random
        if ($exam_group->exam->random_question == 'Y') {

            //get questions / soal ujian
            $questions = Question::where('exam_id', $exam_group->exam->id)->inRandomOrder()->get();
        } else {

            //get questions / soal ujian
            $questions = Question::where('exam_id', $exam_group->exam->id)->get();
        }

        //define pilihan jawaban default
        $question_order = 1;

        foreach ($questions as $question) {

            //buat array jawaban / answer
            $options = [1, 2];
            if (!empty($question->option_3)) {
                $options[] = 3;
            }

            if (!empty($question->option_4)) {
                $options[] = 4;
            }

            if (!empty($question->option_5)) {
                $options[] = 5;
            }

            //acak jawaban / answer
            if ($exam_group->exam->random_answer == 'Y') {
                shuffle($options);
            }

            //cek apakah sudah ada data jawaban
            $answer = Answer::where('user_id', auth()->user()->id_user)
                ->where('exam_id', $exam_group->exam->id)
                ->where('exam_session_id', $exam_group->exam_session->id)
                ->where('question_id', $question->id)
                ->first();

            //jika sudah ada jawaban / answer
            if ($answer) {

                //update urutan question / soal
                $answer->question_order = $question_order;
                $answer->update();
            } else {

                //buat jawaban default baru
                Answer::create([
                    'exam_id' => $exam_group->exam->id,
                    'exam_session_id' => $exam_group->exam_session->id,
                    'question_id' => $question->id,
                    'user_id' => auth()->user()->id_user,
                    'question_order' => $question_order,
                    'answer_order' => implode(",", $options),
                    'answer' => 0,
                    'is_correct' => 'N',
                ]);
            }
            $question_order++;
        }

        //redirect ke ujian halaman 1
        return redirect()->route('user.exams.show', [
            'id' => $exam_group->id,
            'page' => 1,
        ]);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @param  mixed $page
     * @return void
     */
    public function show($id, $page)
    {
        //get exam group
        $exam_group = ExamGroup::with('exam.peran', 'exam_session', 'exam.level', 'exam.questions')
            ->where('user_id', auth()->user()->id_user)
            ->where('id', $id)
            ->first();

        if (!$exam_group) {
            return redirect()->route('exam');
        }

        //get all questions
        $all_questions = Answer::with('question')
            ->where('user_id', auth()->user()->id_user)
            ->where('exam_id', $exam_group->exam->id)
            ->where('exam_session_id', $exam_group->exam_session_id)
            ->orderBy('question_order', 'ASC')
            ->get();

        //count all question answered
        $question_answered = Answer::with('question')
            ->where('user_id', auth()->user()->id_user)
            ->where('exam_id', $exam_group->exam->id)
            ->where('exam_session_id', $exam_group->exam_session_id)
            ->where('answer', '!=', 0)
            ->count();

        //get question active
        $question_active = Answer::with('question.exam')
            ->where('user_id', auth()->user()->id_user)
            ->where('exam_id', $exam_group->exam->id)
            ->where('exam_session_id', $exam_group->exam_session_id)
            ->where('question_order', $page)
            ->first();

        //explode atau pecah jawaban
        if ($question_active) {
            $answer_order = explode(",", $question_active->answer_order);
        } else {
            $answer_order = [];
        }

        //get duration
        $duration = Grade::where('exam_id', $exam_group->exam->id)
            ->where('exam_session_id', $exam_group->exam_session->id)
            ->where('user_id', auth()->user()->id_user)
            ->first();

        //cek apakah end_time punya value di table nilai
        if ($duration->end_time != null) {
            return redirect()->route('user.exams.resultExam', $exam_group->id);
        }

        //return with inertia
        return inertia('User/Exams/Show', [
            'id' => (int) $id,
            'page' => (int) $page,
            'exam_group' => $exam_group,
            'all_questions' => $all_questions,
            'question_answered' => $question_answered,
            'question_active' => $question_active,
            'answer_order' => $answer_order,
            'duration' => $duration,
        ]);
    }

    /**
     * updateDuration
     *
     * @param  mixed $request
     * @param  mixed $grade_id
     * @return void
     */
    public function updateDuration(Request $request, $grade_id)
    {
        try {
            $grade = Grade::find($grade_id);
            $grade->duration = $request->duration;
            $grade->update();

            return response()->json([
                'success' => true,
                'message' => 'Duration updated successfully.',
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * answerQuestion
     *
     * @param  mixed $request
     * @return void
     */
    public function answerQuestion(Request $request)
    {
        //update duration
        $grade = Grade::where('exam_id', $request->exam_id)
            ->where('exam_session_id', $request->exam_session_id)
            ->where('user_id', auth()->user()->id_user)
            ->first();

        $grade->duration = $request->duration;
        $grade->update();

        //get question
        $question = Question::find($request->question_id);

        //cek apakah jawaban sudah benar
        if ($question->answer == $request->answer) {

            //jawaban benar
            $result = 'Y';
        } else {

            //jawaban salah
            $result = 'N';
        }

        //get answer
        $answer = Answer::where('exam_id', $request->exam_id)
            ->where('exam_session_id', $request->exam_session_id)
            ->where('user_id', auth()->user()->id_user)
            ->where('question_id', $request->question_id)
            ->first();

        //update jawaban
        if ($answer) {
            $answer->answer = $request->answer;
            $answer->is_correct = $result;
            $answer->update();
        }

        return redirect()->back();
    }

    /**
     * endExam
     *
     * @param  mixed $request
     * @return void
     */
    public function endExam(Request $request)
    {
        //count jawaban benar
        $count_correct_answer = Answer::where('exam_id', $request->exam_id)
            ->where('exam_session_id', $request->exam_session_id)
            ->where('user_id', auth()->user()->id_user)
            ->where('is_correct', 'Y')
            ->count();

        //count jawaban tidak benar
        $count_incorrect_answer = Answer::where('exam_id', $request->exam_id)
            ->where('exam_session_id', $request->exam_session_id)
            ->where('user_id', auth()->user()->id_user)
            ->where('is_correct', 'N')
            ->count();

        //count jumlah soal
        $count_question = Question::where('exam_id', $request->exam_id)->count();

        //hitung nilai
        $grade_exam = round($count_correct_answer / $count_question * 100, 2);

        //update nilai di table grades
        $grade = Grade::where('exam_id', $request->exam_id)
            ->where('exam_session_id', $request->exam_session_id)
            ->where('user_id', auth()->user()->id_user)
            ->first();

        $grade->end_time = Carbon::now();
        $grade->total_correct = $count_correct_answer;
        $grade->total_incorrect = $count_incorrect_answer;
        $grade->grade = $grade_exam;
        $grade->update();

        //redirect hasil
        return redirect()->route('user.exams.resultExam', $request->exam_group_id);
    }

    /**
     * resultExam
     *
     * @param  mixed $exam_group_id
     * @return void
     */
    public function resultExam($exam_group_id)
    {
        //get exam group
        $exam_group = ExamGroup::with('exam.peran', 'exam_session', 'exam.level', 'user', 'exam.questions')
            ->where('user_id', auth()->user()->id_user)
            ->where('id', $exam_group_id)
            ->first();

        //get grade / nilai
        $grade = Grade::where('exam_id', $exam_group->exam->id)
            ->where('exam_session_id', $exam_group->exam_session->id)
            ->where('user_id', auth()->user()->id_user)
            ->first();

        //get all questions
        $all_questions = Answer::with('question')
            ->where('user_id', auth()->user()->id_user)
            ->where('exam_id', $exam_group->exam->id)
            ->where('exam_session_id', $exam_group->exam_session_id)
            ->orderBy('question_order', 'ASC')
            ->paginate(5);

        //return with inertia
        return inertia('User/Exams/Result', [
            'exam_group' => $exam_group,
            'grade' => $grade,
            'all_questions' => $all_questions,
        ]);
    }

    /**
     * generatePDF
     *
     * @param  mixed $id
     * @return void
     */
    public function generatePDF($id)
    {
        // get administration
        $data = Grade::findOrFail($id);
        $pdf = PDF::loadview('pdf.grade', ['data' => $data])->setPaper('a4', 'landscape');
        return $pdf->stream('Assessment-result');
        //return view('pdf.grade', ['data' => $data]);
    }
}
