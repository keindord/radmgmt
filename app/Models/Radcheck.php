<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radcheck extends Model
{

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'radcheck';

    protected $guarded = ['id'];

    use HasFactory;

}
