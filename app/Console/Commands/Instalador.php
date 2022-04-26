<?php

namespace App\Console\Commands;

use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isNull;

class Instalador extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tutoblog:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este commando ejecuta el instalador inicial del proyecto';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(){

        if(!$this->verificar()){
            $rol = $this->crearRolSuperAdmin();
            $usuario = $this->crearUsuarioSuperAdmin();
            $usuario->roles()->attach($rol);
            $this->info('El Rol y Usuario Administrador se instalaron correctamente !!! ');

        } else {
            $this->error('No se puede ejecutar el instalador porque ya existe el Rol Id 1');
        }
    }

    private function verificar(){
       return Rol::find(1);
    }

    private function crearRolSuperAdmin(){
        $rol = "Super Administrador";
        return Rol::create([
            'nombre' => $rol,
            'slug' => Str::slug($rol, '_')
        ]);
    }

    private function crearUsuarioSuperAdmin(){

        return Usuario::create([
            'nombre' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'estado' => 1
        ]);
    }
}
