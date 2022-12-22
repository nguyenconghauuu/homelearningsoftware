<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    protected $table = 'exam_result';
    protected $guarded = [''];

    public function user()
    {
        return $this->belongsTo(User::class,'er_user_id');
    }

    public function category()
    {
        return $this->belongsTo(CategoryPosts::class,'category_id');
    }

    public function exams_users()
    {
        return $this->hasMany(Exams_users::class,'eu_exam_id');
    }
}
