<?php

namespace Alariva\Reminders\Test;

use Alariva\Reminders\Reminder;

class ReminderTest extends BaseTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->assertCount(0, Reminder::all());
    }

    /** @test */
    public function it_can_create_a_reminder()
    {
        $testModel = TestModel::create(['name' => 'default']);

        $reminder = $testModel->reminders()->create(['notes' => 'remember the milk']);

        $this->assertCount(1, Reminder::all());
        $this->assertSame('remember the milk', $reminder->notes);
    }

    /** @test */
    public function it_can_mark_pending()
    {
        $testModel = TestModel::create(['name' => 'default']);

        $reminder = $testModel->reminders()->create(['notes' => 'remember the milk']);

        $reminder->markPending();

        $this->assertSame(Reminder::STATUS_PENDING, $reminder->status);
    }

    /** @test */
    public function it_can_cancel()
    {
        $testModel = TestModel::create(['name' => 'default']);

        $reminder = $testModel->reminders()->create(['notes' => 'remember the milk']);

        $reminder->cancel();

        $this->assertSame(Reminder::STATUS_CANCELED, $reminder->status);
    }

    /** @test */
    public function it_can_mark_done()
    {
        $testModel = TestModel::create(['name' => 'default']);

        $reminder = $testModel->reminders()->create(['notes' => 'remember the milk']);

        $reminder->markDone();

        $this->assertSame(Reminder::STATUS_DONE, $reminder->status);
    }
}
