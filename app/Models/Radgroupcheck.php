<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radgroupcheck extends Model
{
  /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'radgroupcheck';

    protected $guarded = ['id'];

    use HasFactory;
}
