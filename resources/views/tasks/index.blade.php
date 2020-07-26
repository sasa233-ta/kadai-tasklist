@extends('layouts.app')

@section('content')

@if(Auth::check())
<div class="row">
<h1>tasks</h1>
<span class="ml-auto">name : {{Auth::user()->name}} </span>
</div>
    @if(isset($tasks))
    <table class="table">
        <thead>
            <tr>
                <td>id</td>
                <td>staff</td>
                <td>status</td>
                <td>task</td>
            </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr>
                <td>
                    @if($task->user_id === Auth::user()->id)
                    <a href="{{ route('tasks.show', ['task' => $task]) }}">{{$task->id}}</a>
                    @else
                    {{$task->id}}
                    @endif
                </td>
                <td>{{$task->user->name}}</td>
                <td>{{$task->status}}</td>
                <td>{{$task->content}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif

    {{-- ページネーションのリンク --}}
    {{ $tasks->links() }}
    
    {{-- メッセージ作成ページへのリンク --}}
    <a class="btn btn-primary" href="{{ route('tasks.create') }}">タスクの新規作成</a>
    @else
    <div class="center jumbotron">
        <div class="text-center">
            <h1>Please LOG IN and Check your task</h1>
                <a class="btn btn-lg btn-primary" href="{{ route('signup.get') }}">Sign up!</a>
        </div>
    </div>   
@endif


@endsection