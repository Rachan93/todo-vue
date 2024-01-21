<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $tasks = Auth::user()->tasks;

        return Inertia::render('Tasks/Index', [
            'tasks' => $tasks,
        ]);
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request)
    {
        $task = Task::make();
        $task->name = $request->validated()['name'];
        $task->description = $request->validated()['description'];
        $task->user_id = Auth::id();


        $task->save();

        return Inertia::render('Tasks/Index');
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function status(Task $task)
    {
        $task->update(['is_done' => !$task->is_done]);

        return Inertia::render('Tasks/Index');
    }
    

    /**
     * Remove the specified resource from storage.
     */
   /* public function delete(Task $task)
    {

        Gate::authorize('delete', $task);
        
        $task->delete();
        
        return redirect()->route('tasks.index');
    }*/
}
