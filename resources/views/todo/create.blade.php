@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Todo</div>

                <div class="card-body">
                    @include('layouts.alert')

                    <form action="{{ route('todos.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="todoName">Name</label>
                            <input value="{{ old('name') }}" id="todoName" width="100%" type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="todoFormControlTextarea">Description</label>
                            <textarea name="description"
                                      class="form-control @error('description') is-invalid @enderror" id="todoFormControlTextarea"
                                      rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="datepicker">Date of completing</label>
                            <input value="{{ old('todo_date') }}" id="datepicker" name="todo_date" width="100%" class="@error('todo_date') is-invalid @enderror"/>
                            @error('todo_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <br/>
                        <button class="btn btn-outline-primary" type="submit" style="width: 100%">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
