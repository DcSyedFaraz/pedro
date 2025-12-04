@extends('frontend.layout.app')
@section('content')
<style>
    .data-deletion-container {
        max-width: 600px;
        margin: 80px auto;
        padding: 40px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .data-deletion-container h1 {
        color: #002C3E;
        font-size: 2em;
        margin-bottom: 20px;
        text-align: center;
    }

    .data-deletion-container p {
        font-size: 1.1em;
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .data-deletion-container .warning-box {
        background: #fff3cd;
        border: 1px solid #ffc107;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .data-deletion-container .warning-box h3 {
        color: #856404;
        font-size: 1.2em;
        margin-bottom: 10px;
    }

    .data-deletion-container .warning-box ul {
        margin-left: 20px;
        color: #856404;
    }

    .data-deletion-container .form-group {
        margin-bottom: 20px;
    }

    .data-deletion-container .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #002C3E;
    }

    .data-deletion-container .form-control {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 1em;
    }

    .data-deletion-container .btn-danger {
        width: 100%;
        padding: 12px;
        background: #dc3545;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 1.1em;
        cursor: pointer;
        transition: background 0.3s;
    }

    .data-deletion-container .btn-danger:hover {
        background: #c82333;
    }

    .data-deletion-container .btn-secondary {
        width: 100%;
        padding: 12px;
        background: #6c757d;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 1em;
        cursor: pointer;
        margin-top: 10px;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .data-deletion-container .btn-secondary:hover {
        background: #5a6268;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
    }

    .alert-danger {
        background: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }

    .alert-success {
        background: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
    }
</style>

<div class="container">
    <div class="data-deletion-container">
        <h1>Request Data Deletion</h1>

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <p>
            We respect your privacy and your right to control your personal data. If you wish to permanently delete your account and all associated data from our system, please submit your request below.
        </p>

        <div class="warning-box">
            <h3>⚠️ Important Notice</h3>
            <p><strong>This action is permanent and irreversible.</strong> Once confirmed, the following data will be permanently deleted:</p>
            <ul>
                <li>Your account and profile information</li>
                <li>All work orders and job history</li>
                <li>All invoices and estimates</li>
                <li>All documents and files</li>
                <li>All messages and communications</li>
                <li>All related business data</li>
            </ul>
        </div>

        <form method="POST" action="{{ route('data-deletion.verify') }}">
            @csrf
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       placeholder="Enter your registered email address" 
                       required>
                @error('email')
                <div class="invalid-feedback" style="color: #dc3545; margin-top: 5px;">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit" class="btn-danger">Continue to Verification</button>
        </form>

        <a href="{{ route('home') }}" class="btn-secondary">Cancel and Return Home</a>

        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; text-align: center;">
            <p style="font-size: 0.9em; color: #666;">
                Need help? Contact us at <a href="mailto:info@facilit8system.com">info@facilit8system.com</a> or call 407-978-0288
            </p>
        </div>
    </div>
</div>
@endsection

