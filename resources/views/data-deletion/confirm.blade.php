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

    .data-deletion-container .danger-box {
        background: #f8d7da;
        border: 2px solid #dc3545;
        border-radius: 5px;
        padding: 20px;
        margin-bottom: 25px;
    }

    .data-deletion-container .danger-box h3 {
        color: #721c24;
        font-size: 1.3em;
        margin-bottom: 10px;
    }

    .data-deletion-container .info-box {
        background: #d1ecf1;
        border: 1px solid #bee5eb;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .data-deletion-container .info-box p {
        color: #0c5460;
        margin-bottom: 0;
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

    .data-deletion-container .checkbox-group {
        margin-bottom: 20px;
    }

    .data-deletion-container .checkbox-group label {
        display: flex;
        align-items: center;
        cursor: pointer;
        font-weight: normal;
    }

    .data-deletion-container .checkbox-group input[type="checkbox"] {
        width: 20px;
        height: 20px;
        margin-right: 10px;
        cursor: pointer;
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
        font-weight: 600;
    }

    .data-deletion-container .btn-danger:hover {
        background: #c82333;
    }

    .data-deletion-container .btn-link {
        display: block;
        text-align: center;
        margin-top: 15px;
        color: #007bff;
        text-decoration: none;
        font-size: 0.95em;
    }

    .data-deletion-container .btn-link:hover {
        text-decoration: underline;
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

    .verification-code {
        font-size: 1.2em;
        letter-spacing: 2px;
        text-align: center;
    }
</style>

<div class="container">
    <div class="data-deletion-container">
        <h1>Confirm Data Deletion</h1>

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

        <div class="info-box">
            <p><strong>📧 Verification Code Sent</strong></p>
            <p>We've sent a 6-digit verification code to: <strong>{{ $email }}</strong></p>
            <p style="margin-top: 10px; font-size: 0.95em;">Please check your email and enter the code below. The code will expire in 15 minutes.</p>
        </div>

        <div class="danger-box">
            <h3>🚨 Final Warning</h3>
            <p>
                You are about to <strong>permanently delete</strong> your account and all associated data. 
                This action <strong>CANNOT be undone</strong>. All your information, history, and records will be permanently removed from our system.
            </p>
        </div>

        <form method="POST" action="{{ route('data-deletion.confirm') }}">
            @csrf
            
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="form-group">
                <label for="verification_code">Verification Code</label>
                <input type="text" 
                       class="form-control verification-code @error('verification_code') is-invalid @enderror" 
                       id="verification_code" 
                       name="verification_code" 
                       value="{{ old('verification_code') }}"
                       placeholder="Enter 6-digit code" 
                       maxlength="6"
                       pattern="[0-9]{6}"
                       required>
                @error('verification_code')
                <div class="invalid-feedback" style="color: #dc3545; margin-top: 5px;">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="checkbox-group">
                <label>
                    <input type="checkbox" 
                           name="confirm_deletion" 
                           value="1" 
                           required>
                    <span>
                        I understand that this action is <strong>permanent and irreversible</strong>. 
                        I confirm that I want to permanently delete my account and all associated data.
                    </span>
                </label>
                @error('confirm_deletion')
                <div style="color: #dc3545; margin-top: 5px; margin-left: 30px; font-size: 0.9em;">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit" class="btn-danger">
                DELETE MY ACCOUNT PERMANENTLY
            </button>
        </form>

        <form method="POST" action="{{ route('data-deletion.resend') }}" style="margin-top: 20px;">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            <button type="submit" class="btn-link" style="border: none; background: none; width: auto; padding: 0; margin: 20px auto 0;">
                Didn't receive the code? Resend verification code
            </button>
        </form>

        <a href="{{ route('data-deletion.index') }}" class="btn-link">← Go Back</a>

        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; text-align: center;">
            <p style="font-size: 0.9em; color: #666;">
                Changed your mind? Simply close this page - no changes will be made to your account.
            </p>
        </div>
    </div>
</div>
@endsection

