<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Todo extends Model
{
    use HasFactory;

    public function scopeSearchKeyword($query, $keyword)
    {
        if(!is_null($keyword))
        {
            $spaceConvert = mb_convert_kana($keyword,'s'); //全角スペースを半角に
            $keywords = preg_split('/[\s]+/', $spaceConvert,-1,PREG_SPLIT_NO_EMPTY); //空白で区切る
            foreach($keywords as $word) //単語をループで回す
            {
            $query->where('todos.title','like','%'.$word.'%');
            }
            return $query; 
        } else {
            return;
        }
    }     

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
