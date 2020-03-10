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
        $user->CodCon = '47403238';        
        $user->email = "tony@iglesiaprimitiva.com";
        $user->usuario = "aaguirreh";        
        $user->password = bcrypt('123456');
        $user->condicion = 1;
        $user->save();

        $user = new User();
        $user->CodCon = '21287654';        
        $user->email = "redadonai@iglesiaprimitiva.com";
        $user->usuario = "jperaltag";        
        $user->password = bcrypt('123456');
        $user->condicion = 1;
        $user->save();

        $user = new User();
        $user->CodCon = '44075429';
        $user->email = "fredycordova@iglesiaprimitiva.com";
        $user->usuario = "fcordovaq";        
        $user->password = bcrypt('123456');
        $user->condicion = 1;
        $user->save();        

        $user = new User();
        $user->CodCon = 'NC005181';
        $user->email = "julberore@iglesiaprimitiva.com";
        $user->usuario = "jorec";        
        $user->password = bcrypt('123456');
        $user->condicion = 1;
        $user->save();


    }
}
