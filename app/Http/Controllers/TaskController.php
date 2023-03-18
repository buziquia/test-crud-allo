<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {

        $task = Task::all();
        return response()->json($task);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required|max:255',
            'create' => 'required',
            'finish' => 'required',
        ]);

        $task = Task::create($validatedData);

        return response()->json($task, 201);
    }

    public function show($id)
    {
        $task = Task::find($id);

        if ($task) {
            return response()->json($task);
        } else {
            return response()->json(['error' => 'Tarefa não encontrada'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['error' => 'Tarefa não encontrada'], 404);
        }

        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->create = $request->input('create');
        $task->finish = $request->input('finish');
        $task->save();

        return response()->json($task);
    }

    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Tarefa não encontrada.'
            ], 404);
        }

        $task->delete();

        return response()->json([
            'message' => 'Tarefa apagada.'
        ], 200);
    }
}
