<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendRecruitmentEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->from($this->data['from_email'], $this->data['from_name'])
            ->subject('Hasil Pendaftaran Event ' . $this->data['event'])
            ->view('emails.recruitment')
            ->with('event', $this->data['event'])
            ->with('student_name', $this->data['student_name'])
            ->with('student_code', $this->data['student_code'])
            ->with('event_division', $this->data['event_division'])
            ->with('link_group_wa', $this->data['link_group_wa'])
            ->with('status', $this->data['status']);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Recruitment Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.send-recruitment-email',
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
