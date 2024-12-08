<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RefereeNotification extends Notification
{
    use Queueable;
    public $loan;
    public $refereeName;

    /**
     * Create a new notification instance.
     */
    public function __construct($loan, $refereeName)
    {
        $this->loan = $loan;
        $this->refereeName = $refereeName;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail', 'database']; // Sends via email and in-app (database) notifications
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('You have been chosen as a guarantor')
            ->greeting("Hello {$this->refereeName},")
            ->line('You have been chosen as a guarantor for a loan application with the following details:')
            ->line("**Loan Amount:** {$this->loan->loan_amount}")
            ->line("**Loan Duration:** {$this->loan->loan_duration} months")
            ->line("**Principal Amount:** {$this->loan->principal_amount}")
            ->line("**Monthly Payments:** {$this->loan->monthly_payments}")
            ->line("**Description:** {$this->loan->description}")
            ->action('View Loan Details', url('/loans/' . $this->loan->id))
            ->line('Thank you for your support!');
    }

    /**
     * Get the array representation of the notification for in-app notifications.
     */
    public function toArray($notifiable)
    {
        return [
            'message' => "You have been chosen as a guarantor for a loan (ID: {$this->loan->id}).",
            'loan_id' => $this->loan->id,
            'loan_amount' => $this->loan->loan_amount,
            'loan_duration' => $this->loan->loan_duration,
            'principal_amount' => $this->loan->principal_amount,
            'monthly_payments' => $this->loan->monthly_payments,
            'description' => $this->loan->description,
        ];
    }
}