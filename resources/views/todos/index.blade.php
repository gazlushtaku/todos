@extends('layouts.master')
@section('title', 'Todos')

@section('css')
<style>
svg {
    width: 20px;
}
</style>
@endsection

@section('content')
    <h1>Todos</h1>

    @if(Session::get('status'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ Session::get('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <a href="{{ route('todos.create') }}" class="btn btn-sm btn-primary my-4">Create new todo item</a>

    @if($todos->count())
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
        @foreach($todos as $todo) 
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
                <a href="{{ route('todos.show', ['todo' => $todo->id]) }}" class="btn btn-sm btn-warning">Show</a>
                <a href="{{ route('todos.edit', ['todo' => $todo->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                <form method="POST" action="{{ route('todos.destroy', ['todo' => $todo->id]) }}" class="d-inline">
                    @method('DELETE')
                    @csrf 
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
        </table>
        {{ $todos->links() }}
    @else 
        <p>Nothing to do yet!</p>
    @endif
@endsection