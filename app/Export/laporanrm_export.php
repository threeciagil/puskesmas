<?php

namespace App\Exports;

// use App\Model\Peserta;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class PesertaViewExport implements FromView
{
    public function __construct(string $name, string $bagian)
    {
        $this->name = $name;
        $this->bagian = $bagian;
    }

    public function view(): View
    {   
        return view('exports.peserta', [
            'data' => Peserta::where('nama','like', '%'.$this->name.'%')->where('bagian', 'like', '%'.$this->bagian.'%')->get()
        ]);        
    }
}