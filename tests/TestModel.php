<?php

namespace Alariva\Reminders\Test;

use Alariva\Reminders\HasReminders;
use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{
    use HasReminders;

    public $table = 'test_models';

    protected $guarded = [];

    public $timestamps = false;
}
