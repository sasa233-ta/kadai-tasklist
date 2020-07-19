@extends('layouts.app')

@section('content')

<h1>タスク一覧</h1>
@if(count($tasks)>0)
<table class="table">
    <thead>
        <tr>
            <td>id</td>
            <td>タスク</td>
        </tr>
    </thead>
    <tbody>
    @foreach($tasks as $task)
        <tr>
            <td><a href="{{ route('tasks.show', ['task' => $task]) }}">{{$task->id}}</a></td>
            <td>{{$task->content}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endif

{{-- メッセージ作成ページへのリンク --}}
<a class="btn btn-primary" href="{{ route('tasks.create')}}">タスクの新規作成</a>

@endsection