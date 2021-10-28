@extends('layouts.master')
@section('title', 'Create new todo item')

@section('content')
    <h1>Create new todo item</h1>

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

    <form method="POST" action="{{ route('todos.store') }}">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td><input type="text" name="title" placeholder="Title" value="{{ old('title') }}" class="form-control" /></td>
                <td>
                    <select name="status" class="form-control">
                        <option value="">Select status</option>
                        <option value="0" @if(old('status') == 0) selected @endif>Open</option>
                        <option value="1" @if(old('status') == 1) selected @endif>Done</option>
                    </select>
                </td>
                <td>
                    <button type="submit" class="btn btn-sm btn-primary">Create</button>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
@endsection