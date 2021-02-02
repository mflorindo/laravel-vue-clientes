<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u = new User();
        $u->name = 'teste';
        $u->email = 'teste@teste.com';
        $u->password = bcrypt('teste');
        $u->save();
    }
}
