<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Task;
use App\User;
use Illuminate\Support\Facades\Facade;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの投稿の一覧を作成日時の降順で取得
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);
            // Welcomeビューでそれらを表示
            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
        }
        return view('tasks.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            $task = new Task;
        
            return view('tasks.create', [
                'task' => $task,
            ]);
        }else{
            return redirect('/');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // バリデーション
        $this->validate($request, [
            'status' => 'required|max:10', 
            'content' => 'required|max:255',
        ]);

        if (Auth::check()) {
            $task = new Task;
            $task->user_id = Auth::user()->id;
            $task->status = $request->status;
            $task->content = $request->content;
            $task->save();
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if (Auth::check()) {
            $user = Auth::user();
            $task = Task::findOrFail($id);
            if($task->user_id === $user->id){
                return view('tasks.show', [
                'task' => $task,
                ]);
            }
        }
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $task = Task::findOrFail($id);
            if($task->user_id === $user->id){    
                //
                return view('tasks.edit', [
                'task' => $task,
                ]);
            }
        }
        return redirect('/');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $task = Task::findOrFail($id);
            if($task->user_id === $user->id){
                //
                $request->validate([
                    'status' => 'required|max:10', 
                    'content' => 'required|max:255',
                ]);
                $task->user_id = $user->id;
                $task->status = $request->status;
                $task->content = $request->content;
                $task->save();
                return redirect('/');
            }        
        }
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $task = Task::findOrFail($id);
            if($task->user_id === $user->id){  
                $task->delete();
                return redirect('/');
            }
        }
        return redirect('/');
    }
}