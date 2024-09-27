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
    <h1 class="text-4xl font-bold">{{ __('Verify Your Email Address') }}</h1>
    <p class="mt-4">
        {{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }},
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="text-blue-500 hover:underline">
                {{ __('click here to request another') }}
            </button>
        </form>.
    </p>
    {{-- <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="px-4 py-2 text-white bg-gray-500 rounded-md">
            {{ __('Log out') }}
        </button>
    </form> --}}
</div>
</body>
</html>
