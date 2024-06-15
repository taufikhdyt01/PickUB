<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = Laporan::with(['user','kategori','feedback'])->get();
        $data->map(function($data){
            $data->status = ($data->feedback) ? 'selesai' : 'belum';
        });

        return view('laporan-masuk.index',[
            'data' => $data,
            'total' => User::count(),
            'user' => User::where('level','customer')->count(),
            'drive' => User::where('level','drive')->count()
        ]);

    }

}
