<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUsageByPeriod extends Model
{
    use HasFactory;

    /**
       * The table associated with the model.
       *
       * @var string
       */
      protected $table = 'data_usage_by_period';
}
