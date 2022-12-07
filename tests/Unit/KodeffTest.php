<?php

namespace Tests\Unit;
use App\Http\Controllers\PasienController;
use PHPUnit\Framework\Test;
// use App\Http\Controllers;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\CodeCoverage\Report\Xml\Tests;

class KodeffTest extends TestCase
{
    
    /**
     * A basic test example.
     * 
     * @return void
     */
    public function testjalur1_kab_luar_trenggalek()
    {
        $kab="Pogalan";
        $kec="Malang";
        $des="Parakan";
        $data=(new PasienController())->kode($kab, $kec, $des);
        $this->assertEquals( '10', $data,"actual value is not equals to expected");
        // $this->assertTrue(false);
    }
    public function testjalur2_kecamatan_luar_trenggalek_kabupaten_trenggalek()
    {
        $kab="Trenggalek";
        $kec="Pogalan";
        $des="Parakan";
        $data=(new PasienController())->kode($kab, $kec, $des);
        $this->assertEquals( '09', $data,"actual value is not equals to expected");
        // $this->assertTrue(true);
    }
    public function testjalur3_kab_kec_trenggalek_desa_dawuhan()
    {
        $kab="Trenggalek";
        $kec="Trenggalek";
        $des="Dawuhan";
        $data=(new PasienController())->kode($kab, $kec, $des);
        $this->assertEquals( '01', $data,"actual value is not equals to expected");
        // $this->assertTrue(true);
    }
    public function testjalur4_kab_kec_trenggalek_desa_sukosari()
    {
        $kab="Trenggalek";
        $kec="Trenggalek";
        $des="Sukosari";
        $data=(new PasienController())->kode($kab, $kec, $des);
        $this->assertEquals( '02', $data,"actual value is not equals to expected");
        // $this->assertTrue(true);
    }
    public function testjalur5_kab_kec_trenggalek_desa_parakan()
    {
        $kab="Trenggalek";
        $kec="Trenggalek";
        $des="Parakan";
        $data=(new PasienController())->kode($kab, $kec, $des);
        $this->assertEquals( '03', $data,"actual value is not equals to expected");
        // $this->assertTrue(true);
    }
    public function testjalur6_kab_kec_trenggalek_desa_rejowinangun()
    {
        $kab="Trenggalek";
        $kec="Trenggalek";
        $des="Rejowinangun";
        $data=(new PasienController())->kode($kab, $kec, $des);
        $this->assertEquals( '04', $data,"actual value is not equals to expected");
        // $this->assertTrue(true);
    }
    public function testjalur7_kab_kec_trenggalek_desa_surodakan()
    {
        $kab="Trenggalek";
        $kec="Trenggalek";
        $des="Surodakan";
        $data=(new PasienController())->kode($kab, $kec, $des);
        $this->assertEquals( '05', $data,"actual value is not equals to expected");
        // $this->assertTrue(true);
    }
    public function testjalur8_kab_kec_trenggalek_desa_ngares()
    {
        $kab="Trenggalek";
        $kec="Trenggalek";
        $des="Ngares";
        $data=(new PasienController())->kode($kab, $kec, $des);
        $this->assertEquals( '06', $data,"actual value is not equals to expected");
        // $this->assertTrue(true);
    }
    public function testjalur9_kab_kec_trenggalek_desa_sumbersari()
    {
        $kab="Trenggalek";
        $kec="Trenggalek";
        $des="Sumberdadi";
        $data=(new PasienController())->kode($kab, $kec, $des);
        $this->assertEquals( '07', $data,"actual value is not equals to expected");
        // $this->assertTrue(true);
    }
    public function testjalur10_kab_kec_trenggalek_desa_kelutan()
    {
        $kab="Trenggalek";
        $kec="Trenggalek";
        $des="Kelutan";
        $data=(new PasienController())->kode($kab, $kec, $des);
        $this->assertEquals( '08', $data,"actual value is not equals to expected");
        // $this->assertTrue(true);
    }
    public function testjalur11_kab_luar_trenggalek_kec_trenggalek()
    {
        $kab="Malang";
        $kec="Trenggalek";
        $des="Parakan";
        $data=(new PasienController())->kode($kab, $kec, $des);
        $this->assertEquals( '10', $data,"actual value is not equals to expected");
        // $this->assertTrue(true);
    }
}
