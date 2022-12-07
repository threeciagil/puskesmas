<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Http\Request;

// class tambahAnamnesaTest extends TestCase
// {
//     use WithoutMiddleware;
    
//     /**
//      * A basic feature test example.
//      *
//      * @return void
//      */
//     public function test_dataPemeriksaanBelumaAda()
//     {$request = new Request([
            
//             'no_rm' => '10.A000001',
//             'id_pemeriksaan'=>'92', 
//         ]);
//         $response = $this->post('/savepemeriksaan', [
//                 'id_pemeriksaan'=>'92',
//                 'no_rm' => '10.A000001',     
//                 'tb'=> '150',
//                 'bb'=> '50',
//                 'sistol'=> '110',
//                 'imt'=> '22.5',
//                 'suhu'=> '37.5',
//                 'nafas'=> '20',
//                 'diastol'=> '100',
//         ] );

//         // dd($response);
//         $response->assertRedirect('/pelayanandokter/'.$request->no_rm.'/'.$request->id_pemeriksaan);
//     }
//     public function test_dataPemeriksaansudahAda()
//     {$request = new Request([
            
//             'no_rm' => '10.A000001',
//             'id_pemeriksaan'=>'93', 
//         ]);
//         $response = $this->post('/savepemeriksaan', [
//                 'id_pemeriksaan'=>'93',
//                 'no_rm' => '10.A000001',     
//                 'tb'=> '150',
//                 'bb'=> '50',
//                 'sistol'=> '110',
//                 'imt'=> '22.5',
//                 'suhu'=> '37.5',
//                 'nafas'=> '20',
//                 'diastol'=> '100',
//         ] );

//         // dd($response);
//         $response->assertRedirect('/pelayanandokter/'.$request->no_rm.'/'.$request->id_pemeriksaan);
//     }
// }
