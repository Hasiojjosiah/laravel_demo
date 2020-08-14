<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo; 
use App\User;
use Auth;


class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::select('id','task','date','status')->where('user_id',Auth::user()->id)->latest()->get();
        return response()->json($todos);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'task' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $todo = new Todo;
        $todo->user_id = Auth::user()->id;
        $todo->task = $request->task;
        $todo->date = $request->date;
        $todo->save();  
        return response()->json($todo);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:todos,id',
            'task' => 'required|string|max:255',
            'date' => 'required|date',
        ]);
        $todo = Todo::find($request->id);
        $todo->task = $request->task;
        $todo->date = $request->date;
        $todo->update();  
        return response()->json($todo);
    }
    public function check($x)
    {
        $todo = Todo::find($x);
        $todo->status = !$todo->status;
        $todo->save();
        return response()->json($todo);
    }
    public function destroy($id)
    {
        $todo = Todo::find($id);
        $todo->delete();
        return response()->json($todo);
    }
}
