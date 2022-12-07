<?php

namespace Tests\Unit;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\PasienController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

// class TambahFamilyFolderTest extends TestCase
// {
//     /**
//      * A basic unit test example.
//      *
//      * @return void
//      */
//     public function testjalur1()
//     {
//         Storage::fake('namas');
//         $request = new Request([
//             'nama_kk' => 'Adi Purwanto',
//             'alamat' => 'RT 09 RW 04',
//             'desa' => 'Parakan',
//             'kecamatan' => 'Trenggalek',
//             'kabupaten' => 'Trenggalek',
//             'telp' => '081337712252',
//             'kk' => 'nama.png',
//         ]);
//         $data=(new PasienController())->tambahFF($request);
//         $this->assertTrue(true);
//     }
// }
