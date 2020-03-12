<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->CodCon = '21287654';        
        $user->email = "redadonai@iglesiaprimitiva.com";
        $user->usuario = "jperaltag";        
        $user->password = bcrypt('123456');
        $user->condicion = 1;
        $user->save();

        $user->roles()->attach([
            'role_id' => 1 // Correponde al rol Administrator
        ]);

        $user = new User();
        $user->CodCon = '41192360';        
        $user->email = "redshadai@iglesiaprimitiva.com";
        $user->usuario = "jsalvah";        
        $user->password = bcrypt('123456');
        $user->condicion = 1;
        $user->save();

        $user->roles()->attach([
            'role_id' => 1 // Correponde al rol Administrator
        ]);

        $user = new User();
        $user->CodCon = '40856025';        
        $user->email = "redyeshua@iglesiaprimitiva.com";
        $user->usuario = "rperaltag";        
        $user->password = bcrypt('123456');
        $user->condicion = 1;
        $user->save();
         
        $user->roles()->attach([
            'role_id' => 1 // Correponde al rol Administrator
        ]);

        $user = new User();
        $user->CodCon = '21287549';        
        $user->email = "redemanuel@iglesiaprimitiva.com";
        $user->usuario = "jcardenasz";        
        $user->password = bcrypt('123456');
        $user->condicion = 1;
        $user->save();

        $user->roles()->attach([
            'role_id' => 1 // Correponde al rol Administrator
        ]);

    }
}
