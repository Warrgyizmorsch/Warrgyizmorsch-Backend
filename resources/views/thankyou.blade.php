@extends('layouts.app')

@section('content')

<style>
    .thankyou-section {
        height: 100vh;
        padding: 120px 3% 80px;
        background-color: var(--bg-dark);
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .thankyou-section h2 {
        color: var(--primary-color);
        font-weight: 700;
    }

    .thankyou-section p {
        margin-top: 1rem;
        color: var(--accent-color);
        font-size: 1.1rem;
    }

    .btn-home {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 25px;
        background-color: var(--primary-color);
        color: #fff;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-home:hover {
        background-color: #003d7a;
        color: #fff;
    }

    .thankyou-icon i {
        margin-bottom: 5px;
        font-size: 4rem;
        color: var(--primary-color);
        animation: popIn 0.6s ease-out;
    }

    @keyframes popIn {
        0% {
            transform: scale(0.5);
            opacity: 0;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }
</style>

<section class="thankyou-section d-flex justify-content-center align-items-center">
    <div class="container text-center">
        <div class="thankyou-icon mb-4">
            <i class="fas fa-check-circle"></i>
        </div>
        <h2>Thank You!</h2>
        <p>We have received your information. Our team will get in touch with you shortly.</p>
        <a href="{{ url('/') }}" class="btn-home mt-4">Back to Home</a>
    </div>
</section>


@endsection
