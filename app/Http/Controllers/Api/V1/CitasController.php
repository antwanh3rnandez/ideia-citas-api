<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCitasRequest;
use App\Http\Requests\UpdateCitasRequest;
use App\Http\Resources\CitasResources;
use App\Models\Citas;
use Illuminate\Http\Request;

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
    // public function show(Request $request)
    // {
    //     $citas = Citas::select()
    //         ->get();

    //     return response()->json([
    //         'citas' => $citas,
    //     ]);
    // }
    public function show(Request $request)
    {
        $limit = $request->get('limit', 25);
        $offset = $request->get('offset', 0);
        $searchTerm = $request->get('searchTerm', null);

        $citasQuery = Citas::query();

        // Aplicar filtros de búsqueda si se proporciona un término de búsqueda
        if ($searchTerm) {
            $citasQuery->where('name', 'LIKE', '%' . $searchTerm . '%');
        }

        $total = $citasQuery->count();

        $citas = $citasQuery
            ->skip($offset)
            ->take($limit)
            ->get();

        return response()->json([
            'citas' => $citas,
            'total' => $total,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $type, $id)
    {
        if ($type !== 'contacted' && $type !== 'answer' || !isset($id) || !is_numeric($id)) 
        {
            return response()->json([
                'response' => false,
                'message' => 'Parametros incorrectos',
            ], 200);
        }else{

            if ($type == 'contacted') {
                 $typeText = 'contactado';
            }else{
                $typeText = 'respuesta';
            }

            $updateCita = Citas::where('id', $id)
                ->update([$type => 1]);

            return response()->json([
                'response' => true,
                'message' => 'La cita con id '.$id.' ha sido actualizada en ' . $typeText,
            ], 200);

        }
    }

    public function getMessageById(Request $request, $id)
    {
        if (!isset($id) || !is_numeric($id)) 
        {
            return response()->json([
                'response' => false,
                'message' => 'Parametros incorrectos',
            ], 200);
        }else{

            $comment = Citas::where('id', $id)
                ->value('comment');

            return response()->json([
                'response' => true,
                'comment' => $comment,
            ], 200);

        }
    }

    public function updateMessageById(Request $request, $id, $comment)
    {
        if (!isset($comment) || !is_string($comment) || !isset($id) || !is_numeric($id)) 
        {
            return response()->json([
                'response' => false,
                'message' => 'Parametros incorrectos',
            ], 200);
            
        }else{

            $updateCommentCita = Citas::where('id', $id)
                ->update(['comment' => $comment]);

            return response()->json([
                'response' => true,
                'message' => 'Ha sido actualizado el comentario con el id: ' .$id,
            ], 200);

        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Citas $citas)
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
