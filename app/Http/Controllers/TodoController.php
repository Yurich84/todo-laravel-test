<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TodoController extends Controller
{
    const REQUEST_SEARCH = 'search';
    const REQUEST_DATE = 'date';

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $data = Todo::query()
            ->filterBySearch($request)
            ->filterByDate($request)
            ->get();
        return view('todo.list', compact('data'));
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
