<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Models\Task;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function __construct()
    {
        // On applique le middleware HandlePrecognitiveRequests à la méthode store() uniquement.
        // Il permet de valider le formulaire de création de tâche en direct.
        $this->middleware(HandlePrecognitiveRequests::class)->only('store');
    }

   
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $tasks = Auth::user()->tasks()->latest()->get();

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
        $request->session()->flash('flash.banner', 'La tâche a bien été créée.');
        return redirect()->back();
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function status(Request $request, Task $task)
    {
         // On vérifie que l'utilisateur authentifié est bien le propriétaire de la tâche.
         $this->authorize('update', $task);
        
         $validated = $request->validate([
            'is_done' => ['required', 'boolean'],
        ]);

        $task->update($validated);

         // on génère un message en fonction de la valeur de la propriété is_done.
         $message = $validated['is_done'] ? 'La tâche a bien été marquée comme terminée.' : 'La tâche a bien été marquée comme non terminée.';

         // On affiche un message flash (notification toast) pour confirmer la mise à jour de la tâche.
         $request->session()->flash('flash.banner', $message);

        return redirect()->back();
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Task $task)
    {

          // On vérifie que l'utilisateur authentifié est bien le propriétaire de la tâche.
          $this->authorize('delete', $task); // pas besoin de spécifier taskpolicy parce que laravel le retrouve automatiquement si on le nomme correctement

          $task->delete();
  
          // On affiche un message flash (notification toast) pour confirmer la suppression de la tâche.
          session()->flash('flash.banner', 'La tâche a bien été supprimée.');
        
          return redirect()->back();
    }
}
