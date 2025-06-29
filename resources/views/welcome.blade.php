@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="hero-section text-center py-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="display-3 fw-bold text-primary mb-4">
                    <i class="fas fa-tasks me-3"></i>Task Manager
                </h1>
                <p class="lead fs-4 text-muted mb-4">
                    Organize your tasks, boost productivity, and achieve your goals with our intuitive task management platform.
                </p>
                <div class="hero-buttons">
                    @auth
                        <a href="{{ route('tasks.index') }}" class="btn btn-primary btn-lg px-5 py-3 me-3">
                            <i class="fas fa-list me-2"></i>Go to My Tasks
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5 py-3 me-3">
                            <i class="fas fa-user-plus me-2"></i>Get Started Free
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg px-5 py-3">
                            <i class="fas fa-sign-in-alt me-2"></i>Sign In
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="features-section py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="display-5 fw-bold text-dark mb-3">Why Choose Task Manager?</h2>
                <p class="lead text-muted">Everything you need to stay organized and productive</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card text-center p-4 h-100">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-mobile-alt fa-3x text-primary"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Responsive Design</h4>
                    <p class="text-muted">Access your tasks from any device with our mobile-friendly interface.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="feature-card text-center p-4 h-100">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-search fa-3x text-success"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Smart Filtering</h4>
                    <p class="text-muted">Find tasks quickly with advanced search and filtering options.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="feature-card text-center p-4 h-100">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-shield-alt fa-3x text-warning"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Secure & Private</h4>
                    <p class="text-muted">Your data is protected with industry-standard security measures.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="stats-section py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3">
                <div class="stat-item">
                    <h3 class="display-4 fw-bold text-primary">100%</h3>
                    <p class="text-muted">Free to Use</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-item">
                    <h3 class="display-4 fw-bold text-success">24/7</h3>
                    <p class="text-muted">Always Available</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-item">
                    <h3 class="display-4 fw-bold text-warning">Easy</h3>
                    <p class="text-muted">Simple Setup</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-item">
                    <h3 class="display-4 fw-bold text-info">Fast</h3>
                    <p class="text-muted">Lightning Quick</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="cta-section py-5">
    <div class="container text-center">
        <h2 class="display-6 fw-bold mb-4">Ready to Get Organized?</h2>
        <p class="lead text-muted mb-4">Join thousands of users who have improved their productivity with Task Manager.</p>
        @guest
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5 py-3">
                <i class="fas fa-rocket me-2"></i>Start Your Free Account
            </a>
        @endguest
    </div>
</div>

<style>
.hero-section {
    background: #f8f9fa;
    border-radius: 0 0 2rem 2rem;
    margin-top: -1.5rem;
    padding-top: 3rem !important;
}

.feature-card {
    background: white;
    border-radius: 1rem;
    box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid #e9ecef;
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.feature-icon {
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.stats-section {
    background: #f8f9fa;
}

.stat-item {
    padding: 1rem;
}

.cta-section {
    background: #e9ecef;
    border-radius: 2rem;
}

.btn {
    border-radius: 2rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.15);
}

@media (max-width: 768px) {
    .hero-section {
        padding: 2rem 1rem !important;
    }
    
    .hero-buttons .btn {
        display: block;
        margin: 0.5rem auto;
        max-width: 300px;
    }
    
    .display-3 {
        font-size: 2.5rem;
    }
    
    .display-4 {
        font-size: 2rem;
    }
}
</style>
@endsection
