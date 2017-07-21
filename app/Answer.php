<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public static $answer_validation_rules = [
        'answer' => 'required',
    ];
}
