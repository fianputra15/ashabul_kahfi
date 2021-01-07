<?php

namespace App\Http\Controllers;

use App\Model\Anggota;
use App\Model\Berita;
use App\Model\Materi;
use App\Model\Profiles;
use App\Model\Proker;
use Illuminate\Http\Request;
use App\Model\KategoriAnggota;
use Illuminate\Support\Facades\Cache;
use App\Model\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index(){
        return view('admin.home');
    }

    //Profile
    public function profile(){
        $profile = Profiles::first();
        return view('admin.profile',compact('profile'));
    }

    public function edit_profile(){
        $profile = Profiles::first();
        return view('admin.profile-edit',compact('profile'));
    }

    public function update_profile(Request $request){
        $profile = Profiles::first();
        $files = $request->file('foto');
        if(isset($files)){
            if($files->move("image/",$files->getClientOriginalName())){
                $profile->foto = $files->getClientOriginalName();
                $profile->deskripsi = $request->deskripsi;
                $profile->save();
                return Redirect::route('admin_profile')->with('berhasil','Berhasil Memperbaharui Program Kerja');
            }else{
                return Redirect::route('admin_profile')->with('gagal','Gagal Memperbaharui Program Kerja');
            }
        }else{
            $profile->deskripsi = $request->deskripsi;
            $profile->save();
            return Redirect::route('admin_profile')->with('berhasil','Berhasil Memperbaharui Program Kerja');
        }
    }


    //Proker
    public function proker(){
        $proker = Proker::first();
        return view('admin.proker',compact('proker'));
    }

    public function edit_proker(){
        $proker = Proker::first();
        return view('admin.proker-edit',compact('proker'));
    }

    public function update_proker(Request $request){
        $proker = Proker::first();
        $proker->deskripsi = $request->deskripsi;
        if($proker->save()){
            return Redirect::route('admin_proker')->with('berhasil','Berhasil Memperbaharui Program Kerja');
        }else{
            return Redirect::route('admin_proker')->with('berhasil','Gagal Memperbaharui Program Kerja');
        }
    }

    //Materi
    public function materi(){
        $materi = Materi::all();
        return view('admin.materi',compact('materi'));
    }

    public function update_materi($id,Request $request){
        $materi = Materi::where("id",$id)->first();
        $files = $request->file('foto');
        if(isset($files)){
            if($files->move("foto_materi/",$files->getClientOriginalName())){
                $materi->foto = $files->getClientOriginalName();
                $materi->id_kategori = $request->kategori;
                $materi->title_materi = $request->title_materi;
                $materi->materi = $request->materi;
                $materi->save();
                return Redirect::route('admin_materi')->with('berhasil','Berhasil Memperbaharui Materi');
            }else{
                return Redirect::route('admin_materi')->with('gagal','Gagal Memperbaharui Materi');
            }
        }else{
            $materi->id_kategori = $request->kategori;
            $materi->title_materi = $request->title_materi;
            $materi->materi = $request->materi;
            $materi->save();
            return Redirect::route('admin_materi')->with('berhasil','Berhasil Memperbaharui Materi');
        }
    }

    public function edit_materi($id){
        $kategori = KategoriAnggota::all();
        $materi = Materi::where("id",$id)->first();
        return view('admin.materi-edit',compact('materi','kategori'));
    }

    public function tambah_materi(){
        $kategori = KategoriAnggota::all();
        return view('admin.materi-add',compact('kategori'));
    }
    public function store_materi(Request $request){
        $materi = new Materi();
        $files = $request->file('foto');
        if(isset($files)){
            if($files->move("foto_materi/",$files->getClientOriginalName())){
                $data = array(
                    "title_materi" => $request->title_materi,
                    "materi" => $request->materi,
                    "id_kategori" => $request->kategori,
                    "foto" => $files->getClientOriginalName()
                );
                $materi->fill($data);
                $materi->save();
                return Redirect::route('admin_materi')->with('berhasil','Berhasil Menambahkan Materi');
            }else{
                return Redirect::route('admin_materi')->with('gagal','Gagal Menambahkan Materi');
            }
        }else{
            $data = array(
                "title_materi" => $request->title_materi,
                "materi" => $request->materi,
                "id_kategori" => $request->kategori
            );
            $materi->fill($data);
            $materi->save();
            return Redirect::route('admin_materi')->with('berhasil','Berhasil Menambahkan Materi');
        }
//        return Redirect::route('admin_materi');
    }

    public function delete_materi($id){
        $deleted = Materi::where("id",$id)->delete();
        if($deleted){
            return Redirect::route('admin_materi')->with('berhasil','Berhasil Menghapus Materi');
        }else{
            return Redirect::route('admin_materi')->with('gagal','Gagal Menghapus Materi');
        }
    }

    //Berita
    public function berita(){
//        $berita = Cache::remember("brt", 10 * 30, function () {
//            return Berita::all();
//        });
        $berita = Berita::all();
//        $berita = Cache::remember("berita", 10 * 30, function () {
//            return Berita::all();
//        });
//        return response()->json($berita);
        return view('admin.berita',compact('berita'));
    }

    public function delete_berita($id){
        $deleted = Berita::where("id",$id)->delete();
        if($deleted){
            return Redirect::route('admin_berita')->with('berhasil','Berhasil Menghapus Berita');
        }else{
            return Redirect::route('admin_berita')->with('gagal','Gagal Menghapus Berita');
        }
    }
    public function tambah_berita(){
        return view('admin.berita-add');
    }

    public function store_berita(Request $request){
        $berita = new Berita();
        $files = $request->file('foto');
        if(isset($files)){
            if($files->move("foto_berita/",$files->getClientOriginalName())){
                $data = array(
                    "judul" => $request->judul,
                    "deskripsi" => $request->deskripsi,
                    "foto" => $files->getClientOriginalName()
                );
                $berita->fill($data);
                $berita->save();
                return Redirect::route('admin_berita')->with('berhasil','Berhasil Menambahkan Berita');
            }else{
                return Redirect::route('admin_berita')->with('gagal','Gagal Menambahkan Berita');
            }
        }else{
            $data = array(
                "judul" => $request->judul,
                "deskripsi" => $request->deskripsi,
                "foto" => "logo.jpeg"
            );
            $berita->fill($data);
            $berita->save();
            return Redirect::route('admin_berita')->with('berhasil','Berhasil Menambahkan Berita');
        }
        return Redirect::route('admin_materi')->with('gagal','Gagal Menambahkan Berita');
    }

    public function update_berita($id,Request $request){
        $berita = Berita::where("id",$id)->first();
        $files = $request->file('foto');
        if(isset($files)){
            if($files->move("foto_berita/",$files->getClientOriginalName())){
                $berita->foto = $files->getClientOriginalName();
                $berita->judul = $request->judul;
                $berita->deskripsi = $request->deskripsi;
                $berita->save();
                return Redirect::route('admin_berita')->with('berhasil','Berhasil Memperbarui Berita');
            }else{
                return Redirect::route('admin_berita')->with('gagal','Gagal Memperbarui Berita');
            }
        }else{
            $berita->judul = $request->judul;
            $berita->deskripsi = $request->deskripsi;
            $berita->save();
            return Redirect::route('admin_berita')->with('berhasil','Berhasil Memperbarui Berita');
        }
    }

    public function edit_berita($id){
        $berita = Berita::where("id",$id)->first();
        return view('admin.berita-edit',compact('berita'));
    }

    //Anggota
    public function anggota(){
        $anggota = Anggota::all();
        return view('admin.anggota',compact('anggota'));
    }

    public function delete_anggota($id){
        $deleted = User::where("kode_user",$id)->delete();
        if($deleted){
            $deleled_anggota = Anggota::where("kode_user",$id)->delete();
            return Redirect::route('admin_anggota')->with('berhasil','Berhasil Menghapus Anggota');
        }else{
            return Redirect::route('admin_anggota')->with('gagal','Gagal Menghapus Anggota');
        }
    }

    public function tambah_anggota(){
        $kategori = KategoriAnggota::all();
        return view('admin.anggota-add',compact('kategori'));
    }

    public function store_anggota(Request $request){
        $anggota = new Anggota();
        $user = new User();
        $kode_user = Str::random('6');
        $files = $request->file('foto');
        if(isset($files)){
            if($files->move("foto_anggota/",$files->getClientOriginalName())){
                $data = array(
                    "kode_user" => $kode_user,
                    "email" => $request->email,
                    "status" => 0,
                    "no_telp" => $request->telp,
                    "password" => Hash::make('123456')
                );
                $user->fill($data);
                if($user->save()){
                    $data_user = array(
                        "kode_user" => $kode_user,
                        "nta" => $request->nta,
                        "nama" => $request->nama,
                        "tempat_lhr" =>$request->tempat,
                        "tgl_lhr" =>$request->tanggal_lahir,
                        "alamat" => $request->alamat,
                        "id_anggota" =>$request->kategori_anggota,
                        "thn_masuk" => date('y'),
                        "foto" => $files->getClientOriginalName()
                    );
                    $anggota->fill($data_user);
                    if ($anggota->save()){
                        return Redirect::route('admin_anggota')->with('berhasil','Berhasil Menambahkan Anggota');
                    }
                }
            }else{
                return Redirect::route('admin_anggota')->with('gagal','gagal Menambahkan');
            }
        }else{
            return Redirect::route('admin_anggota')->with('gagal','gagal Menambahkan');
        }
    }

    public function edit_anggota($id){
        $anggota = Anggota::where("kode_user",$id)->with('user')->first();
        $kategori = KategoriAnggota::all();
        return view('admin.anggota-edit',compact('anggota','kategori'));
    }

    public function update_anggota($id,Request $request){
        $files = $request->file('foto');
        if(isset($files)){
            if($files->move("foto_anggota/",$files->getClientOriginalName())){
                $anggota = Anggota::where('kode_user',$id)->first();
                $user = User::where("kode_user",$id)->first();
                $user->email = $request->email;
                $user->no_telp = $request->telp;
                $user->save();
                $anggota->nta = $request->nta;
                $anggota->nama = $request->nama;
                $anggota->tempat_lhr = $request->tempat;
                $anggota->tgl_lhr = $request->tanggal_lahir;
                $anggota->alamat = $request->alamat;
                $anggota->id_anggota = $request->kategori_anggota;
                $anggota->foto = $files->getClientOriginalName();
                $anggota->save();
                return Redirect::route('admin_anggota')->with('berhasil','Berhasil Memperbarui Data Anggota');
            }else{
                return Redirect::route('admin_anggota')->with('gagal','Gagal Memperbarui Data Anggota');
            }
        }else{
            $anggota = Anggota::where('kode_user',$id)->first();
            $user = User::where("kode_user",$id)->first();
            $user->email = $request->email;
            $user->no_telp = $request->telp;
            if($user->save()){
                $anggota->nta = $request->nta;
                $anggota->nama = $request->nama;
                $anggota->tempat_lhr = $request->tempat;
                $anggota->tgl_lhr = $request->tanggal_lahir;
                $anggota->alamat = $request->alamat;
                $anggota->id_anggota = $request->kategori_anggota;
                if ($anggota->save()){
                    return Redirect::route('admin_anggota')->with('berhasil','Berhasil Memperbarui Data Anggota');
                }
            }
            return Redirect::route('admin_anggota')->with('gagal','Gagal Memperbarui Data Anggota');
        }
    }
}
