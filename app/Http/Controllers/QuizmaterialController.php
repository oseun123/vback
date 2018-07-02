<?php

namespace App\Http\Controllers;

use App\Quizmaterial;
use Illuminate\Http\Request;
use App\Http\Resources\MaterialResource;

class QuizmaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MaterialResource::collection(Quizmaterial::all());
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
     * @param  \App\Quizmaterial  $quizmaterial
     * @return \Illuminate\Http\Response
     */
    public function show(Quizmaterial $quizmaterial)
    {
        // return new MaterialResource($quizmaterial);
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quizmaterial  $quizmaterial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quizmaterial $quizmaterial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quizmaterial  $quizmaterial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quizmaterial $quizmaterial)
    {
        //
    }
}
