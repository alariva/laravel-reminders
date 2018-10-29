<?php

namespace Alariva\Reminders;

use Illuminate\Support\ServiceProvider;

class RemindersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            if (!class_exists('CreateRemindersTables')) {
                $timestamp = date('Y_m_d_His', time());
                $this->publishes([
                    __DIR__.'/../database/migrations/create_reminders_tables.php.stub' => database_path('migrations/'.$timestamp.'_create_reminders_tables.php'),
                ], 'migrations');
            }

            $this->publishes([
                __DIR__.'/../config/reminders.php' => config_path('reminders.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // ...
    }
}
