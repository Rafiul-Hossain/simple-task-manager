@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white fw-bold">Create Task</div>
            <div class="card-body">
                <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required maxlength="255">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input type="date" class="form-control" id="due_date" name="due_date" value="{{ old('due_date') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="Pending" {{ old('status')=='Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="In Progress" {{ old('status')=='In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Completed" {{ old('status')=='Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="priority" class="form-label">Priority</label>
                        <select class="form-select" id="priority" name="priority">
                            <option value="Low" {{ old('priority')=='Low' ? 'selected' : '' }}>Low</option>
                            <option value="Medium" {{ old('priority')=='Medium' ? 'selected' : '' }}>Medium</option>
                            <option value="High" {{ old('priority')=='High' ? 'selected' : '' }}>High</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success px-4">Create Task</button>
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary ms-2 px-4">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
