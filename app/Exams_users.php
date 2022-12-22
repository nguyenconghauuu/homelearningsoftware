<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exams_users extends Model
{
    public  $table = 'exams_users';

    public function question()
    {
        return $this->belongsTo(Questions::class,'eu_question_id');
    }
}
