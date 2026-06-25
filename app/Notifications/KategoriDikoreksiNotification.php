<?php

namespace App\Notifications;

use App\Models\Laporan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class KategoriDikoreksiNotification extends Notification
{
    use Queueable;

    public Laporan $laporan;
    public string $kategoriLama;
    public string $kategoriBaru;

    public function __construct(Laporan $laporan, string $kategoriLama, string $kategoriBaru)
    {
        $this->laporan = $laporan;
        $this->kategoriLama = $kategoriLama;
        $this->kategoriBaru = $kategoriBaru;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'laporan_id'    => $this->laporan->id,
            'judul'         => $this->laporan->judul,
            'type'          => 'kategori_dikoreksi',
            'kategori_lama' => $this->kategoriLama,
            'kategori_baru' => $this->kategoriBaru,
            'pesan'         => "Admin telah memperbarui kategori laporan yang Anda pilih pada laporan \"" . $this->laporan->judul . "\" dari \"{$this->kategoriLama}\" menjadi \"{$this->kategoriBaru}\" karena tidak sesuai dengan judul dan isi laporan.",
        ];
    }
}
