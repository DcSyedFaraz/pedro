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
        text-align: center;
    }

    .data-deletion-container .success-icon {
        font-size: 4em;
        color: #28a745;
        margin-bottom: 20px;
    }

    .data-deletion-container h1 {
        color: #002C3E;
        font-size: 2em;
        margin-bottom: 20px;
    }

    .data-deletion-container p {
        font-size: 1.1em;
        margin-bottom: 20px;
        line-height: 1.6;
        color: #333;
    }

    .data-deletion-container .success-box {
        background: #d4edda;
        border: 1px solid #c3e6cb;
        border-radius: 5px;
        padding: 20px;
        margin: 30px 0;
    }

    .data-deletion-container .success-box h3 {
        color: #155724;
        font-size: 1.3em;
        margin-bottom: 15px;
    }

    .data-deletion-container .success-box ul {
        text-align: left;
        margin: 15px 0 15px 30px;
        color: #155724;
    }

    .data-deletion-container .success-box ul li {
        margin-bottom: 8px;
    }

    .data-deletion-container .btn-primary {
        padding: 12px 30px;
        background: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 1.1em;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        margin-top: 20px;
        transition: background 0.3s;
    }

    .data-deletion-container .btn-primary:hover {
        background: #0056b3;
    }

    .info-text {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 5px;
        margin-top: 30px;
        border-left: 4px solid #007bff;
    }

    .info-text p {
        font-size: 0.95em;
        color: #666;
        margin-bottom: 10px;
    }

    .info-text p:last-child {
        margin-bottom: 0;
    }
</style>

<div class="container">
    <div class="data-deletion-container">
        <div class="success-icon">✓</div>
        
        <h1>Account Deletion Successful</h1>

        <p>Your account and all associated data have been permanently deleted from our system.</p>

        <div class="success-box">
            <h3>What Has Been Deleted</h3>
            <p>The following data has been permanently removed:</p>
            <ul>
                <li>Your account and profile information</li>
                <li>All work orders and job history</li>
                <li>All invoices and estimates</li>
                <li>All documents and files</li>
                <li>All messages and communications</li>
                <li>All business relationships and records</li>
            </ul>
        </div>

        <p>A confirmation email has been sent to your registered email address.</p>

        <div class="info-text">
            <p><strong>Important Information:</strong></p>
            <p>
                • Your data has been completely removed from our active systems.<br>
                • We may retain certain information as required by law or for legitimate business purposes (e.g., accounting records, dispute resolution).<br>
                • If you wish to use our services again in the future, you will need to create a new account.<br>
                • Backup data may take up to 30 days to be completely purged from our backup systems.
            </p>
        </div>

        <p style="margin-top: 30px;">
            Thank you for using our services. We're sorry to see you go!
        </p>

        <a href="{{ route('home') }}" class="btn-primary">Return to Homepage</a>

        <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #ddd;">
            <p style="font-size: 0.9em; color: #666;">
                If you have any questions or concerns, please contact us:<br>
                <a href="mailto:info@facilit8system.com">info@facilit8system.com</a> | 407-978-0288
            </p>
        </div>
    </div>
</div>
@endsection

