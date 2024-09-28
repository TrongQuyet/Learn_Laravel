<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>ًApplication</title>
        @vite('resources/css/app.css')
    </head>
    <body>
        <div id="app"></div>
        @vite('resources/js/app.ts')
        @auth
            <script>
                window.auth = @json(auth()->check());
                window.user = @json(auth()->user());
                window.guard = @json(get_guard());
                window.userRoles = @json(Auth::user()->getRoleNames()->unique());
                window.userPermissions = @json(Auth::user()->getPermissionsViaRoles()->pluck('name'));
            </script>
        @endauth
    </body>
</html>
