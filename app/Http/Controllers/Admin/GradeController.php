<?php

namespace App\Http\Controllers\Admin;

use App\Exports\GradesExport;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Exam;
use App\Models\Grade;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class GradeController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //geta ll exams
        $exams = Exam::with('peran', 'level')->get();

        return inertia('Admin/Grades/Index', [
            'exams' => $exams,
            'grades' => [],
        ]);
    }

    /**
     * filter
     *
     * @param  mixed $request
     * @return void
     */
    public function filter(Request $request)
    {
        $this->validate($request, [
            'exam_id' => 'required',
        ]);

        try {
            //geta ll exams
            $exams = Exam::with('peran', 'level')->get();

            //get exam
            $exam = Exam::with('peran', 'level')
                ->where('id', $request->exam_id)
                ->first();

            if ($exam) {

                //get grades / nilai
                $grades = Grade::when(request()->q, function ($grades) {
                    $grades = $grades->whereHas('user', function ($query) {
                        $query->where('name', 'like', '%' . request()->q . '%')
                            ->orWhere('id_user', 'like', '%' . request()->q . '%');
                    });
                })
                    ->with('user', 'exam.peran', 'exam.level', 'exam_session')
                    ->where('exam_id', $exam->id)
                    ->latest()
                    ->paginate(5);

                // append query string to pagination links
                $grades->appends([
                    'q' => request()->q,
                ]);

            } else {
                $grades = [];
            }

            return inertia('Admin/Grades/Index', [
                'exams' => $exams,
                'grades' => $grades,
            ]);
        } catch (\Throwable $th) {
            return back()->withErrors(['message' => 'Data tidak ditemukan.']);
        }

    }

    /**
     * export
     *
     * @param  mixed $request
     * @return void
     */
    public function export(Request $request)
    {
        //get exam
        $exam = Exam::with('peran', 'level')
            ->where('id', $request->exam_id)
            ->first();

        //get grades / nilai
        $grades = Grade::with('user', 'exam.peran', 'exam.level', 'exam_session')
            ->where('exam_id', $exam->id)
            ->get();

        return Excel::download(new GradesExport($grades), 'grade : ' . $exam->title . ' — ' . Carbon::now() . '.xlsx');
    }

    /**
     * show
     *
     * @return void
     */
    public function show($id)
    {
        //geta ll exams
        $grade = Grade::with('user', 'exam.peran', 'exam.level', 'exam_session', 'exam.questions')
            ->findOrFail($id);

        $all_questions = Answer::with('question')
            ->where('exam_id', $grade->exam->id)
            ->where('exam_session_id', $grade->exam_session_id)
            ->orderBy('question_order', 'ASC')
            ->paginate(5);

        return inertia('Admin/Grades/show', [
            'grade' => $grade,
            'all_questions' => $all_questions,
        ]);
    }
}