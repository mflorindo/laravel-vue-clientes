<?php

namespace Database\Seeders;

use App\Models\Cidade;
use Illuminate\Database\Seeder;

class CidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cidades = ['Florianópolis','Porto Alegre','São Paulo','Rio de Janeiro','Paraná'];

        foreach ($cidades as $cid) {
            $c = new Cidade();
            $c->nome = $cid;
            $c->save();
        }

    }
}
