<?php

namespace Tests\Unit;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Http\Controllers\PasienController;
use App\Tbl_ff;

class GetKKTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testJalur1_kec_kab_trenggalek_data_nama_sesuai_nilai_char()
    {
        //getKK($char, $desa, $kecamatan, $kabupaten)
        $data=(new PasienController())->getKK('P','Parakan','Trenggalek','Trenggalek');
        $this->assertEquals( '2', $data,"actual value is not equals to expected");
        
    }

    public function testJalur2_kec_kab_trenggalek_data_nama_belum_ada()
    {
        //getKK($char, $desa, $kecamatan, $kabupaten)
        $data=(new PasienController())->getKK('Z','Dawuhan','Trenggalek','Trenggalek');
        $this->assertEquals( '1', $data,"actual value is not equals to expected");
        
    }
 
    public function testJalur3_kec_bukan_trenggalek_data_nama_sesuai_nilai_char()
    {
        //getKK($char, $desa, $kecamatan, $kabupaten)
        $data=(new PasienController())->getKK('P','Parakan','Pogalan','Trenggalek');
        $this->assertEquals( '2', $data,"actual value is not equals to expected");
    }

    public function testJalur4_kec_bukan_trenggalek_data_nama_belum_ada()
    {
        //getKK($char, $desa, $kecamatan, $kabupaten)
        $data=(new PasienController())->getKK('Z','Parakan','Tugu','Trenggalek');
        $this->assertEquals( '1', $data,"actual value is not equals to expected");
        
    }
    public function testJalur5_kab_bukan_trenggalek_data_nama_sesuai_nilai_char()
    {
        //getKK($char, $desa, $kecamatan, $kabupaten)
        $data=(new PasienController())->getKK('P','Parakan','Trenggalek','Malang');
        $this->assertEquals( '2', $data,"actual value is not equals to expected");
    }
    public function testJalur6_kab_bukan_trenggalek_data_nama_belum_ada()
    {
        //getKK($char, $desa, $kecamatan, $kabupaten)
        $data=(new PasienController())->getKK('Z','Parakan','Trenggalek','Malang');
        $this->assertEquals( '1', $data,"actual value is not equals to expected");
        
    }
    
}
