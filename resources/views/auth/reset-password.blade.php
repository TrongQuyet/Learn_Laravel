<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="container mx-auto p-4">
    <h1 class="text-4xl font-bold">{{ __('Reset Password') }}</h1>
    <p class="mt-4">
        {{ __('Forgot your password? No problem. Just put in your email address and we will email you a password reset link that will allow you to pick a new one.') }}
    </p>
    <form method="POST" action="{{ route('password.update') }}" class="mt-8">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $token }}">

        <!-- Email Address -->
        <div>
            <label for="email" class="block">{{ __('Email Address') }}</label>
            <input type="email" id="email" class="block mt-1 w-full rounded-lg border-2 p-2 focus:border-[#FF2D20] focus:outline-none" name="email" value="{{ $email ?? old('email') }}" required autofocus>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block">{{ __('Password') }}</label>
            <input type="password" id="password" class="block mt-1 w-full rounded-lg border-2 p-2 focus:border-[#FF2D20] focus:outline-none" name="password" required>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" class="block">{{ __('Confirm Password') }}</label>
            <input type="password" id="password_confirmation" class="block mt-1 w-full rounded-lg border-2 p-2 focus:border-[#FF2D20] focus:outline-none" name="password_confirmation" required>
        </div>
        <div class="mt-4">
            <button type="submit" class="w-full bg-[#FF2D20] text-white font-bold py-2 px-4 rounded-lg hover:bg-[#FF2D20]/90 focus:outline-none">
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
</div>
</body>
</html>
