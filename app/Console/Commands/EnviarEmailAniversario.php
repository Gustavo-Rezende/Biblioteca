<?php

namespace App\Console\Commands;

use App\Models\Leitores;
use App\Mail\EmailAniversario;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class EnviarEmailAniversario extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'enviar:emailAniversario';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar e-mail de aniversário para os leitores';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $leitores = Leitores::buscarLeitoresPorDataAniversario();
        foreach ($leitores as $leitor) {

            $id = $leitor->id;
            $email = $leitor->email;

            $dadosCache = Redis::hgetall($id); //retorna quantidade de livros e paginas


            Mail::to($email)->send(new EmailAniversario($leitor, $dadosCache));
        }
        $this->info('E-mails enviados com sucesso!');
    }
}
