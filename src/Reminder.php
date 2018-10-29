<?php

namespace Alariva\Reminders;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    public $guarded = [];

    public const STATUS_PENDING = 'pending';
    public const STATUS_DONE = 'done';
    public const STATUS_CANCELED = 'canceled';

    public function markPending()
    {
        $this->status = self::STATUS_PENDING;

        return $this->save();
    }

    public function markDone()
    {
        $this->status = self::STATUS_DONE;

        return $this->save();
    }

    public function cancel()
    {
        $this->status = self::STATUS_CANCELED;

        return $this->save();
    }
}
