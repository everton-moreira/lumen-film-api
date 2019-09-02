<?php
namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Models\Actor;

class ActorController extends BaseController
{
    public function __construct()
    {
        $this->classe = Actor::class;
    }

    public function filter($field, $value, Request $request)
    {
        $recurso = $this->classe::where($field, 'like', $value."%")->get();
        if (is_null($recurso)) {
            return response()->json('', Response::HTTP_NOT_FOUND);
        }
        $recurso = $this->classe::where($field, 'like', $value."%")->paginate($request->per_page);
        return response()->json($recurso, Response::HTTP_OK);
    }

    /*
    public function buscaPorSerie(int $serieId)
    {
        $episodios = Episodio::query()
            ->where('serie_id', $serieId)
            ->paginate();

        return $episodios;
    }
    */
}
