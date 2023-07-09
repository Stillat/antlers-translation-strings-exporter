<?php

namespace Stillat\AntlersTranslationStringsExporter;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->app->singleton('translatable-string-exporter-exporter', function ($app) {
            return $app->make(AntlersExporter::class);
        });
    }
}
