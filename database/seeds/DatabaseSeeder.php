<?php

use Illuminate\Database\Seeder;
use App\audios;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        User::create([
            'name'	 => "administrador",
            'email' =>	"jmartinezmateos@iesesteveterradas.cat",
            'password' => Hash::make( '1234' ),
        ]);

        $canciones = array(
            0 => 'kick.mp3',
            1 => 'snare.mp3',
            2 => 'tom.wav',
            3 => 'hit_hat.wav',
            4 => 'crash.mp3',
            5 => 'tom_low.wav',
        );

        for ($i=0; $i<6; $i++){
            audios::create([
                'id_usuario' =>	1,
                'nombre'	 => $canciones[$i],
            ]);
        }
        var_dump("hecho");
    }
}
