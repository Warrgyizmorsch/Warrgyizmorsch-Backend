@extends('layouts.app')

@section('content')

    <style>
        .error-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 70vh;
        }

        .error-card {
            max-width: 500px;
            width: 100%;
            border-radius: 12px;
            text-align: center;
            padding: 40px 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            background: #fff;
        }

        .error-code {
            font-size: 80px;
            font-weight: 700;
            color: #e3342f;
            margin-bottom: 10px;
        }

        .error-title {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }

        .error-text {
            font-size: 14px;
            color: #777;
            margin-bottom: 25px;
        }

        .btn-dashboard {
            border-radius: 8px;
            padding: 8px 16px;
            font-size: 14px;
        }
    </style>

    <main>
        {{-- Page Header (same as your other pages) --}}
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Error 404</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">404</li>
                </ul>
            </div>
        </div>
    </main>

    <div class="crm-page-container">
        <div class="error-wrapper">
            <div class="card error-card">

                <div class="error-code">404</div>

                <div class="error-title">
                    Oops! Page Not Found
                </div>

                <div class="error-text">
                    The page you are looking for doesn’t exist or has been removed.
                </div>

                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-dashboard">
                    Back to Dashboard
                </a>

            </div>
        </div>
    </div>

@endsection