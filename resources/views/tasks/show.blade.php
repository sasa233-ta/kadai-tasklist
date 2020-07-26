@extends('layouts.app')
@section('content')

<h1>id = {{ $task->id }} : detail page</h1>
<table class="table table-bordered">
    <tr>
        <th>id</th>
        <td>{{ $task->id }}</td>
    </tr>
    <tr>
        <th>status</th>
        <td>{{ $task->status }}</td>
    </tr>
    <tr>
        <th>task</th>
        <td>{{ $task->content }}</td>
    </tr>
</table>
<div class="row">
<a class="btn btn-primary" href="{{route('tasks.edit',[$task->id])}}">edit</a>
<form method="POST" action="{{ route('tasks.destroy',[$task->id]) }}" class="ml-3">
    @csrf
    <input class="btn btn-danger" type="submit" value="delete">
    <input type="hidden" name="_method" value="DELETE">
</form>
</div>
@endsection