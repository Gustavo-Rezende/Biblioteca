<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        //
    }
}
