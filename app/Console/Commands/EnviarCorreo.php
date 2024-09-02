<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\Mail\confirmation;
use App\Mail\CorreoVacio;
use App\Models\Clientes;
use Carbon\Carbon;

class EnviarCorreo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:sendEmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envio de correos Diarios';

    /**
     * Execute the console command.
     */
    public function handle()
    {   
        $day = Carbon::now()->get('day');
        $clientes = Clientes::where('Dia_de_pago','=',$day)->get(['Nombre'])->toArray();
        if($clientes == null){
            Mail::to('learbegoyt957@gmail.com')->send(new CorreoVacio());
        }else{
            Mail::to('learbegoyt957@gmail.com')->send(new confirmation($clientes));
        }
    }
}
