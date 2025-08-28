<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use App\Http\Livewire\ChatBox;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        if (class_exists(Livewire::class)) {
            Livewire::component('chat-box', ChatBox::class);
        }
    }
}
