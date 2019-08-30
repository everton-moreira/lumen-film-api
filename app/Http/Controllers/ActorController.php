<?php
namespace App\Http\Controllers;

use App\Models\Actor;

class ActorController extends BaseController
{
    public function __construct()
    {
        $this->classe = Actor::class;
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
