@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center mb-4">
            <div class="col-md-8 text-center">
                <a href="{{ route('marvel.home') }}" class="flex items-center justify-center">
                    <img src="{{ asset('storage/Marvel_Logo.svg') }}" alt="Logo Marvel" class="h-10">
                    <span class="text-3xl font-bold leading-none ml-4">UNIVERSE</span>
                </a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-red-500 text-white text-center">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                        <p>{{ __('If you did not receive the email') }},</p>

                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn bg-blue-500 text-white hover:bg-blue-700">
                                {{ __('click here to request another') }}
                            </button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
