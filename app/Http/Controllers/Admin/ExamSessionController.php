<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamGroup;
use App\Models\ExamSession;
use App\Models\User;
use Illuminate\Http\Request;

class ExamSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get exam_sessions
        $exam_sessions = ExamSession::when(request()->q, function ($exam_sessions) {
            $exam_sessions = $exam_sessions->where('title', 'like', '%' . request()->q . '%');
        })->with('exam.peran', 'exam.level', 'exam_groups')->latest()->paginate(5);

        //append query string to pagination links
        $exam_sessions->appends(['q' => request()->q]);

        //render with inertia
        return inertia('Admin/ExamSessions/Index', [
            'exam_sessions' => $exam_sessions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get exams
        $exams = Exam::all();

        //render with inertia
        return inertia('Admin/ExamSessions/Create', [
            'exams' => $exams,
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
            'exam_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        try {
            //create exam_session
            ExamSession::create([
                'title' => $request->title,
                'exam_id' => $request->exam_id,
                'start_time' => date('Y-m-d H:i:s', strtotime($request->start_time)),
                'end_time' => date('Y-m-d H:i:s', strtotime($request->end_time)),
            ]);

            //redirect
            return redirect()->route('admin.exam_sessions.index');

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
        //get exam_session
        $exam_session = ExamSession::with('exam.peran', 'exam.level')->findOrFail($id);

        //get relation exam_groups with pagination
        $exam_session->setRelation('exam_groups', $exam_session->exam_groups()
                ->when(request()->q, function ($exam_session) {
                    $exam_session = $exam_session->whereHas('user', function ($query) {
                        $query->where('name', 'like', '%' . request()->q . '%')
                            ->OrWhere('id_user', 'like', '%' . request()->q . '%');
                    });
                })
                ->with('user.peran', 'user.level')
                ->paginate(10)
                ->appends(['q' => request()->q])
        );

        //render with inertia
        return inertia('Admin/ExamSessions/Show', [
            'exam_session' => $exam_session,
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
        //get exam_session
        $exam_session = ExamSession::findOrFail($id);

        //get exams
        $exams = Exam::all();

        //render with inertia
        return inertia('Admin/ExamSessions/Edit', [
            'exam_session' => $exam_session,
            'exams' => $exams,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExamSession $exam_session)
    {
        //validate request
        $request->validate([
            'title' => 'required',
            'exam_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        try {
            //update exam_session
            $exam_session->update([
                'title' => $request->title,
                'exam_id' => $request->exam_id,
                'start_time' => date('Y-m-d H:i:s', strtotime($request->start_time)),
                'end_time' => date('Y-m-d H:i:s', strtotime($request->end_time)),
            ]);

            //redirect
            return redirect()->route('admin.exam_sessions.index');

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
            //get exam_session
            $exam_session = ExamSession::findOrFail($id);

            //delete exam_session
            $exam_session->delete();

            //redirect
            return redirect()->route('admin.exam_sessions.index');

        } catch (\Throwable $th) {
            return back()->withErrors(['message' => 'Data gagal dihapus.']);
        }
    }

    /**
     * createEnrolle
     *
     * @param  mixed $exam_session
     * @return void
     */
    public function createEnrolle(ExamSession $exam_session)
    {
        //get exams
        $exam = $exam_session->exam;

        //get user already enrolled
        $users_enrolled = ExamGroup::where('exam_id', $exam->id)
            ->where('exam_session_id', $exam_session->id)
            ->pluck('user_id')
            ->all();

        //get user berdasarkan peran, level, dan tidak pernah mengikuti ujian yang sama
        $users = User::when(request()->q, function ($user) {
            $user = $user->where('name', 'like', '%' . request()->q . '%')
                ->OrWhere('id_user', 'like', '%' . request()->q . '%');
        })
            ->with('peran', 'level')
            ->where('function', $exam->peran_id)
            ->Where('level', $exam->level_id)
            ->whereNotIn('id_user', $users_enrolled)
            ->latest()->paginate(10);

        //append query string to pagination links
        $users->appends(['q' => request()->q]);

        //render with inertia
        return inertia('Admin/ExamGroups/Create', [
            'exam' => $exam,
            'exam_session' => $exam_session,
            'users' => $users,
        ]);
    }

    /**
     * storeEnrolle
     *
     * @param  mixed $request
     * @param  mixed $exam_session
     * @return void
     */
    public function storeEnrolle(Request $request, ExamSession $exam_session)
    {
        //validate request
        $request->validate([
            'user_id' => 'required',
        ]);

        try {

            //create exam_group
            foreach ($request->user_id as $user_id) {

                //select user
                $user = User::findOrFail($user_id);

                //create exam_group
                ExamGroup::create([
                    'exam_id' => $request->exam_id,
                    'exam_session_id' => $exam_session->id,
                    'user_id' => $user->id_user,
                ]);
            }

            //redirect
            return redirect()->route('admin.exam_sessions.show', $exam_session->id);

        } catch (\Throwable $th) {
            return back()->withErrors(['message' => 'Data gagal disimpan.']);
        }

    }

    public function destroyEnrolle(ExamSession $exam_session, ExamGroup $exam_group)
    {

        try {

            //delete exam_group
            $exam_group->delete();

            //redirect
            return redirect()->route('admin.exam_sessions.show', $exam_session->id);

        } catch (\Throwable $th) {
            return back()->withErrors(['message' => 'Data gagal dihapus.']);
        }

    }

}