@extends('user.template.template')
@section('content')
    <div class="container-fluid">
        @foreach($berita as $b)
            <div class="card-group">

                    <div class="card m-2">
                        <img src="{{asset('foto_berita/'.$b->foto)}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$b['judul']}}</h5>
                            <p class="card-text">{{$b['deskripsi']}}</p>

                            <strong>{{$b['updated_at']}}</strong><br>
                            <a href="{{route('detail_berita',$b->id)}}" class="btn btn-primary">Selengkapnya</a>
                        </div>
                    </div>

            </div>
        @endforeach
    </div>
    <br><br>
    <br>
@endsection

