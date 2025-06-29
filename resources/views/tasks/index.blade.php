@extends('layouts.app')

@section('content')
<div class="tasks-container">
    <div class="tasks-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="tasks-title">
                        <i class="fas fa-tasks me-3"></i>My Tasks
                    </h1>
                    <p class="tasks-subtitle">Organize and manage your tasks efficiently</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus me-2"></i>Create New Task
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-4">
        <div class="filters-card">
            <form method="GET" class="row g-3">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-search me-2"></i>Search
                        </label>
                        <input type="text" name="search" class="form-control" 
                               placeholder="Search tasks..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-filter me-2"></i>Status
                        </label>
                        <select name="status" class="form-select">
                            <option value="">All Statuses</option>
                            <option value="Pending" {{ request('status')=='Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="In Progress" {{ request('status')=='In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Completed" {{ request('status')=='Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-sort me-2"></i>Sort By
                        </label>
                        <select name="sort" class="form-select">
                            <option value="due_date" {{ request('sort')=='due_date' ? 'selected' : '' }}>Due Date</option>
                            <option value="title" {{ request('sort')=='title' ? 'selected' : '' }}>Title</option>
                            <option value="priority" {{ request('sort')=='priority' ? 'selected' : '' }}>Priority</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-arrow-up me-2"></i>Order
                        </label>
                        <select name="direction" class="form-select">
                            <option value="asc" {{ request('direction')=='asc' ? 'selected' : '' }}>Ascending</option>
                            <option value="desc" {{ request('direction')=='desc' ? 'selected' : '' }}>Descending</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-success me-2">
                        <i class="fas fa-search me-2"></i>Filter
                    </button>
                    <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>Clear
                    </a>
                </div>
            </form>
        </div>

        <div class="tasks-table-card">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><i class="fas fa-tag me-2"></i>Title</th>
                            <th><i class="fas fa-align-left me-2"></i>Description</th>
                            <th><i class="fas fa-calendar me-2"></i>Due Date</th>
                            <th><i class="fas fa-info-circle me-2"></i>Status</th>
                            <th><i class="fas fa-exclamation-triangle me-2"></i>Priority</th>
                            <th><i class="fas fa-cogs me-2"></i>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tasks as $task)
                            <tr class="task-row">
                                <td class="task-title">{{ $task->title }}</td>
                                <td class="task-description">{{ Str::limit($task->description, 50) }}</td>
                                <td class="task-date">{{ $task->due_date }}</td>
                                <td>
                                    <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $task->status)) }}">
                                        <i class="fas fa-circle me-1"></i>{{ $task->status }}
                                    </span>
                                </td>
                                <td>
                                    <span class="priority-badge priority-{{ strtolower($task->priority) }}">
                                        <i class="fas fa-flag me-1"></i>{{ $task->priority }}
                                    </span>
                                </td>
                                <td class="task-actions">
                                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-primary me-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('Are you sure you want to delete this task?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-tasks fa-3x text-muted mb-3"></i>
                                        <h4 class="text-muted">No tasks found</h4>
                                        <p class="text-muted">Create your first task to get started!</p>
                                        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-2"></i>Create Task
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($tasks->hasPages())
                <div class="pagination-wrapper">
                    {{ $tasks->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.tasks-container {
    background: #f8f9fa;
    min-height: calc(100vh - 5rem);
}

.tasks-header {
    background: #667eea;
    color: white;
    padding: 2rem 0 1.5rem;
    margin-bottom: 2rem;
}

.tasks-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.tasks-subtitle {
    font-size: 1rem;
    opacity: 0.9;
    margin: 0;
}

.filters-card {
    background: white;
    border-radius: 0.5rem;
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
    border: 1px solid #e9ecef;
}

.form-group {
    margin-bottom: 0;
}

.form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.tasks-table-card {
    background: white;
    border-radius: 0.5rem;
    overflow: hidden;
    box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
    border: 1px solid #e9ecef;
}

.table {
    margin-bottom: 0;
}

.table thead th {
    background: #667eea;
    color: white;
    border: none;
    font-weight: 600;
    padding: 1rem;
    font-size: 0.9rem;
}

.table tbody tr {
    transition: all 0.3s ease;
}

.table tbody tr:hover {
    background: rgba(102, 126, 234, 0.05);
}

.task-title {
    font-weight: 600;
    color: #495057;
}

.task-description {
    color: #6c757d;
    font-size: 0.9rem;
}

.task-date {
    font-weight: 500;
    color: #495057;
}

.status-badge {
    padding: 0.5rem 1rem;
    border-radius: 2rem;
    font-size: 0.85rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
}

.status-pending {
    background: rgba(108, 117, 125, 0.1);
    color: #6c757d;
}

.status-in-progress {
    background: rgba(255, 193, 7, 0.1);
    color: #ffc107;
}

.status-completed {
    background: rgba(40, 167, 69, 0.1);
    color: #28a745;
}

.priority-badge {
    padding: 0.5rem 1rem;
    border-radius: 2rem;
    font-size: 0.85rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
}

.priority-low {
    background: rgba(13, 202, 240, 0.1);
    color: #0dcaf0;
}

.priority-medium {
    background: rgba(13, 110, 253, 0.1);
    color: #0d6efd;
}

.priority-high {
    background: rgba(220, 53, 69, 0.1);
    color: #dc3545;
}

.task-actions {
    white-space: nowrap;
}

.task-actions .btn {
    border-radius: 0.25rem;
    padding: 0.375rem 0.75rem;
    transition: all 0.3s ease;
}

.task-actions .btn:hover {
    transform: translateY(-1px);
}

.empty-state {
    padding: 3rem 1rem;
}

.pagination-wrapper {
    padding: 1rem;
    background: #f8f9fa;
    border-top: 1px solid #dee2e6;
}

.pagination {
    justify-content: center;
    margin: 0;
}

.page-link {
    border-radius: 0.25rem;
    margin: 0 0.25rem;
    border: none;
    color: #667eea;
    font-weight: 500;
}

.page-link:hover {
    background: #667eea;
    color: white;
}

.page-item.active .page-link {
    background: #667eea;
    border-color: #667eea;
}

@media (max-width: 768px) {
    .tasks-header {
        padding: 1.5rem 0 1rem;
    }
    
    .tasks-title {
        font-size: 1.75rem;
    }
    
    .filters-card {
        padding: 1rem;
    }
    
    .table-responsive {
        font-size: 0.9rem;
    }
    
    .task-actions .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.8rem;
    }
}
</style>
@endsection
