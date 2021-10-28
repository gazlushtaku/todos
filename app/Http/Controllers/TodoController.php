<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($request->search) && !empty($request->search))
            $todos = Todo::where('title', 'like', '%'.$request->search.'%')
                         ->orderBy('status', 'asc')
                         ->paginate(2);
        else
            $todos = Todo::orderBy('status', 'asc')->paginate(2);

        return view('todos.index', [
            'todos' => $todos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:5|max:250',
            'status' => 'required|boolean'
        ]);

        $form_todo = $request->only(['title', 'status']);

        if(Todo::create($form_todo))
            return redirect()->route('todos.index')->with('status', 'Todo was created successfully.');
        else 
            return redirect()->route('todos.create')->with('status', 'Something want wrong while creating the todo item!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Todo::findOrFail($id);

        return view('todos.show', [
            'todo' => $todo
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
        $todo = Todo::findOrFail($id);

        return view('todos.edit', [
            'todo' => $todo
        ]);
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
        $request->validate([
            'title' => 'required|string|min:5|max:250',
            'status' => 'required|boolean'
        ]);

        $todo = Todo::findOrFail($id);
        $form_todo = $request->only(['title', 'status']);

        if($todo->update($form_todo))
            return back()->with('status', 'Todo was updated successfully.');
        else 
            return back()->with('status', 'Something want wrong while updating the todo item!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Todo::destroy($id))
            return redirect()->route('todos.index')->with('status', 'Todo was deleted successfully.');
        else 
            return redirect()->route('todos.index')->with('status', 'Something want wrong while deleting the todo item!');
    }
}
