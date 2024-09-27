<?php

// use Illuminate\Foundation\Inspiring;
// use Illuminate\Support\Facades\Artisan;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote')->hourly();
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Schedule::call(function () {
    $user = User::created([
            'name' => 'Test User' . rand(1, 100),
            'email' => 'super.quyet69@gmail.com'. rand(1, 100),
            'password' => Hash::make('123456'),
        ]);
    \Log::info($user);
})->everyMinute();

Schedule::command('app:send-email-after-one-minute')->everyMinute();
