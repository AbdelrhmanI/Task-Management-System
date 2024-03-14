<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="stylesheet" href="{{ asset('css/tasks.css') }}">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h4>Edit Task</h4>
                <hr>
                <form action="{{ route('update-task', ['task' => $task->id]) }}" method="post">
                    @csrf
                    @if(Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                    @endif
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" placeholder="Enter Task Name" name="name" value="{{ $task->name }}">
                        <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" rows="3" placeholder="Enter Task Description" name="description">{{ $task->description }}</textarea>
                        <span class="text-danger">@error('description') {{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status">
                            <option value="0" {{ $task->status == 0 ? 'selected' : '' }}>Incomplete</option>
                            <option value="1" {{ $task->status == 1 ? 'selected' : '' }}>Completed</option>
                        </select>
                        <span class="text-danger">@error('status') {{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="user">Assign To</label>
                        <select class="form-control" name="user">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $task->UserID == $user->id ? 'selected' : '' }}>{{ $user->email }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <button class="btn btn-primary" type="submit">Update Task</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary" style="font-size: 1.1em;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

