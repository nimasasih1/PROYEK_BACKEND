<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AkunMahasiswaMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $nama;
    public string $nim;
    public string $password;

    public function __construct(string $nama, string $nim, string $password)
    {
        $this->nama     = $nama;
        $this->nim      = $nim;
        $this->password = $password;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🎓 Akun GRAD-System Horizon University',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.akun_mahasiswa',
        );
    }
}