<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();*/


Artisan::command('user:create', function () {
    $this->info('We begin the creation of a User.');

    \App\Models\User::create([
        'name' => $this->ask('Name?'),
        'email' => $this->ask('Email?'),
        'password' => bcrypt($this->secret('Password?'))
    ]);

    $this->info('Account created ');
})->purpose('Create a User');