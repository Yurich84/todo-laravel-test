<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('todo.list', ['data' => Todo::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param TodoRequest $request
     * @return RedirectResponse
     */
    public function store(TodoRequest $request)
    {
        $fields = $request->validated();
        auth()->user()->todos()->create($fields);
        return redirect()->route('todos.index');
    }

    /**
     * Make complete item
     * @param Todo $todo
     * @return RedirectResponse
     */
    public function complete(Todo $todo)
    {
        $todo->status = Todo::STATUS_COMPLETED;
        $todo->save();
        return redirect()->route('todos.index');
    }

    /**
     * Display the specified resource.
     * @param Todo $todo
     * @return View
     */
    public function show(Todo $todo)
    {
        return view('todo.show', ['data' => $todo]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Todo $todo
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todos.index');
    }
}
