<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Radgroupcheck;


class RadgroupcheckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Radgroupcheck::all());
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
      $post = Radgroupcheck::create($request->all());

      return response()->json([
          'status' => true,
          'message' => "Radgroupcheck created successfully!",
          'post' => $post
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
        return response()->json(Radgroupcheck::where('id', $id)->get());
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
      $update = Radgroupcheck::where('id', $id);

      if($update->update($request->all())) {
        return response()->json([
            'status' => true,
            'message' => "Radgroupcheck updated successfully!",
            'update' => $update->get(),
        ], 200);
      }else {
        return response()->json([
          'status' => false,
          'message' => "Can not update register"
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
      $destroy = Radgroupcheck::where('id', $id);

      if($destroy->delete()) {
        return response()->json([
          'status' => true,
          'message' => "Radgroupcheck delete successfully!"
        ], 200);
      } else {
        return response()->json([
          'status' => false,
          'message' => "Can not delete Radgroupcheck register!"
        ], 204);
      }
    }
}
