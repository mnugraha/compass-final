<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Grade;
use Illuminate\Http\Request;

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
}