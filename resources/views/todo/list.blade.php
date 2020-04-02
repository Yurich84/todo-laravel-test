@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Todo List</div>

                <div class="card-body">
                    @include('layouts.alert')

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $todo)
                            <tr>
                                <th scope="row">{{$todo->id}}</th>
                                <td><a href="{{route('todos.show', ['todo' => $todo->id])}}">{{$todo->name}}</a></td>
                                <td>{{$todo->status}}</td>
                                <td>
                                    @if($todo->status === \App\Models\Todo::STATUS_NEW)
                                        <a href="{{route('todos.complete', ['todo' => $todo->id])}}" class="btn btn-outline-primary">Complete</a>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{route('todos.destroy', ['todo' => $todo->id])}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <br/><br/>
                    <a class="btn btn-outline-primary" href="{{route('todos.create')}}">Add New</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
