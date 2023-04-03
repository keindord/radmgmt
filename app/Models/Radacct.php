<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radacct extends Model
{

  /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'radacct';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'radacctid';

    const CREATED_AT = 'acctstarttime';

    public $timestamps = false;

    protected $fillable = ['acctsessionid', 'acctuniqueid','nasipaddress'];

    use HasFactory;

    public function scopeFilter($query, array $filters)
    {
      $query->when($filters['search'] ?? false, function ($query, $search)
      {
        $query
        ->where('username', 'like', '%' . $search . '%')
        ->orderBy('acctstarttime')
        ->oldest()
        ->limit(10)
        ->get();
      });
    }
}
