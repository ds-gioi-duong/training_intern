<?php
namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use MailerSend\Helpers\Builder\Personalization;
use MailerSend\Helpers\Builder\Variable;
use MailerSend\LaravelDriver\MailerSendTrait;

class TimesheetCreated extends Mailable
{
    use Queueable, SerializesModels, MailerSendTrait;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Test Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // Kiểm tra nếu biến $this->to có ít nhất một phần tử
        if (isset($this->to[0]['address'])) {
            $to = $this->to[0]['address'];
        } else {
            // Gán giá trị mặc định hoặc xử lý lỗi
            $to = 'default@example.com';  // thay thế bằng giá trị mặc định hoặc báo lỗi
        }

        // Additional options for MailerSend API features
        $this->mailersend(
            template_id: null,
            variables: [
                new Variable($to, ['name' => 'Your Name'])
            ],
            tags: ['tag'],
            personalization: [
                new Personalization($to, [
                    'var' => 'variable',
                    'number' => 123,
                    'object' => [
                        'key' => 'object-value'
                    ],
                    'objectCollection' => [
                        [
                            'name' => 'John'
                        ],
                        [
                            'name' => 'Patrick'
                        ]
                    ],
                ])
            ],
            precedenceBulkHeader: true,
            sendAt: new Carbon('2022-01-28 11:53:20'),
        );

        return new Content(
            view: 'emails.test_html',
            text: 'emails.test_text'
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    //  */
    // public function attachments(): array
    // {
    //     // Kiểm tra sự tồn tại của tệp trước khi đính kèm
    //     if (Storage::disk('public')->exists('example.png')) {
    //         return [
    //             Attachment::fromStorageDisk('public', 'example.png')
    //         ];
    //     }

    //     return [];
    // }
}
