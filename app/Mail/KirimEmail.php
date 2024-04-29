<?php

namespace App\Mail;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class KirimEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }
    

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {      
        $subject = "";      
        if($this->details['mulai'] == '-'){
            $subject = "Pengajuan BMT";
        }elseif($this->details['mulai'] == '2'){
            $subject = "Notifikasi ".$this->details['kategori'];
        }elseif($this->details['mulai'] == '3'){
            $subject = "Notifikasi Reset Password ";
        }else{
            $subject = "Pengajuan Cuti Karyawan";
        }
        $data = [
            'subject' => $subject,
            ];
        return $this->subject($data['subject'])->view('notif.kirimemail');
    }
}
  