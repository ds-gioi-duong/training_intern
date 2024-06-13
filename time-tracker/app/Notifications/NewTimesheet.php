<?php

namespace App\Notifications;
use App\Models\Timesheet;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewTimesheet extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Timesheet $timesheet)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject("New Timesheet from {$this->timesheet->user->username}")
                    ->greeting("New Timesheet from {$this->timesheet->user->username}")
                    ->line(Str::limit($this->timesheet->difficulties, 50))
                    ->action('Go to Timesheet', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
