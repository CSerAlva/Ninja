<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['name', 'dojo_id', 'status', 'name', 'ninja_id', 'description',];

    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    //*一本秘籍 只属于 一个道场
    public function dojo()
    {
        return $this->belongsTo(Dojo::class);
    }
    //一本秘籍 只属于 一位忍者 编写
    public function ninja()
    {
        return $this->belongsTo(Ninja::class,'ninja_id','id');
    }
}
