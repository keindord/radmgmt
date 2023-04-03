<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radreply extends Model
{
  /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'radreply';

    protected $guarded = ['id'];

    use HasFactory;
}
