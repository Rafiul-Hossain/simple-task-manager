@extends('layouts.guest')

@section('title', 'Login - Task Manager')

@section('content')
<div class="auth-container">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="auth-card">
                    <div class="auth-header">
                        <h2 class="auth-title">Welcome Back</h2>
                        <p class="auth-subtitle">Sign in to your Task Manager account</p>
                    </div>
                    
                    <div class="auth-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle me-2"></i>{{ session('status') }}
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-2"></i>Email Address
                                </label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock me-2"></i>Password
                                </label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="current-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                                <label class="form-check-label" for="remember_me">
                                    <i class="fas fa-check me-1"></i>Remember me
                                </label>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-sign-in-alt me-2"></i>Sign In
                                </button>
                            </div>
                            
                            <div class="auth-links">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="auth-link">
                                        <i class="fas fa-key me-1"></i>Forgot your password?
                                    </a>
                                @endif
                                
                                <a href="{{ route('register') }}" class="auth-link">
                                    <i class="fas fa-user-plus me-1"></i>Don't have an account? Register
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.auth-container {
    min-height: 100vh;
    background: #f8f9fa;
    display: flex;
    align-items: center;
}

.auth-card {
    background: white;
    border-radius: 1rem;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    border: 1px solid #e9ecef;
    overflow: hidden;
}

.auth-header {
    background: #667eea;
    color: white;
    text-align: center;
    padding: 2rem;
}

.auth-icon {
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    font-size: 1.5rem;
}

.auth-title {
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.auth-subtitle {
    font-size: 1rem;
    opacity: 0.9;
    margin: 0;
}

.auth-body {
    padding: 2rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.5rem;
    display: block;
}

.form-control {
    border-radius: 0.5rem;
    border: 2px solid #e9ecef;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.form-check-input:checked {
    background-color: #667eea;
    border-color: #667eea;
}

.btn-primary {
    background: #667eea;
    border: none;
    border-radius: 0.5rem;
    font-weight: 600;
    padding: 0.75rem 2rem;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: #5a6fd8;
    transform: translateY(-1px);
    box-shadow: 0 0.25rem 0.5rem rgba(102, 126, 234, 0.3);
}

.auth-links {
    text-align: center;
    margin-top: 1.5rem;
}

.auth-link {
    display: block;
    color: #667eea;
    text-decoration: none;
    margin: 0.5rem 0;
    font-weight: 500;
    transition: all 0.3s ease;
}

.auth-link:hover {
    color: #5a6fd8;
    transform: translateX(2px);
}

.alert {
    border-radius: 0.5rem;
    border: none;
    font-weight: 500;
}

@media (max-width: 768px) {
    .auth-container {
        padding: 1rem;
    }
    
    .auth-card {
        margin: 1rem;
    }
    
    .auth-header {
        padding: 1.5rem;
    }
    
    .auth-body {
        padding: 1.5rem;
    }
}
</style>
@endsection
