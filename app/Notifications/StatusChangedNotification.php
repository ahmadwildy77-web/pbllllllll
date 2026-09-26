<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StatusChangedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected string $lombaName;
    protected string $newStatus;

    public function __construct(string $lombaName, string $newStatus)
    {
        $this->lombaName = $lombaName;
        $this->newStatus = $newStatus;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'lombaName' => $this->lombaName,
            'newStatus' => $this->newStatus,
            'message' => "Status rekomendasi Anda untuk lomba {$this->lombaName} telah diperbarui menjadi {$this->newStatus}."
        ];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $statusLabel = match ($this->newStatus) {
            'terpilih' => '✅ Direkomendasikan',
            'ditolak'  => '❌ Tidak Direkomendasikan',
            'divalidasi' => '🎉 Resmi Mengikuti Lomba',
            default    => '⏳ Pending',
        };

        $message = (new MailMessage)
            ->subject("SIREMA — Status Anda Diperbarui: {$this->lombaName}")
            ->greeting("Halo, {$notifiable->name}!")
            ->line("Status rekomendasi Anda untuk lomba **{$this->lombaName}** telah diperbarui.")
            ->line("**Status terbaru:** {$statusLabel}");

        if ($this->newStatus === 'terpilih') {
            $message->line('Anda telah direkomendasikan oleh Koordinator. Menunggu validasi akhir dari Kaprodi.');
        } elseif ($this->newStatus === 'divalidasi') {
            $message->line('Selamat! Rekomendasi Anda telah divalidasi dan Anda resmi menjadi peserta lomba ini.');
        } elseif ($this->newStatus === 'ditolak') {
            $message->line('Mohon maaf, Anda belum direkomendasikan untuk lomba ini kali ini. Tetap semangat!');
        }

        $message->action('Lihat Detail di SIREMA', url('/dashboard'))
                ->line('Terima kasih telah menggunakan SIREMA.');

        return $message;
    }
}
