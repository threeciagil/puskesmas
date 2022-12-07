<?php

namespace Tests\Unit;
use App\Http\Controllers\PasienController;
// use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Http\Request;

class TambahPasiesTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    
    public function test_silsilah_KepalaKeluarga()
    {
        $request = new Request([
            'index' => '10.P000001',
            'silsilah' => 'Kepala Keluarga',
            'nama' => 'Adi Purwanto',
            'jenis_kelamin' => 'Laki-laki',
            'nama_kk' => 'Adi Purwanto',
            'alamat' => 'RT 09 RW 04',
            'pekerjaan' => 'Polri',
            'tanggal_lahir' => '1967-01-30',
            'umur' => '55',
            'jenis_asuransi' => 'Umum',
            'no_asuransi' => '',
            'agama' => 'Islam',
            'no_hp' => '081337712252',
        ]);
        $data=(new PasienController())->tambahpasien($request);
        $this->assertTrue(true);
    }
     public function test_silsilah_Ibu()
    {
        $request = new Request([
            'index' => '10.P000001',
            'silsilah' => 'Ibu',
            'nama' => 'Wagian Ruliyatin',
            'jenis_kelamin' => 'Perempuan',
            'nama_kk' => 'Adi Purwanto',
            'alamat' => 'RT 09 RW 04',
            'pekerjaan' => 'PNS',
            'tanggal_lahir' => '1968-07-14',
            'umur' => '54',
            'jenis_asuransi' => 'Umum',
            'no_asuransi' => '',
            'agama' => 'Islam',
            'no_hp' => '081337712252',
        ]);
        $data=(new PasienController())->tambahpasien($request);
        $this->assertTrue(true);
    }
     public function test_silsilah_Lainnya()
    {
        $request = new Request([
            'index' => '10.P000001',
            'silsilah' => 'Lainnya',
            'nama' => 'Martharita Farindahsari P',
            'jenis_kelamin' => 'Perempuan',
            'nama_kk' => 'Adi Purwanto',
            'alamat' => 'RT 09 RW 04',
            'pekerjaan' => 'Bidan',
            'tanggal_lahir' => '1992-03-13',
            'umur' => '30',
            'jenis_asuransi' => 'Umum',
            'no_asuransi' => '',
            'agama' => 'Islam',
            'no_hp' => '081337712252',
        ]);
        $data=(new PasienController())->tambahpasien($request);
        $this->assertTrue(true);
    }
    
}

