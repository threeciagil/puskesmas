<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PanggilPerawatEvent implements ShouldBroadcast
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
    public function __construct($perawat)
    {
        $this->data = $perawat;
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('PanggilanPerawatChannel');
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
        $datas = [
            'panggil_perawat' => "panggilan kepada ".$this->data." dimohon segera membantu tindakan",
        ];
    
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