<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\AIController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public AI test route (no authentication required)
Route::post('ai/test-chat', [AIController::class, 'generateResponse']);

// All API routes require authentication
// Prefix all API route names with "api." to avoid collisions with web route names
Route::middleware('auth:sanctum')->name('api.')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Dashboard Stats
    Route::get('/dashboard/stats', [DashboardController::class, 'stats']);

    // Customer routes
    Route::apiResource('customers', CustomerController::class);
    Route::get('customers/search', [CustomerController::class, 'search']);

    // Ticket routes
    Route::apiResource('tickets', TicketController::class);
    Route::patch('tickets/{ticket}/status', [TicketController::class, 'updateStatus']);
    Route::patch('tickets/{ticket}/assign', [TicketController::class, 'assignAgent']);

    // Chat routes
    Route::get('chat/messages', [ChatController::class, 'index'])->name('chat.messages.index');
    Route::post('chat/messages', [ChatController::class, 'store'])->name('chat.messages.store');
    Route::patch('chat/messages/{message}/read', [ChatController::class, 'markAsRead'])->name('chat.messages.read');
    Route::get('chat/stats', [ChatController::class, 'getStats'])->name('chat.stats');

    // Agent routes
    Route::apiResource('agents', AgentController::class);
    Route::get('agents/available', [AgentController::class, 'getAvailableAgents']);
    Route::get('agents/{agent}/performance', [AgentController::class, 'getPerformance']);

    // AI routes
    Route::prefix('ai')->group(function () {
        Route::post('/chat', [AIController::class, 'generateResponse']);
        Route::post('/generate-response', [AIController::class, 'generateResponse']);
        Route::get('/stats', [AIController::class, 'getStats']);
    });
});
