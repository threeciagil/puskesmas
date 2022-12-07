<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PanggilFarmasiEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $data ;
    /**
    * The name of the queue connection to use when broadcasting the event.
    *
    * @var string
    */
    public $connection = 'redis';
    
    /**
    * The name of the queue on which to place the broadcasting job.
    *
    * @var string
    */
    public $queue = 'default';

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data_farmasi)
    {
        $this->data = $data_farmasi;
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('PanggilanChannel');
    }

    /*
     * The Event's broadcast name.
     * 
     * @return string
     */
    public function broadcastAs()
    {
        return 'PanggilanMessage';
    }
    
    /*
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {   
        if(isset($this->data[0]->id_poli)){
            if($this->data[0]->id_poli==1){
                $this->data[0]->kode_poli = "A";
            }
            $datas = [
                'nama_poli' => $this->data[0]->nama_poli,
                'no_antrian' => $this->data[0]->no_antrian,
                'kode_poli' => $this->data[0]->kode_poli
            ];
        }
        else{
            // $this->data[0]->kode_poli = "A";
            $datas = [
                'nama_poli' => $this->data[0]->nama_poli,
                'no_antrian' => $this->data[0]->no_antrian,
                // 'kode_poli' => $this->data[0]->kode_poli
            ];
        }

        // return $data_pendaftaran;
        // $datas = array($this->data);
        // var_dump($datas);
        return array($datas);
        // return [
        //     // 'no_antrian' => $this->data->no_antrian,
        //     // 'id_poli' => $this->data->id_poli
        //     'no_antrian' => 1,
        //     'id_poli' => 1
        // ];
    }
}