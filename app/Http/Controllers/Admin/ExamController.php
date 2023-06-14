<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\QuestionsImport;
use App\Models\Exam;
use App\Models\Level;
use App\Models\Peran;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get exams
        $exams = Exam::when(request()->q, function ($exams) {
            $exams = $exams->where('title', 'like', '%' . request()->q . '%');
        })->with('questions', 'peran', 'level')->latest()->paginate(5);

        //append query string to pagination links
        $exams->appends(['q' => request()->q]);

        // render with inertia
        return inertia('Admin/Exams/Index', [
            'exams' => $exams,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // get peran
        $peran = Peran::all();

        // get level
        $level = Level::all();

        //render with inertia
        return inertia('Admin/Exams/Create', [
            'peran' => $peran,
            'level' => $level,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate request
        $request->validate([
            'title' => 'required',
            'level_id' => 'required|integer',
            'peran_id' => 'required|integer',
            'duration' => 'required|integer',
            'description' => 'required',
            'random_question' => 'required',
            'random_answer' => 'required',
            'show_answer' => 'required',
        ]);

        try {
            //create exam
            Exam::create([
                'title' => $request->title,
                'level_id' => $request->level_id,
                'peran_id' => $request->peran_id,
                'duration' => $request->duration,
                'description' => $request->description,
                'random_question' => $request->random_question,
                'random_answer' => $request->random_answer,
                'show_answer' => $request->show_answer,
            ]);

            //redirect
            return redirect()->route('admin.exams.index');

        } catch (\Throwable $th) {
            return back()->withErrors(['message' => 'Data gagal disimpan.']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get exam
        $exam = Exam::with('peran', 'level')->findOrFail($id);

        //get relation questions with pagination
        $exam->setRelation('questions', $exam->questions()
                ->when(request()->q, function ($exam) {
                    $exam->where('question', 'like', '%' . request()->q . '%');
                })
                ->paginate(10)
                ->appends(['q' => request()->q])
        );

        //render with inertia
        return inertia('Admin/Exams/Show', [
            'exam' => $exam,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get exam
        $exam = Exam::findOrFail($id);

        // get peran
        $peran = Peran::all();

        // get level
        $level = Level::all();

        //render with inertia
        return inertia('Admin/Exams/Edit', [
            'exam' => $exam,
            'peran' => $peran,
            'level' => $level,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        //validate request
        $request->validate([
            'title' => 'required',
            'level_id' => 'required|integer',
            'peran_id' => 'required|integer',
            'duration' => 'required|integer',
            'description' => 'required',
            'random_question' => 'required',
            'random_answer' => 'required',
            'show_answer' => 'required',
        ]);

        try {
            //update exam
            $exam->update([
                'title' => $request->title,
                'level_id' => $request->level_id,
                'peran_id' => $request->peran_id,
                'duration' => $request->duration,
                'description' => $request->description,
                'random_question' => $request->random_question,
                'random_answer' => $request->random_answer,
                'show_answer' => $request->show_answer,
            ]);

            //redirect
            return redirect()->route('admin.exams.index');

        } catch (\Throwable $th) {
            return back()->withErrors(['message' => 'Data gagal diperbarui.']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            //get exam
            $exam = Exam::findOrFail($id);

            //delete exam
            $exam->delete();

            //redirect
            return redirect()->route('admin.exams.index');

        } catch (\Throwable $th) {
            return back()->withErrors(['message' => 'Data gagal dihapus.']);
        }

    }

    /**
     * createQuestion
     *
     * @param  mixed $exam
     * @return void
     */
    public function createQuestion(Exam $exam)
    {
        //render with inertia
        return inertia('Admin/Questions/Create', [
            'exam' => $exam,
        ]);
    }

    /**
     * storeQuestion
     *
     * @param  mixed $request
     * @param  mixed $exam
     * @return void
     */
    public function storeQuestion(Request $request, Exam $exam)
    {
        //validate request
        $request->validate([
            'question_type' => 'required',
            'question' => $request->question_type === "text" ? 'required' : '',
            'question_file' => $request->question_type === "audio" ? 'required|mimes:mp3,wav|max:2048' : '',
            'option_1' => 'required',
            'option_2' => 'required',
            'option_3' => 'required',
            'option_4' => 'required',
            'option_5' => 'required',
            'answer' => 'required',
        ]);

        try {

            // upload audio
            $question_file = $request->file('question_file');
            if ($question_file) {
                $filename = date('YmdHis') . '_' . $question_file->getClientOriginalName();
                $question_file->storeAs('public/exams/question', $filename);
            }

            //create question
            Question::create([
                'exam_id' => $exam->id,
                'question_type' => $request->question_type,
                'question' => $request->question,
                'question_file' => $question_file ? date('YmdHis') . '_' . $question_file->getClientOriginalName() : null,
                'option_1' => $request->option_1,
                'option_2' => $request->option_2,
                'option_3' => $request->option_3,
                'option_4' => $request->option_4,
                'option_5' => $request->option_5,
                'answer' => $request->answer,

            ]);

            //redirect
            return redirect()->route('admin.exams.show', $exam->id);

        } catch (\Throwable $th) {
            return back()->withErrors(['message' => 'Data gagal disimpan.']);
        }

    }

    /**
     * editQuestion
     *
     * @param  mixed $exam
     * @param  mixed $question
     * @return void
     */
    public function editQuestion(Exam $exam, Question $question)
    {
        //render with inertia
        return inertia('Admin/Questions/Edit', [
            'exam' => $exam,
            'question' => $question,
        ]);
    }

    /**
     * updateQuestion
     *
     * @param  mixed $request
     * @param  mixed $exam
     * @param  mixed $question
     * @return void
     */
    public function updateQuestion(Request $request, Exam $exam, Question $question)
    {
        //validate request
        $request->validate([
            'question_type' => 'required',
            'question' => $request->question_type === "text" ? 'required' : '',
            'question_file' => $request->question_type === "audio" ? 'nullable|mimes:mp3,wav|max:2048' : '',
            'option_1' => 'required',
            'option_2' => 'required',
            'option_3' => 'required',
            'option_4' => 'required',
            'option_5' => 'required',
            'answer' => 'required',
        ]);

        try {

            // cek apakah upload soal
            if ($request->hasFile('question_file')) {

                // upload soal
                $question_file = $request->file('question_file');
                $filename = date('YmdHis') . '_' . $question_file->getClientOriginalName();
                $question_file->storeAs('public/exams/question', $filename);

                // delete old soal
                storage::delete('public/exams/question/' . $question->question_file);

                // save soal
                $question->question_file = $filename;
            }

            $question->question_type = $request->question_type;
            $question->question = $request->question;
            $question->option_1 = $request->option_1;
            $question->option_2 = $request->option_2;
            $question->option_3 = $request->option_3;
            $question->option_4 = $request->option_4;
            $question->option_5 = $request->option_5;
            $question->answer = $request->answer;

            //update question
            $question->save();

            //redirect
            return redirect()->route('admin.exams.show', $exam->id);

        } catch (\Throwable $th) {
            return back()->withErrors(['message' => 'Data gagal diperbarui.']);
        }

    }

    /**
     * destroyQuestion
     *
     * @param  mixed $exam
     * @param  mixed $question
     * @return void
     */
    public function destroyQuestion(Exam $exam, Question $question)
    {
        try {
            //delete question
            $question->delete();

            // delete file
            storage::delete('public/exams/question/' . $question->question_file);

            //redirect
            return redirect()->route('admin.exams.show', $exam->id);

        } catch (\Throwable $th) {
            return back()->withErrors(['message' => 'Data gagal dihapus.']);
        }
    }

    /**
     * import
     *
     * @param  mixed $exam
     * @return void
     */
    public function import(Exam $exam)
    {
        return inertia('Admin/Questions/Import', [
            'exam' => $exam,
        ]);
    }

    /**
     * storeImport
     *
     * @param  mixed $request
     * @param  mixed $exam
     * @return void
     */
    public function storeImport(Request $request, Exam $exam)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx',
        ]);

        try {
            $examId = $exam->id;

            // import data
            Excel::import(new QuestionsImport($examId), $request->file('file'));

            //redirect
            return redirect()->route('admin.exams.show', $examId);

        } catch (\Throwable $th) {
            return back()->withErrors(['message' => 'Data gagal di Import.']);
        }

    }

    /**
     * upload
     *
     * @param  mixed $request
     * @return void
     */
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg|max:1024', // Validasi file gambar
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = 'question_' . date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('fileSoal/');

            $image->move($destinationPath, $fileName);

            $url = asset('fileSoal/' . $fileName);

            return response()->json(['location' => $url], 200);
        }

        return response()->json(['message' => 'No image file uploaded.'], 400);
    }

}
