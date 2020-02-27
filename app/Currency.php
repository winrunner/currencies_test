<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = ['name', 'rate', 'date'];
    protected $hidden = ['created_at', 'updated_at'];
}
