<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailAniversario extends Mailable
{
    use Queueable, SerializesModels;

    public $nomeLeitor;
    public $totalLivrosLidos;
    public $totalPaginasLidas;

    /**
     * Create a new message instance.
     */
    public function __construct($leitor, $dadosCache)
    {
        $this->nomeLeitor = $leitor->nome;
        $this->totalLivrosLidos = $dadosCache['totalLidos'];
        $this->totalPaginasLidas = $dadosCache['totalPaginas'];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Email Aniversario',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'EmailAniversario',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
