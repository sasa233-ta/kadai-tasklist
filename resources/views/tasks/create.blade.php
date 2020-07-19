@extends('layouts.app')

@section('content')

<h1>タスクの新規作成ページ</h1>
<div class="row">
    <div class="col-6">
        <form method="POST" action="{{ route('tasks.store') }}" accept-charset="UTF-8">
        @csrf
            <div class="form-group">
                <label for="content">タスク：</label>
                <input class="form-control" name="content" type="text" id="content">
            </div>
            <input class="btn btn-primary" type="submit" value="作成">
        </form>
    </div>
</div>

@endsection