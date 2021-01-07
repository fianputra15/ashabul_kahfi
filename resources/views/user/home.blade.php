@extends('user.template.template')
@section('content')
    <div class="owl-carousel owl-theme" id="image-carousel">
        @foreach($berita as $b)
            <div>
                <div class="card">
                    <img src="{{asset('foto_berita/'.$b->foto)}}" class="img-thumbnail" alt="">
                </div>
            </div>
        @endforeach
    </div><br><br>
    <div class="mb-4">
        <!-- Gradient divider -->
        <hr data-content="BERITA TERBARU" class="hr-text">
    </div>
    <div class="owl-carousel owl-theme" id="news-carousel">
        @foreach($berita as $b)
            <div>
                <div class="card">
                    <img src="{{asset('foto_berita/'.$b->foto)}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$b->judul}}</h5>
{{--                        <p class="card-text">{{$b->deskripsi}}</p>--}}
                        <a href="{{route('detail_berita',$b->id)}}" class="btn btn-primary">Selengkapnya</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div><br>
    <a href="{{route('berita')}}" class="btn btn-info" style="display:block; width:10%; margin:0 auto;">Seluruh Berita</a>

    <br>
    <br><br>
    <div class="mb-4">
        <!-- Gradient divider -->
        <hr data-content="Tentang Ashabul Kahfi" class="hr-text">
    </div>
    <div class="card bg-dark text-white">
        <img class="card-img" src="{{asset('image/logo.jpeg')}}" alt="Card image" style="filter: brightness(50%)">
        <div class="card-img-overlay">
            <h3 class="card-title">Ashabul Kahfi</h3>
            <a href="{{route('profile')}}" class="btn-primary btn">Selengkapnya tentang kami</a>
        </div>
    </div>
    <br>
@endsection
@section('script')
    <script>
        $('#news-carousel').owlCarousel({
            loop:true,
            margin:10,
            responsive:{
                0:{
                    items:1,
                    nav:true,
                },
                600:{
                    items:3,
                    nav:true
                },
                1000:{
                    nav:true,
                    items:3
                }
            }
        })
        $('#image-carousel').owlCarousel({
            loop:true,
            margin:10,
            responsive:{
                0:{
                    items:1,
                    nav:true,
                },
                600:{
                    items:1,
                    nav:true
                },
                1000:{
                    nav:true,
                    items:1
                }
            }
        })
    </script>
@endsection
