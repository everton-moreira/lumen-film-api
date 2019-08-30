<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

abstract class BaseController
{
    protected $classe;

    public function index(Request $request)
    {
        return $this->classe::paginate($request->per_page);
    }
    
    public function searchOne($where)
    {
        $recurso = $this->classe::where([$where])->get();

        if (is_null($recurso)) {
            return response()->json('', Response::HTTP_NOT_FOUND);
        }

        return response()->json($recurso, Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        try {
            return response()
            ->json(
                $this->classe::create($request->all()),
                Response::HTTP_CREATED
            );
        } catch(QueryException $e) {
            return response()->json(['erro'=> $e->message()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }

    public function update(int $id, Request $request)
    {
        $recurso = $this->classe::find($id);
        if (is_null($recurso)) {
            return response()->json([
                'erro' => 'Registro não encontrado'
            ], Response::HTTP_NOT_FOUND);
        }
        $recurso->fill($request->all());
        $recurso->save();

        return $recurso;
    }

    public function destroy(int $id)
    {
        $qtdRemovidos = $this->classe::destroy($id);
        if ($qtdRemovidos === 0) {
            return response()->json([
                'erro' => 'Registro não encontrado'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json('', Response::HTTP_OK);
    }
}
