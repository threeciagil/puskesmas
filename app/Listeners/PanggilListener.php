<?php

namespace App\Listeners;

use App\Events\PanggilPendaftaranEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PanggilListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PanggilPendaftaranEvent  $event
     * @return void
     */
    public function handle(PanggilPendaftaranEvent $event)
    {   
        $datas = [
            'no_antrian' => $event->no_antrian,
            'id_poli' => $event->id_poli
        ];
       
        return $datas;
        // return [
        //     'no_antrian' =>$event->data_pendaftaran['no_antrian'],
        //     'id_poli' => $event->data_pendaftaran['id_poli']
        // ];
        //
    }
}
