<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dojo extends Model
{
    protected $fillable = ['name', 'location', 'description'];

    /** @use HasFactory<\Database\Factories\DojoFactory> */
    use HasFactory;


    //一个道场 可以拥有 多位忍者
     public function ninas()
    {
        return $this->hasMany(Ninja::class);
    }

    //一个道场 可以拥有 多本秘籍
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
