<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
// use Validator;
// use Hash;
use Session;

class Login extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if(Session::get('user_data')){
            $session_data = Session::get('user_data')[0]['role'];

            if($session_data=="Pendaftaran"){
                return redirect('/daftarantrian');
            }else if($session_data=="Perawat"){
                return redirect('/perawatumum');
            }else if($session_data=="Laboratorium"){
                return redirect('/laborat');
            }
             else if ($session_data=="Dokter"){
               return redirect('/daftarantriandokter');
           }
            else if ($session_data=="Kasir"){
            return redirect('/kasir');
            }
                else if ($session_data=="Farmasi"){
                return redirect('/farmasi');
            }
                else if ($session_data=="Administrator"){
                return redirect('/admin');
            }
        }else {
            return view('login/v_login');
        }
    }

    public function login(Request $request){
        $username = $request->post('username');
        $password = $request->post('password');

        $cek = DB::table('tbl_pengguna')
            ->where('username', '=', $username)
            ->where('password', '=', $password)
            ->get();
        if(sizeof($cek)){
            //sizeof buat ngecek data yang ada di var cek kembaliannya nilai 1/0
            $role = DB::table('tbl_user_role')
                ->select('role')
                ->where('role_id', '=', $cek[0]->role_id)
                ->get();
            $name_role = $role[0]->role;
            $data = [
                'username' => $cek[0]->username,
                'nama' => $cek[0]->full_name,
                'role'  => $name_role
            ];

            $list = collect($data);
            Session::push('user_data', $list);

            return redirect('/login');
        } else {
            Session::flash('error', 'Username atau password salah');
            return redirect('/login');
        }
    }

    public function logout(){
        Session::flush();
        return redirect('/login');
    }
}
