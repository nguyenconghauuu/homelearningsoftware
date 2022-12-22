<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $table = 'questions';
    public    $timestamps = true;

    public function post()
    {
        return $this->belongsTo('App\Posts');
    }

    public function exams()
    {
        return $this->belongsToMany(Exams::class,'exams_users','eu_question_id','eu_exam_id');
    }
}
