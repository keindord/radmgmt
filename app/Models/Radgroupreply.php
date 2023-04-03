<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radgroupreply extends Model
{
  /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'radgroupreply';

    protected $guarded = ['id'];

    use HasFactory;
}
