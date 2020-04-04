@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $data->name }} <span style="float: right">{{ $data->date }}</span></div>

                <div class="card-body">
                    @include('layouts.alert')

                    <p>{{ $data->description }}</p>
                    <strong>{{ $data->status }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
