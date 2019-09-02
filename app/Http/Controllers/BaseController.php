<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

abstract class BaseController
{
    protected $classe;

    public function index(Request $request)
    {
        $query = $this->classe;
        $regPerPage = ($request->per_page ? $request->per_page : '15');
        $order = ($request->order ? $request->order : 'asc');
        $orderBy = ($request->order_by ? $request->order_by : 'asc');
        $currPage = ($request->page ? $request->page : '1');

        //$query->simplePaginate($regPerPage);
        //return response()->json($request->per_page, Response::HTTP_NOT_FOUND);
        return $this->classe::paginate($request->per_page);
    }

    public function getAll()
    {
        return $this->classe::get();
    }

    public function findData($field, $value)
    {
        $recurso = $this->classe::where($field, '=', $value)->get();
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

    public function update($field, $value, Request $request)
    {
        $recurso = $this->classe::where($field, '=', $value)->first();
        if (is_null($recurso)) {
            return response()->json([
                'erro' => 'Registro não encontrado'
            ], Response::HTTP_NOT_FOUND);
        }
        $recurso = $this->classe::where($field, $value)->update($request->all());
        return response()->json('', Response::HTTP_OK);
    }

    public function destroy($field, $value)
    {
        $qtdRemovidos = $this->classe::where($field, '=', $value)->get();
        if (is_null($qtdRemovidos)) {
            return response()->json([
                'erro' => 'Registro não encontrado'
            ], Response::HTTP_NOT_FOUND);
        }
        $this->classe::where($field, '=', $value)->delete();
        return response()->json('', Response::HTTP_OK);
    }
}
