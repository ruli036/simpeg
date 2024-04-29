<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GajiFixNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->from('alazharcairobna@gmail.com', 'Al-Azhar Cairo Banda Aceh') 
        ->greeting('Assalamualaikum Wr. Wb ' . $notifiable->name.' dengan nomor nik '.$notifiable->nik) 
        ->line('Kami ingin memberitahu Anda bahwa Anda sekarang dapat memeriksa gaji Anda bulan '.date('F Y', strtotime(now())).' melalui situs web al-azhar cairo banda aceh')
        ->line('Kunjungi halaman "Gaji" di situs web al-azhar cairo banda aceh untuk melihat detail gaji Anda, termasuk pendapatan bulanan, tunjangan, dan lainnya')
        ->line('Beberapa keluhan perihal rincian gaji sudah selesai di perbaiki, jika anda tidak punya keluhan abaikan notifikasi ini.')
        ->action('Link Website', url('https://karyawan.alazharcairobna.sch.id/'))
        ->line('Terima kasih atas kerja keras Anda dan semoga Anda memiliki hari yang menyenangkan!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
