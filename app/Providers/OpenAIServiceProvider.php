<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use OpenAI;

class OpenAIServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('openai', function ($app) {
            $config = $app['config']['services.openai'];

            if (empty($config['api_key'])) {
                throw new \RuntimeException('OpenAI API key not configured.');
            }

            return OpenAI::client(
                $config['api_key'],
                $config['organization'] ?? null
            );
        });
    }

    public function provides()
    {
        return ['openai'];
    }
}
