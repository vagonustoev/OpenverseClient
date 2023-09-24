<?php

namespace OpenverseClient;

use Illuminate\Support\ServiceProvider;

class OpenverseServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/openverse.php' => config_path('openverse.php'),
        ]);
    }
}
