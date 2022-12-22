<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryPosts extends Model
{
    protected $table = 'categoryposts';
    protected $fillable = ['cpo_name', 'updated_at','id','cpo_type','cpo_parent_id','created_at'];
    public    $timestamps = true;

    public static function recursive($listPostCategory ,$parents = 0 ,$level = 1 ,&$CategoryPostListSort)
    {
        if(count($listPostCategory) > 0 )
        {
            foreach ($listPostCategory as $key => $value) {
                if($value->cpo_parent_id  == $parents)
                {
                    $value->level = $level;
                    $CategoryPostListSort[] = $value;
                    unset($listPostCategory[$key]);
                    $newparents = $value->id;
                    self::recursive($listPostCategory , $newparents ,$level + 1 , $CategoryPostListSort);
                }
            }
        }
    }
}
