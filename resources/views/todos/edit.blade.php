@extends('layouts.master')
@section('title')
    {{ $todo->title }}
@endsection

@section('content')
    <h1>Edit: "{{ $todo->title }}"</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(Session::get('status'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ Session::get('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    <form method="POST" action="{{ route('todos.update', ['todo' => $todo->id]) }}">
        @csrf
        @method('PUT')
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $todo->id }}</td>
                <td><input type="text" name="title" value="{{ $todo->title }}" class="form-control" /></td>
                <td>
                    <select name="status" class="form-control">
                        <option value="">Select status</option>
                        <option value="0" @if($todo->status == 0) selected @endif>Open</option>
                        <option value="1" @if($todo->status == 1) selected @endif>Done</option>
                    </select>
                </td>
                <td>
                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
@endsection