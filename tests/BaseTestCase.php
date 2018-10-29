<?php

namespace Alariva\Reminders\Test;

use Alariva\Reminders\Reminder;
use Alariva\Reminders\RemindersServiceProvider;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class BaseTestCase extends OrchestraTestCase
{
    protected function setUp()
    {
        parent::setUp();

        $capsule = new Capsule();

        $capsule->addConnection([
            'driver'   => 'sqlite',
            'database' => ':memory:',
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        Capsule::schema()->create('reminders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('notes')->nullable();
            $table->string('remindable_id')->integer()->unsigned();
            $table->string('remindable_type');
            $table->string('status')->default(Reminder::STATUS_PENDING);
            $table->timestamps();
        });

        Capsule::schema()->create('test_models', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Load package service provider
     *
     * @param  \Illuminate\Foundation\Application $app
     *
     * @return Alariva\Reminders\RemindersServiceProvider
     */
    protected function getPackageProviders($app)
    {
        return [RemindersServiceProvider::class];
    }
}
