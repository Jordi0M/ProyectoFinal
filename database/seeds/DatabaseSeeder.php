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
            'password' => Hash::make( '12345678' ),
        ]);
        User::create([
            'name'	 => "a",
            'email' =>	"a@a",
            'password' => Hash::make( '12345678' ),
        ]);

        $canciones = array(
            0 => 'kick.mp3',
            1 => 'snare.mp3',
            2 => 'tom.wav',
            3 => 'hit_hat.mp3',
            4 => 'crash.mp3',
            5 => 'tom_low.wav',
        );

        $canciones_sin_extension = array(
            0 => 'kick',
            1 => 'snare',
            2 => 'tom',
            3 => 'hit_hat',
            4 => 'crash',
            5 => 'tom_low',
        );

        for ($i=0; $i<6; $i++){
            audios::create([
                'id_usuario' =>	1,
                'nombre_original'	 => $canciones[$i],
                'nombre_link'	 => $canciones[$i],
                'nombre_mostrar'	 => $canciones_sin_extension[$i],
            ]);
        }
        var_dump("hecho");
    }
}
