<?php

namespace OtherApp\Provider;

class LivewireServiceProvider
{
    public function register()
    {
        $this->registerConfig();
        $this->registerComponentAutoDiscovery();
    }

    public function boot()
    {
        $this->registerRoutes();
    }

    protected function registerConfig()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/livewire.php', 'otherapp-livewire');

        config([
            'livewire.class_namespace' => config('backstage-livewire.class_namespace'),
            'livewire.view_path' => config('backstage-livewire.view_path'),
            'livewire.middleware_group' => config('backstage-livewire.middleware_group'),
            'livewire.manifest_path' => config('backstage-livewire.manifest_path'),
        ]);
    }

    protected function registerComponentAutoDiscovery()
    {
        $this->app->singleton(\Livewire\LivewireComponentsFinder::class, function () {
            return new \OtherApp\Livewire\LivewireComponentsFinder(
                new Filesystem,
                config('livewire.manifest_path'),
                config('backstage-livewire.components_path')
            );
        });
    }

    protected function registerRoutes()
    {
        Route::prefix(config('backstage-livewire.prefix'))->group(function () {
            Route::post('/livewire/message/{name}', HttpConnectionHandler::class)
                ->name('livewire.message')
                ->middleware(config('livewire.middleware_group', ''));

            Route::post('/livewire/upload-file', [FileUploadHandler::class, 'handle'])
                ->name('livewire.upload-file')
                ->middleware(config('livewire.middleware_group', ''));

            Route::get('/livewire/preview-file/{filename}', [FilePreviewHandler::class, 'handle'])
                ->name('livewire.preview-file')
                ->middleware(config('livewire.middleware_group', ''));

            Route::get('/livewire/livewire.js', [LivewireJavaScriptAssets::class, 'source']);
            Route::get('/livewire/livewire.js.map', [LivewireJavaScriptAssets::class, 'maps']);
        });
    }
}
