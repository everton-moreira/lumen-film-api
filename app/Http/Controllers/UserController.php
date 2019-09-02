<?php
namespace App\Http\Controllers;

use App\Models\User;

class UserController extends BaseController
{
    public function __construct()
    {
        $this->classe = User::class;
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
