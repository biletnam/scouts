<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schakeltje extends Model
{
    protected $fillable = ['title', 'url', 'archived', 'created_at', 'updated_at'];
}
