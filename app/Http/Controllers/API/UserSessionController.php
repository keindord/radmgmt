<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return response()->json(DB::table('radacct')->select(DB::raw('count(distinct radacct.callingstationid)'))
        ->whereRaw('username in (select distinct username from radcheck)
        and acctstoptime is null')->get()
      );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Radacct  $radacct
     * @return \Illuminate\Http\Response
     */
    public function show($branch)
    {
      $sucursales = [
        'VIG' =>  'value like \'%-VL80%\'',
        'SC'  =>  'value like \'%-74\' or value like \'%-39%\' or value like \'%-63%\' or value like \'%-64%\'',
        'MRD' =>  'value like \'%-VL75%\' or value like \'%-VL76%\' or value like \'%-VL77%\' or value like \'%-VL78%\' or value like \'%-VL79%\'',
        'CLN' =>  'value like \'%-VL72%\'',
        'CLC' =>  'value like \'%-VL66%\'',
        'LFR' =>  'value like \'%-VL67%\'',
        'SA'  =>  'value like \'%-VL81%\'',
        'VLR' =>  'value like \'%-VL61%\'',
        'CJS' =>  'value like \'%-VL65%\'',
        'CCS' =>  'value like \'%-3021%\'',
        'BOC' =>  'value like \'%-VL62%\'',
        'MBO' =>  'value like \'%-VL18%\' or value like \'%-VL19%\' or value like \'%-VL20%\' or value like \'%-VL21%\'',
        'MCH' =>  'value like \'%-VL68%\'',
        'PZO' =>  'value like \'%-VL74-PZO\' or value like \'%-VL92%\''
      ];

      if(array_key_exists($branch, $sucursales))
        $query = $sucursales[$branch];
      else
        return response()->json([
          'status'  =>  'Error',
          'message' =>  'Branch not found'
        ], 404);

      return response()->json(DB::table('radacct')->select(DB::raw('count(distinct radacct.callingstationid)'))
        ->whereRaw('username in (select distinct username from radcheck where ' . $query . ')
        and acctstoptime is null')->get(), 200
      );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Radacct  $radacct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Radacct $radacct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Radacct  $radacct
     * @return \Illuminate\Http\Response
     */
    public function destroy(Radacct $radacct)
    {
        //
    }
}
