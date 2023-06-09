<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Radcheck;

class RadcheckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return response()->json(Radcheck::limit(100)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $register = Radcheck::create($request->all());

      return response()->json([
          'status' => true,
          'message' => "Radcheck created successfully!",
          'register' => $register
      ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return response()->json(Radcheck::where('id', $id)->get());

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $register = Radcheck::where('id', $id);

      if($register->update($request->all())) {
        return response()->json([
            'status' => true,
            'message' => "Radcheck updated successfully!",
            'register' => $register->get(),
        ], 200);
      } else {
        return response()->json([
          'status' => false,
          'message' => "Can not update register!"
        ], 203);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $register = Radcheck::where('id', $id);

        if($register->delete()) {
          return response()->json([
            'status' => true,
            'message' => "Radcheck delete successfully!"
          ], 200);
        } else {
          return response()->json([
            'status' => false,
            'message' => "Can not delete Radcheck register!"
          ], 204);
        }
    }
}
