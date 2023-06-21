<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCitasRequest;
use App\Http\Requests\UpdateCitasRequest;
use App\Http\Resources\CitasResources;
use App\Models\Citas;

class CitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CitasResources::collection(Citas::all());
        // return Citas::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCitasRequest $request)
    {
        $cita = Citas::create($request->validated());

        return CitasResources::make($cita);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $citas = Citas::select()
            ->get();

        return response()->json([
            'citas' => $citas,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Citas $citas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCitasRequest $request, Citas $citas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Citas $citas)
    {
        //
    }
}
