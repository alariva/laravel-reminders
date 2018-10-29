<?php

namespace Alariva\Reminders;

use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Collection;

trait HasReminders
{
    public static function getReminderClassName(): string
    {
        return Reminder::class;
    }

    public function reminders(): MorphOne
    {
        $class = self::getReminderClassName();

        return $this
            ->morphOne($class, 'remindable')
            ->orderBy($class::CREATED_AT);
    }

    public function pendingReminders(): Collection
    {
        return $this->reminders()->where('status', Reminder::STATUS_PENDING)->get();
    }
}
