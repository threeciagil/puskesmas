<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Http\Request;
// class tambahresepobatTest extends TestCase
// {
//     use WithoutMiddleware;
//     /**
//      * A basic feature test example.
//      *
//      * @return void
//      */
//     public function test_ObatJadi()
//     {$request = new Request([
            
//             'no_rm' => '03.A000001.1',
//             'id_pemeriksaan'=>'94', 
//         ]);
//         $response = $this->post('/dokteraddobat', [
//                 'id_pemeriksaan'=>'94',
//                 'no_rm' => '03.A000001.1',     
//                 'jenis'=> 'Jadi',
//                 'signa'=>'3x1',
//                 'aturan_pakai'=>'Setelah Makan',
//                 'nama_obat'=> ['Albendazol tablet 400 mg', ''],
//                 'jk'=>['2', ''],
//         ] );

//         // dd($response);
//         $response->assertRedirect('/pelayanandokter/'.$request->no_rm.'/'.$request->id_pemeriksaan);
//         // dd($response);
//     }
//     public function test_ObatRacikan()
//     {$request = new Request([
            
//             'no_rm' => '03.A000001.1',
//             'id_pemeriksaan'=>'94', 
//         ]);
//         $response = $this->post('/dokteraddobat', [
//                 'id_pemeriksaan'=>'94',
//                 'no_rm' => '03.A000001.1',     
//                 'jenis'=> 'Racikan',
//                 'signa'=>'3x1',
//                 'aturan_pakai'=>'Setelah Makan',
//                 'nama_obat'=> ['Albendazol tablet 400 mg','Ambroxol tablet'],
//                 'jk'=>['2','3'],
//         ] );

//         // dd($response);
//         $response->assertRedirect('/pelayanandokter/'.$request->no_rm.'/'.$request->id_pemeriksaan);
//     }
// }
