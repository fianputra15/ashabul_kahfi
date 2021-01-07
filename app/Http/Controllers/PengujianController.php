<?php

namespace App\Http\Controllers;

use App\Model\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
class PengujianController extends Controller
{
    public function berita(){
        $berita = Berita::all();
        return response()->json($berita);
    }

    public function berita_withredis(){
        $berita = Cache::remember("brt", 10 * 30, function () {
            return Berita::all();
        });
        return response()->json($berita);
    }
}
