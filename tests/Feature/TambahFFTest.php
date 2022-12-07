<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\PasienController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
// use Tests\TestCase;
use Tests\TestCase;

// class TambahFFTest extends TestCase
// {
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function testExample()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
        // public function testTambahFF(){
        //      Storage::fake('nama');
 
        //      $request = new Request([
        //     'nama_kk' => 'Adi Purwanto',
        //     'alamat' => 'RT 09 RW 04',
        //     'desa' => 'Parakan',
        //     'kecamatan' => 'Trenggalek',
        //     'kabupaten' => 'Trenggalek',
        //     'telp' => '081337712252',
        //     'kk' => 'avatar.jpg',
        // ]);
        // $data=(new PasienController())->tambahFF($request);
        // $this->assertTrue(true);
        // $file = UploadedFile::fake()->image('avatar.jpg');
 
        // $response = $this->post('', ['nama_kk' => 'Adi Purwanto',
        //     'alamat' => 'RT 09 RW 04',
        //     'desa' => 'Parakan',
        //     'kecamatan' => 'Trenggalek',
        //     'kabupaten' => 'Trenggalek',
        //     'telp' => '081337712252',
        //     'kk' => 'avatar.jpg']);
        // $response->assertRedirect('')
        // $response = $this->json('POST', '/avatar', [
        //     'avatar' => $file,
        // ]);
 
        // Assert the file was stored...
        // Storage::disk('avatars')->assertExists($file->hashName());
 
        // Assert a file does not exist...
        // Storage::disk('avatars')->assertMissing('missing.jpg');
//         }
// }
