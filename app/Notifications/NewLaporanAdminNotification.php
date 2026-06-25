<?php

namespace App\Notifications;

use App\Models\Laporan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewLaporanAdminNotification extends Notification
{
    use Queueable;

    public Laporan $laporan;

    public function __construct(Laporan $laporan)
    {
        $this->laporan = $laporan;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        $pelaporName = $this->laporan->user->name ?? 'Pelapor';

        return [
            'laporan_id' => $this->laporan->id,
            'judul'      => $this->laporan->judul,
            'pelapor'    => $pelaporName,
            'type'       => 'laporan_baru',
            'message'    => "Laporan baru dari " . $pelaporName . ": \"" . $this->laporan->judul . "\"",
        ];
    }
}
