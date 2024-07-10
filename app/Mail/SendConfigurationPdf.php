<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class SendConfigurationPdf extends Mailable
{
    use Queueable, SerializesModels;
    public $pdfPath;
    public $data;

    public function __construct($pdfPath, $data)
    {
        $this->pdfPath = $pdfPath;
        $this->data = $data;
    }


    //Note to myself: Alternative syntax for small emails

    /*  public function build()
    {
        return $this->view('carConfigurationPdf')
            ->attach($this->pdfPath)
            ->with([
                'configurationData' => $this->data,
            ]);
    } */



    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->data['personalData']['email'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'carConfigurationPdf',
            with: [
                'validatedData' => $this->data,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->pdfPath)
        ];
    }
}




//***NOTE FOR MYSELF - ALTERNATIVE CONTROLLER SYNTAX FOR SMALL EMAILS

/*   Mail::send('emails.configuration', ['data' => $data], function ($message) use ($pdfPath, $data) {
            $message->to($data['personalData']['email'])
                    ->subject('Your Car Configuration')
                    ->attach($pdfPath);
        }); */