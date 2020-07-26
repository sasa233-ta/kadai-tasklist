@extends('layouts.app')

@section('content')

<h1>id: {{ $task->id }} : edit page</h1>
<div class="row">
    <div class="col-6">
        <form method="POST" action="{{ route('tasks.update',[$task->id]) }}" accept-charset="UTF-8">
        @csrf
            <div class="form-group">
            <label for="status">status：</label>
                <input class="form-control" name="status" type="text" id="status" value="{{ old('status') ?: $task->status}}">
                <label for="content">task：</label>
                <input type="hidden" name="_method" value="PUT">
                <input class="form-control" name="content" type="text" id="content" value="{{ old('content') ?: $task->content}}">
            </div>
            <input class="btn btn-primary" type="submit" value="更新">
        </form>
    </div>
</div>

@endsection