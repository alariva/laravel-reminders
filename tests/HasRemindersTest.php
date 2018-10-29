<?php

namespace Alariva\Reminders\Test;

use Alariva\Reminders\Reminder;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class HasRemindersTest extends BaseTestCase
{
    /** @var \Alariva\Reminders\Test\TestModel */
    protected $testModel;

    public function setUp()
    {
        parent::setUp();

        $this->testModel = TestModel::create(['name' => 'default']);
    }

    /** @test */
    public function it_provides_a_reminders_relation()
    {
        $this->assertInstanceOf(MorphOne::class, $this->testModel->reminders());
    }

    /** @test */
    public function it_can_create_many_related_reminders()
    {
        $testModel = TestModel::create(['name' => 'default']);

        $reminderOne = $testModel->reminders()->create(['notes' => 'remember the milk']);
        $reminderTwo = $testModel->reminders()->create(['notes' => 'remember the eggs']);
        $reminderThree = $testModel->reminders()->create(['notes' => 'remember the awesome']);

        $this->assertCount(3, $testModel->reminders()->get());
    }

    /** @test */
    public function it_can_get_all_pending_reminders()
    {
        $testModel = TestModel::create(['name' => 'default']);

        $reminderPending = $testModel->reminders()->create(['notes' => 'remember the milk', 'status' => Reminder::STATUS_PENDING]);

        $this->assertCount(1, $testModel->pendingReminders());
    }
}
