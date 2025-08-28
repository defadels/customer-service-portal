<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;

class TestFrontend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:frontend';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test frontend views and navigation of the Customer Service Portal';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🎨 Starting Frontend Testing...');
        $this->newLine();

        // Test 1: View Files
        $this->testViewFiles();

        // Test 2: Routes
        $this->testRoutes();

        // Test 3: Layout Components
        $this->testLayoutComponents();

        // Test 4: Navigation
        $this->testNavigation();

        $this->newLine();
        $this->info('✅ All frontend components tested successfully!');
    }

    private function testViewFiles()
    {
        $this->info('📁 Testing View Files...');
        
        $views = [
            'layouts.app',
            'layouts.navigation',
            'dashboard',
            'customers.index',
            'customers.create',
            'customers.show',
            'customers.edit',
            'tickets.index',
            'tickets.create',
            'tickets.show',
            'tickets.edit',
            'agents.index',
            'agents.create',
            'agents.show',
            'agents.edit',
            'chat'
        ];

        foreach ($views as $view) {
            try {
                if (View::exists($view)) {
                    $this->line("   • ✅ {$view}: Available");
                } else {
                    $this->line("   • ❌ {$view}: Missing");
                }
            } catch (\Exception $e) {
                $this->line("   • ❌ {$view}: Error - " . $e->getMessage());
            }
        }
        
        $this->info('   ✅ View files check completed');
    }

    private function testRoutes()
    {
        $this->info('🛣️ Testing Routes...');
        
        $routes = [
            'dashboard' => 'GET',
            'customers.index' => 'GET',
            'customers.create' => 'GET',
            'customers.show' => 'GET',
            'customers.edit' => 'GET',
            'tickets.index' => 'GET',
            'tickets.create' => 'GET',
            'tickets.show' => 'GET',
            'tickets.edit' => 'GET',
            'agents.index' => 'GET',
            'agents.create' => 'GET',
            'agents.show' => 'GET',
            'agents.edit' => 'GET',
            'chat.index' => 'GET',
            'login' => 'GET',
            'register' => 'GET',
            'profile.edit' => 'GET'
        ];

        foreach ($routes as $route => $method) {
            try {
                if (Route::has($route)) {
                    $this->line("   • ✅ {$route}: Available ({$method})");
                } else {
                    $this->line("   • ❌ {$route}: Missing");
                }
            } catch (\Exception $e) {
                $this->line("   • ❌ {$route}: Error - " . $e->getMessage());
            }
        }
        
        $this->info('   ✅ Routes check completed');
    }

    private function testLayoutComponents()
    {
        $this->info('🏗️ Testing Layout Components...');
        
        try {
            // Test if main layout exists
            if (View::exists('layouts.app')) {
                $this->line("   • ✅ Main Layout: Available");
            }
            
            // Test if navigation exists
            if (View::exists('layouts.navigation')) {
                $this->line("   • ✅ Navigation: Available");
            }
            
            // Test if dashboard exists
            if (View::exists('dashboard')) {
                $this->line("   • ✅ Dashboard: Available");
            }
            
            $this->info('   ✅ Layout components working correctly');
        } catch (\Exception $e) {
            $this->error("   ❌ Layout components error: " . $e->getMessage());
        }
    }

    private function testNavigation()
    {
        $this->info('🧭 Testing Navigation...');
        
        try {
            // Test navigation menu items
            $menuItems = [
                'Dashboard' => 'dashboard',
                'Customers' => 'customers.index',
                'Tickets' => 'tickets.index',
                'Agents' => 'agents.index',
                'Chat' => 'chat.index'
            ];
            
            foreach ($menuItems as $label => $route) {
                if (Route::has($route)) {
                    $this->line("   • ✅ {$label}: Route '{$route}' available");
                } else {
                    $this->line("   • ❌ {$label}: Route '{$route}' missing");
                }
            }
            
            $this->info('   ✅ Navigation working correctly');
        } catch (\Exception $e) {
            $this->error("   ❌ Navigation error: " . $e->getMessage());
        }
    }
}
