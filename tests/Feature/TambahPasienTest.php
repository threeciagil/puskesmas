<?php

namespace Tests\Feature;
// use App\Http\Controllers\PasienController;
// use App\Http\Controllers\Login;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
// use PHPUnit\Framework\TestCase;
use Illuminate\Http\Request;
// use App\Tbl_pengguna;
// use Facade\FlareClient\Api;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
// use Illuminate\Foundation\Testing\WithoutMiddleware;
// use Session;

// class TambahPasienTest extends TestCase
// {
//     use WithoutMiWiddleware;
//     use AuthenticatesUsers;

    /**
     * A basic test example.
     *
     * @return void
     */
//     public function test_tambah_pasien()
//     { 
        //  $user = factory(Tbl_pengguna::class)->create();
        //  $request = new Request([
        //     'silsilah' => 'Lainnya',
        //     'no_rm' => '10.A000001',
        //     'nama' => 'Martharita Farindahsari P',
        //     'jenis_kelamin' => 'Perempuan',
        //     'nama_kk' => 'Adi Purwanto',
        //     'alamat' => 'RT 09 RW 04',
        //     'pekerjaan' => 'Bidan',
        //     'tanggal_lahir' => '1992-03-13',
        //     'umur' => '30',
        //     'jenis_asuransi' => 'Umum',
        //     'no_asuransi' => '',
        //     'agama' => 'Islam',
        //     'no_hp' => '081337712252',
        // ]);
        // $headers = array(
        //     'index' => '03.A000001',
        //     'silsilah' => 'Lainnya',
        //     'nama' => 'Martharita Farindahsari P',
        //     'jenis_kelamin' => 'Perempuan',
        //     'nama_kk' => 'Adi Purwanto',
        //     'alamat' => 'RT 09 RW 04',
        //     'pekerjaan' => 'Bidan',
        //     'tanggal_lahir' => '1992-03-13',
        //     'umur' => '30',
        //     'jenis_asuransi' => 'Umum',
        //     'no_asuransi' => '',
        //     'agama' => 'Islam',
        //     'no_hp' => '081337712252',
        // );
        // $user = new User(session('consumer'));
        // $response= $this->post('/datapasienrm/createpasien/',$headers);
        // dd($response);
        // $this->actingAs($user)->post('/posts', factory(Post::class)->raw(['name' => '']))
        // $response=(new PasienController())->tambahpasien($request);
        // $data=(new PasienController())->getKK('A','Parakan','Trenggalek','Malang');
        // $this->assertEquals( '10.A000001.1', $data,"actual value is not equals to expected");
        // $login = (new Login())->Login($request);    
         
        
        // $response = $login->Session::get('user_data')[0]['role'];
        // $response = Session::get('user_data')[0]['role']->post('/datapasienrm/createpasien', $headers);
        // Session::get('user_data')[0]['role'];
        // dump($response);
        // ->json('POST','/datapasienrm/createpasien', $headers);
        // $login->assertRedirect('/login');
        // $data->assertRedirect('datapasienrm/viewdatapasien/');
        // $response->assertStatus(201);
        
        // $response= $this->post('/datapasienrm/createpasien', ['index' => '03.A000001',
        //     'silsilah' => 'Lainnya',
        //     'no_rm' => '10.A000001',
        //     'nama' => 'Martharita Farindahsari P',
        //     'jenis_kelamin' => 'Perempuan',
        //     'nama_kk' => 'Adi Purwanto',
        //     'alamat' => 'RT 09 RW 04',
        //     'pekerjaan' => 'Bidan',
        //     'tanggal_lahir' => '1992-03-13',
        //     'umur' => '30',
        //     'jenis_asuransi' => 'Umum',
        //     'no_asuransi' => '',
        //     'agama' => 'Islam',
        //     'no_hp' => '081337712252',]);

        //     dd($response);
        // $response->asssertRedirect('datapasienrm/viewdatapasien/'.$request->index);
//     }
// }
