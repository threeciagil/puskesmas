<?php
use App\Http\Controllers\EventController;


Route::get('/','Antrian@index');
Route::get('/getantrian/{id}','Antrian@antrian');
Route::get('/jumlahantrian','Antrian@showjumlahantrian');
// Route::get('/update-antrian-pendaftaran', function () {
//     return view('antrian/v_updateantrian');
// });

Route::get('/login','Login@index');
Route::get('/logout','Login@logout');
Route::post('/login','Login@login');

Route::get('/daftarantrian','PendaftaranController@index');
Route::get('/daftarantrian/lewati/{id}','PendaftaranController@lewati');
Route::get('/daftarantrian/hapus/{id}','PendaftaranController@hapus');
Route::get('/daftarantrian/panggil/{id}','PendaftaranController@panggil');
Route::get('/daftarantrian/layani/{id}','PendaftaranController@layani');
Route::get('/daftarantrian/addfamily/{id}','PendaftaranController@addfamily');
Route::post('/daftarantrian/createfamily','PendaftaranController@store');
Route::get('/history','PendaftaranController@history');

Route::get('/datapasien/{id}/{id2}','PendaftaranController@datapasien');
Route::get('/datapasien/vieweditfamily/{id1}/{id2}','PendaftaranController@vieweditfamily');
Route::get('/datapasien/addpasien/{id}/{id2}','PendaftaranController@addpasien');
Route::post('/datapasien/createpasien','PendaftaranController@storepasien');
Route::get('/cekbpjs/{id}','PendaftaranController@cekbpjs');

Route::get('/pendaftaranpasien/{id}/{id2}','PendaftaranController@pendaftaran_pasien');
Route::get('/editpasien/{id}/{id2}','PendaftaranController@vieweditpasien');
Route::post('/pendaftaranpasien','PendaftaranController@save_pendaftaran');
// Route::post('/editpasien','PendaftaranController@save_editpasien');
Route::post('/saveeditpasien','PendaftaranController@saveeditPasien');


Route::get('/datapasienrm','PasienController@viewdataFF');
Route::get('/datapasienrm/viewdatapasien/{id}','PasienController@viewdatapasien');
Route::get('/datapasienrm/viewaddpasien/{id}','PasienController@viewaddpasien');
Route::get('/datapasienrm/viewaddfamily','PasienController@viewaddfamily');
Route::get('/datapasienrm/vieweditfamily/{id}','PasienController@vieweditfamily');
Route::post('/datapasienrm/createfamily','PasienController@tambahFF');
Route::post('/datapasienrm/editfamily','PendaftaranController@editFF');
Route::post('/datapasienrm/editpasien','PasienController@editPasien');
Route::post('/datapasien/editfamilypendaftaran','PendaftaranController@editFFPendaftaran');
Route::post('/datapasienrm/createpasien','PasienController@tambahpasien');


Route::get('/perawatumum','PerawatUmumController@index');
// Route::get('/poliumum/lewati/{id}','PendaftaranController@lewati');
// Route::get('/poliumum/hapus/{id}','PendaftaranController@hapus');
// Route::get('/poliumum/panggil/{id}','PendaftaranController@panggil');
Route::get('/poliumum/layanidokter/{id}','PerawatUmumController@proses');
Route::get('/poliumum/lewati/{id}','PerawatUmumController@lewati');
Route::get('/poliumum/hapus/{id}','PerawatUmumController@hapus');
Route::get('/poliumum/panggil/{id}','PerawatUmumController@panggil');
Route::get('/poliumum/layani/{id}/{id2}','PerawatUmumController@layani');
Route::post('/poliumumperawat','PerawatUmumController@storeperawat');
Route::get('/historyperawat','PerawatUmumController@history');
Route::get('/poliumum/laporanrm','PerawatUmumController@showlaporanrm');
Route::get('/poliumum/print', 'PerawatUmumController@exportCsv');

Route::get('/laborat','LaboratoriumController@index');
Route::get('/laboratpelayanan/{id1}/{id2}','LaboratoriumController@layani');
Route::get('/laboratdatajenislab','LaboratoriumController@dataJenisPelayananLab');
Route::get('/laboratdatajenisdokter/{id}','LaboratoriumController@dataJenisPelayananDokter');
Route::get('/hapusantrianlaborat/hapus/{id}','LaboratoriumController@hapus');
Route::get('/laboratjenisdokter','LaboratoriumController@dataJenisDokter');
Route::get('/laboratdataujilab/{id}','LaboratoriumController@dataUjiLab');
Route::get('/laboratlaporanlab','LaboratoriumController@dataLaporanLab');
Route::get('/laborathistory','LaboratoriumController@history');
Route::post('/savepelayanandokter','LaboratoriumController@storepelayanandokter');
Route::post('/savepemeriksaandokter','LaboratoriumController@storepemeriksaandokter');
Route::post('/savejenisdokter','LaboratoriumController@storejenisdokter');
Route::post('/savejenislab','LaboratoriumController@storejenispemeriksaanlab');
Route::post('/savejenispelayananlab','LaboratoriumController@storedatajenispemeriksaanlab');
Route::post('/savehasillab','LaboratoriumController@storehasillab');
Route::get('/laborat/deletepelayanandokter/{id1}/{id2}','LaboratoriumController@deletepelayanandokter');
Route::get('/laborat/deletedatajenislab/{id}','LaboratoriumController@deletedatajenislab');
Route::get('/laborat/deletedatajenisdokter/{id}','LaboratoriumController@deletedatajenisdokter');
Route::get('/laborat/deletedataujilab/{id}/{id2}','LaboratoriumController@deletedataujilab');
Route::get('/laborat/deletedatapemeriksaandokter/{id}/{id2}','LaboratoriumController@deletedatapemeriksaandokter');
Route::get('/showpemeriksaandokter/{id}','LaboratoriumController@showPemeriksaanDokter');
Route::get('/antrianlaborat/lewati/{id}','LaboratoriumController@lewati');
Route::get('/antrianlaborat/panggil/{id}','LaboratoriumController@panggil');
Route::get('/laborat/print', 'LaboratoriumController@exportLaporan');


Route::get('/pelayanandokter/{id1}/{id2}','DokterController@showpelayanan');
Route::post('/saveanamnesa','DokterController@storeanamnesa');
Route::post('/savepemeriksaan','DokterController@storepemeriksaan');
Route::post('/savepermintaanlab','DokterController@storepermintaanlab');
Route::post('/dokteraddobat','DokterController@tambahObat');
Route::post('/savediagnosa','DokterController@storediagnosa');
Route::post('/savetindakan','DokterController@storetindakan');
Route::post('/savepenyuluhan','DokterController@storepenyuluhan');
Route::get('/pelayanandokter/hapustindakan/{id1}/{id2}/{id3}','DokterController@hapustindakan');
Route::get('/pelayanandokter/hapus/{id1}/{id2}/{id3}','DokterController@hapusdiagnosa');
Route::get('/pelayanandokter/hapusresep/{id1}/{id2}/{id3}','DokterController@hapusresep');
Route::get('/daftarantriandokter','DokterController@showantriandokter');
Route::get('/dataicdx','DokterController@showicdx');
Route::post('/saveicdx','DokterController@storeicdx');
Route::get('/dataicdx/hapus/{id}','DokterController@hapus');

Route::get('/farmasi','FarmasiController@index');
// Route::get('/showantrianfarmasi','FarmasiController@showantrian');
Route::get('/telaahobat','FarmasiController@showtelaahobat');
Route::get('/telaahresep/{id1}/{id2}','FarmasiController@showtelaahresep');
Route::get('/pelayanan','FarmasiController@showpelayanan');
Route::get('/tabelobat','FarmasiController@showobat');
Route::get('/stokobat','FarmasiController@showstokobat');
Route::get('/selesai/{id1}','FarmasiController@selesai');
Route::post('/tabelobat/tambahstokobat','FarmasiController@storestockobat');
Route::post('/tabelobat/tambahdataobat','FarmasiController@storedataobat');
Route::get('/tabelobat/hapusdataobat/{id}','FarmasiController@hapusobat');
Route::get('/tabelobat/hapusstokobat/{id}','FarmasiController@hapusstokobat');
Route::get('/laporanlidi','FarmasiController@showlaporanlidi');
Route::get('/laporanlplpo','FarmasiController@showlaporanlplpo');
Route::get('/laporanstock','FarmasiController@showlaporanstok');
Route::get('/laporantelaah','FarmasiController@showlaporantelaah');
Route::get('/farmasi/history','FarmasiController@showhistory');
Route::get('/farmasi/printlidi', 'FarmasiController@exportLidi');
Route::get('/farmasi/printlplpo', 'FarmasiController@exportLplpo');
Route::get('/farmasi/printstock', 'FarmasiController@exportStock');
Route::get('/farmasi/printtelaah', 'FarmasiController@exportTelaah');
Route::get('/antrianfarmasi/lewati/{id}','FarmasiController@lewati');
Route::get('/antrianfarmasi/panggil/{id}','FarmasiController@panggil');
Route::get('/antrianfarmasi/hapus/{id}','FarmasiController@hapus');

Route::get('/kasir','KasirController@index');
Route::get('/pelayanankasir/{id1}/{id2}','KasirController@showpelayanankasir');
Route::post('/pelayanankasir/savekasir','KasirController@storekasir');
Route::get('/kasir/history','KasirController@showhistory');
Route::get('/kasir/laporan','KasirController@showlaporan');
Route::get('/kasir/printlaporan', 'KasirController@exportLaporan');
Route::get('/antriankasir/lewati/{id}','KasirController@lewati');
Route::get('/antriankasir/panggil/{id}','KasirController@panggil');
Route::get('/antriankasir/hapus/{id}','KasirController@hapus');

Route::get('/admin','AdminController@index');
Route::get('/admin/jamkes','AdminController@showjamkes');
Route::get('/admin/levelpengguna','AdminController@showlevelpengguna');
Route::get('/admin/pengguna','AdminController@showpengguna');
Route::get('/admin/poliutama','AdminController@showpoliutama');
Route::get('/admin/datapelayanan','AdminController@showdatapelayanan');
Route::post('/admin/savejamkes','AdminController@storejamkes');
Route::post('/admin/savetindakan','AdminController@storetindakan');
Route::get('/admin/hapusjamkes/{id}','AdminController@hapusjamkes');
Route::post('/admin/savepengguna','AdminController@storepengguna');
Route::get('/admin/hapuspengguna/{id}','AdminController@hapuspengguna');
Route::get('/admin/hapustindakan/{id}','AdminController@hapustindakan');

Route::get('/datarekammedislab','PasienController@viewaddfamilyrmlaborat');
Route::get('/datarekammedislab/laboratrmdatapasien/{id}','PasienController@viewdatapasienrmlaborat');
Route::get('/datarekammedislab/laboratrmdatapasien/rm/{id}','PasienController@viewdatarmlaborat');
Route::get('/datarekammedis','PasienController@viewaddfamilyrm');
Route::get('/datarekammedis/viewdatapasien/{id}','PasienController@viewdatapasienrm');
Route::get('/datarekammedis/editdatapasien/{id}','PasienController@vieweditpasien');
Route::get('/datarekammedis/viewdatapasien/rm/{id}','PasienController@viewdatarmpendaftran');
Route::get('/datarekammedisperawat','PasienController@viewaddfamilyrmperawat');
Route::get('/datarekammedisperawat/perawatrmdatapasien/{id}','PasienController@viewdatapasienrmperawat');
Route::get('/datarekammedisperawat/perawatrmdatapasien/perawataskep/{id}','PasienController@viewaskepperawat');
Route::get('/datarekammedisperawat/perawatrmdatapasien/perawatrm/{id}','PasienController@viewrmperawat');
Route::get('/datarekammedisfarmasi','PasienController@viewaddfamilyrmfarmasi');
Route::get('/datarekammedisfarmasi/viewdatapasien/{id}','PasienController@viewdatapasienrmfarmasi');
Route::get('/datarekammedisfarmasi/viewdatapasien/rm/{id}','PasienController@viewdatarmfarmasi');
Route::get('/datarekammedisadmin','PasienController@viewaddfamilyrmadmin');
Route::get('/datarekammedisadmin/viewdatapasien/{id}','PasienController@viewdatapasienrmadmin');
Route::get('/datarekammedisadmin/viewdatapasien/rm/{id}','PasienController@viewdatarmadmin');
Route::get('/datarekammedisdokter','PasienController@viewaddfamilyrmdokter');
Route::get('/datarekammedisdokter/viewdatapasien/{id}','PasienController@viewdatapasienrmdokter');
Route::get('/datarekammedisdokter/viewdatapasien/rm/{id}','PasienController@viewdatarmdokter');