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
    <h1 class="text-4xl font-bold">{{ __('Forgot Your Password?') }}</h1>
    <p class="mt-4">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </p>
    <form method="POST" action="{{ route('password.email') }}" class="mt-8">
        @csrf
        <label for="email" class="block">
            {{ __('Email Address') }}
        </label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus class="block mt-1 w-full rounded-lg border-2 p-2 focus:border-[#FF2D20] focus:outline-none">
        <button type="submit" class="mt-4 w-full bg-[#FF2D20] text-white font-bold py-2 px-4 rounded-lg hover:bg-[#FF2D20]/90 focus:outline-none">
            {{ __('Email Password Reset Link') }}
        </button>
    </form>
</div>
</body>
</html>
