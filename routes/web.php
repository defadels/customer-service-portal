<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\CustomerWebController;
use App\Http\Controllers\Web\TicketWebController;
use App\Http\Controllers\Web\AgentWebController;
use App\Http\Controllers\AIController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

// Register Livewire routes
Livewire::setScriptRoute(function ($handle) {
    return Route::get('/livewire/livewire.js', $handle)->name('livewire.js');
});

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/livewire/update', $handle)->name('livewire.update')->middleware('web');
});

// Public routes
Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/blog', function () {
    return view('blog');
})->name('blog');

Route::get('/home', function () {
    return redirect()->route('dashboard');
})->name('home');

// Authentication required routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Chat Interface
    Route::get('/chat', function () {
        return view('chat');
    })->name('chat.index');

    // Test Chat Route
    Route::get('/chat/test', function () {
        return view('chat-test');
    })->name('chat.test');

    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Customer routes (accessible by all authenticated users)
    Route::get('/customers', [CustomerWebController::class, 'index'])->name('customers.index');
    Route::get('/customers/create', [CustomerWebController::class, 'create'])->name('customers.create');
    Route::post('/customers', [CustomerWebController::class, 'store'])->name('customers.store');
    Route::get('/customers/{id}', [CustomerWebController::class, 'show'])->name('customers.show');
    Route::get('/customers/{id}/edit', [CustomerWebController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{id}', [CustomerWebController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{id}', [CustomerWebController::class, 'destroy'])->name('customers.destroy');

    // Ticket routes (accessible by all authenticated users)
    Route::get('/tickets', [TicketWebController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [TicketWebController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketWebController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{id}', [TicketWebController::class, 'show'])->name('tickets.show');
    Route::get('/tickets/{id}/edit', [TicketWebController::class, 'edit'])->name('tickets.edit');
    Route::put('/tickets/{id}', [TicketWebController::class, 'update'])->name('tickets.update');
    Route::delete('/tickets/{id}', [TicketWebController::class, 'destroy'])->name('tickets.destroy');

    // Agent routes (admin and supervisor only)
    Route::middleware(['role:admin,supervisor'])->group(function () {
        Route::get('/agents', [AgentWebController::class, 'index'])->name('agents.index');
        Route::get('/agents/create', [AgentWebController::class, 'create'])->name('agents.create');
        Route::post('/agents', [AgentWebController::class, 'store'])->name('agents.store');
        Route::get('/agents/{id}', [AgentWebController::class, 'show'])->name('agents.show');
        Route::get('/agents/{id}/edit', [AgentWebController::class, 'edit'])->name('agents.edit');
        Route::put('/agents/{id}', [AgentWebController::class, 'update'])->name('agents.update');
        Route::delete('/agents/{id}', [AgentWebController::class, 'destroy'])->name('agents.destroy');
    });
});

require __DIR__.'/auth.php';
