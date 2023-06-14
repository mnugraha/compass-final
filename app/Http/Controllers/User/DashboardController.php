<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ExamGroup;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //get exam groups
        $exam_groups = ExamGroup::with('exam.peran', 'exam_session', 'exam.level')
            ->where('user_id', auth()->user()->id_user)
            ->get();
        //define variable array
        $data = [];

        //get nilai
        foreach ($exam_groups as $exam_group) {

            //get data nilai / grade
            $grade = Grade::where('exam_id', $exam_group->exam_id)
                ->where('exam_session_id', $exam_group->exam_session_id)
                ->where('user_id', auth()->user()->id_user)
                ->first();

            //jika nilai / grade kosong, maka buat baru
            if ($grade == null) {

                //create defaul grade
                $grade = new Grade();
                $grade->exam_id = $exam_group->exam_id;
                $grade->exam_session_id = $exam_group->exam_session_id;
                $grade->user_id = auth()->user()->id_user;
                $grade->duration = $exam_group->exam->duration * 60000;
                $grade->total_correct = 0;
                $grade->total_incorrect = 0;
                $grade->grade = 0;
                $grade->save();
            }

            $data[] = [
                'exam_group' => $exam_group,
                'grade' => $grade,
            ];

        };

        // create paginate (error karena withpath)
        $data2 = $this->paginate($data)->withPath('exam');

        //return with inertia
        return inertia('User/Dashboard/Index', [
            'exam_groups' => $data2,
        ]);

    }

    /**
     * paginate
     *
     * @param  mixed $items
     * @param  mixed $perPage
     * @param  mixed $page
     * @return void
     */
    public function paginate($items, $perPage = 5, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($items);
        $currentpage = $page;
        $offset = ($currentpage * $perPage) - $perPage;
        $itemstoshow = array_slice($items, $offset, $perPage);
        return new LengthAwarePaginator($itemstoshow, $total, $perPage);
    }

    // https: //medium.com/@sgandhi132/how-to-make-a-custom-pagination-from-an-array-in-laravel-c4f4409cce70

}