<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    // comment
    protected $fillable=['name','description','price','category_id'];
}
