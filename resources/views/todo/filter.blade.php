<form action="{{ route('todos.index') }}" method="get">

    <div class="row mt-4 p-3">
        <div class="col-6 form-group">
            <input value="{{ request()->search }}" width="100%" type="text" name="search" placeholder="search" class="form-control">
        </div>
        <div class="col-6 form-group">
            <input value="{{ request()->date }}" id="datepicker" name="date" width="100%" placeholder="date"/>
        </div>
        <div class="col-6 form-group">
            <a href="{{route('todos.index')}}" class="btn btn-outline-primary" style="width: 100%">Reset</a>
        </div>
        <div class="col-6 form-group">
            <button class="btn btn-outline-primary" type="submit" style="width: 100%">Filter</button>
        </div>
    </div>


</form>
