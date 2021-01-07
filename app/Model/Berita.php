<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $table = "mberita";
    protected $fillable = ["deskripsi","foto","judul"];
}
