@extends('layouts.app')

@section('content')
<!-- Debug Info -->
@if(Auth::check())
    <div class="alert alert-info">
        <strong>DEBUG:</strong> User is authenticated. Name: {{ Auth::user()->name }}, Email: {{ Auth::user()->email }}
    </div>
@else
    <div class="alert alert-warning">
        <strong>DEBUG:</strong> User is NOT authenticated.
    </div>
@endif

<div class="dashboard-container">
    <div class="dashboard-header">
        <div class="container">
            <h1 class="dashboard-title">
                <i class="fas fa-tachometer-alt me-3"></i>Dashboard
            </h1>
            <p class="dashboard-subtitle">Welcome back, {{ Auth::user()->name }}! Here's your task overview.</p>
        </div>
    </div>

    <div class="container py-4">
        @if (session('status'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>{{ session('status') }}
            </div>
        @endif

        <!-- Task Statistics -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-primary">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">{{ $totalTasks ?? 0 }}</h3>
                        <p class="stat-label">Total Tasks</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-warning">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">{{ $pendingTasks ?? 0 }}</h3>
                        <p class="stat-label">Pending</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-info">
                        <i class="fas fa-spinner"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">{{ $inProgressTasks ?? 0 }}</h3>
                        <p class="stat-label">In Progress</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">{{ $completedTasks ?? 0 }}</h3>
                        <p class="stat-label">Completed</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Recent Tasks -->
            <div class="col-md-8">
                <div class="dashboard-card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-list me-2"></i>Recent Tasks
                        </h5>
                        <a href="{{ route('tasks.index') }}" class="btn btn-sm btn-outline-primary">
                            View All
                        </a>
                    </div>
                    <div class="card-body">
                        @if(isset($recentTasks) && $recentTasks->count() > 0)
                            <div class="recent-tasks">
                                @foreach($recentTasks as $task)
                                    <div class="task-item">
                                        <div class="task-info">
                                            <h6 class="task-title">{{ $task->title }}</h6>
                                            <p class="task-meta">
                                                <span class="task-date">
                                                    <i class="fas fa-calendar me-1"></i>{{ $task->due_date }}
                                                </span>
                                                <span class="task-priority priority-{{ strtolower($task->priority) }}">
                                                    <i class="fas fa-flag me-1"></i>{{ $task->priority }}
                                                </span>
                                            </p>
                                        </div>
                                        <div class="task-status">
                                            <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $task->status)) }}">
                                                {{ $task->status }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-tasks fa-2x text-muted mb-3"></i>
                                <p class="text-muted">No tasks yet. Create your first task to get started!</p>
                                <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Create Task
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="col-md-4">
                <div class="dashboard-card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-bolt me-2"></i>Quick Actions
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="quick-actions">
                            <a href="{{ route('tasks.create') }}" class="quick-action-btn">
                                <div class="quick-action-icon bg-primary">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="quick-action-text">
                                    <h6>Create New Task</h6>
                                    <p>Add a new task to your list</p>
                                </div>
                            </a>
                            
                            <a href="{{ route('tasks.index') }}" class="quick-action-btn">
                                <div class="quick-action-icon bg-success">
                                    <i class="fas fa-list"></i>
                                </div>
                                <div class="quick-action-text">
                                    <h6>View All Tasks</h6>
                                    <p>See all your tasks</p>
                                </div>
                            </a>
                            
                            <a href="{{ route('tasks.index', ['status' => 'Pending']) }}" class="quick-action-btn">
                                <div class="quick-action-icon bg-warning">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="quick-action-text">
                                    <h6>Pending Tasks</h6>
                                    <p>View pending tasks</p>
                                </div>
                            </a>
                            
                            <a href="{{ route('tasks.index', ['status' => 'Completed']) }}" class="quick-action-btn">
                                <div class="quick-action-icon bg-info">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="quick-action-text">
                                    <h6>Completed Tasks</h6>
                                    <p>View completed tasks</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.dashboard-container {
    background: #f8f9fa;
    min-height: calc(100vh - 5rem);
}

.dashboard-header {
    background: #667eea;
    color: white;
    padding: 2rem 0 1.5rem;
    margin-bottom: 2rem;
}

.dashboard-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.dashboard-subtitle {
    font-size: 1rem;
    opacity: 0.9;
    margin: 0;
}

.stat-card {
    background: white;
    border-radius: 0.5rem;
    padding: 1.5rem;
    box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
    border: 1px solid #e9ecef;
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    margin-right: 1rem;
}

.stat-content {
    flex: 1;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    color: #495057;
}

.stat-label {
    margin: 0;
    color: #6c757d;
    font-weight: 500;
}

.dashboard-card {
    background: white;
    border-radius: 0.5rem;
    box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
    border: 1px solid #e9ecef;
    margin-bottom: 1rem;
}

.dashboard-card .card-header {
    background: #f8f9fa;
    border-bottom: 1px solid #e9ecef;
    padding: 1rem 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.dashboard-card .card-header h5 {
    margin: 0;
    font-weight: 600;
    color: #495057;
}

.dashboard-card .card-body {
    padding: 1.5rem;
}

.task-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 0;
    border-bottom: 1px solid #e9ecef;
}

.task-item:last-child {
    border-bottom: none;
}

.task-title {
    margin: 0 0 0.5rem 0;
    font-weight: 600;
    color: #495057;
}

.task-meta {
    margin: 0;
    font-size: 0.9rem;
    color: #6c757d;
}

.task-date, .task-priority {
    margin-right: 1rem;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 1rem;
    font-size: 0.8rem;
    font-weight: 500;
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

.priority-low {
    color: #0dcaf0;
}

.priority-medium {
    color: #0d6efd;
}

.priority-high {
    color: #dc3545;
}

.quick-actions {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.quick-action-btn {
    display: flex;
    align-items: center;
    padding: 1rem;
    border-radius: 0.5rem;
    text-decoration: none;
    color: #495057;
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}

.quick-action-btn:hover {
    background: #f8f9fa;
    transform: translateY(-2px);
    box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
    color: #495057;
    text-decoration: none;
}

.quick-action-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    margin-right: 1rem;
}

.quick-action-text h6 {
    margin: 0 0 0.25rem 0;
    font-weight: 600;
}

.quick-action-text p {
    margin: 0;
    font-size: 0.9rem;
    color: #6c757d;
}

.empty-state {
    text-align: center;
    padding: 2rem 1rem;
}

@media (max-width: 768px) {
    .dashboard-header {
        padding: 1.5rem 0 1rem;
    }
    
    .dashboard-title {
        font-size: 1.75rem;
    }
    
    .stat-card {
        padding: 1rem;
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
    }
    
    .stat-number {
        font-size: 1.5rem;
    }
}
</style>
@endsection
