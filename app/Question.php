<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public static $question_validation_rules = [
        'title' => 'required',
        'description' => 'required',
        'tags' => 'required',
        'category' => 'required',
    ];
}
