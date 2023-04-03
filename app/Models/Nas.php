<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nas extends Model
{
  /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'nas';

    protected $guarded = ['id'];
    // protected $fillable = ['acctsessionid', 'acctuniqueid','nasipaddress'];

    use HasFactory;
}
