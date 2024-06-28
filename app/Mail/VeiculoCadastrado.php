<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Veiculo;

class VeiculoCadastrado extends Mailable
{
    use Queueable, SerializesModels;

    public $veiculo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Veiculo $veiculo)
    {
        $this->veiculo = $veiculo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->view('emails.veiculo_cadastrado')
            ->subject('Cadastro de Veículo Concluído')
            ->with([
                'id' => $this->veiculo->id,
                'modelo' => $this->veiculo->modelo,
            ]);
    }
}
