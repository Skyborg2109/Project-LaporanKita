<?php

namespace App\Notifications;

use App\Models\Laporan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LaporanStatusNotification extends Notification
{
    use Queueable;

    public Laporan $laporan;
    public string $pesan;

    public function __construct(Laporan $laporan, string $pesan = '')
    {
        $this->laporan = $laporan;
        $this->pesan = $pesan;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        $statusLabel = match($this->laporan->status) {
            'diproses' => 'Sedang Diproses',
            'selesai'  => 'Selesai',
            'baru'     => 'Baru Diterima',
            default    => ucfirst($this->laporan->status),
        };

        return [
            'laporan_id' => $this->laporan->id,
            'judul'      => $this->laporan->judul,
            'status'     => $this->laporan->status,
            'status_label' => $statusLabel,
            'pesan'      => $this->pesan ?: "Status laporan Anda \"" . $this->laporan->judul . "\" telah diperbarui menjadi '{$statusLabel}'.",
        ];
    }
}
