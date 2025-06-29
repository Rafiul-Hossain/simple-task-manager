@extends('layouts.guest')

@section('title', 'Register - Task Manager')

@section('content')
<div class="auth-container">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="auth-card">
                    <div class="auth-header">
                        <h2 class="auth-title">Join Task Manager</h2>
                        <p class="auth-subtitle">Create your account and start organizing</p>
                    </div>
                    
                    <div class="auth-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name" class="form-label">
                                    <i class="fas fa-user me-2"></i>Full Name
                                </label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-2"></i>Email Address
                                </label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="username">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock me-2"></i>Password
                                </label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="new-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">
                                    <i class="fas fa-lock me-2"></i>Confirm Password
                                </label>
                                <input id="password_confirmation" type="password" class="form-control"
                                       name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-user-plus me-2"></i>Create Account
                                </button>
                            </div>
                            
                            <div class="auth-links">
                                <a href="{{ route('login') }}" class="auth-link">
                                    <i class="fas fa-sign-in-alt me-1"></i>Already registered? Login here
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
    background: #28a745;
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
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}

.btn-primary {
    background: #28a745;
    border: none;
    border-radius: 0.5rem;
    font-weight: 600;
    padding: 0.75rem 2rem;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: #218838;
    transform: translateY(-1px);
    box-shadow: 0 0.25rem 0.5rem rgba(40, 167, 69, 0.3);
}

.auth-links {
    text-align: center;
    margin-top: 1.5rem;
}

.auth-link {
    display: block;
    color: #28a745;
    text-decoration: none;
    margin: 0.5rem 0;
    font-weight: 500;
    transition: all 0.3s ease;
}

.auth-link:hover {
    color: #218838;
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
