@extends('layouts.master')
@section('title')
    {{ $todo->title }}
@endsection

@section('content')
    <h1>{{ $todo->title }}</h1>
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
            <td>{{ $todo->title }}</td>
            <td>
                @if($todo->status == 0)
                    <span class="badge bg-danger">Open</span>
                @else 
                    <span class="badge bg-success">Done</span>
                @endif
            </td>
            <td>
                <a href="{{ route('todos.edit', ['todo' => $todo->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                <form method="POST" action="{{ route('todos.destroy', ['todo' => $todo->id]) }}" class="d-inline">
                    @method('DELETE')
                    @csrf 
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        </tbody>
    </table>
@endsection