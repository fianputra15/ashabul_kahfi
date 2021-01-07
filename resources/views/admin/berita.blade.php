@include('admin.layouts.header')
@include('admin.layouts.sidebar')
<!-- HEADER DESKTOP--><!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <!-- <div class="row">
                <div class="col-lg-12">
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <h3 class="title-2">E-Warning Keseluruhan</h3>
                            <div class="chart-info">
                                <div class="chart-info__left">
                                    <div class="chart-note">
                                        <span class="dot dot--blue"></span>
                                        <span>products</span>
                                    </div>
                                    <div class="chart-note mr-0">
                                        <span class="dot dot--green"></span>
                                        <span>services</span>
                                    </div>
                                </div>
                                <div class="chart-info__right">
                                    <div class="chart-statis">
                                        <span class="index incre">
                                            <i class="zmdi zmdi-long-arrow-up"></i>25%</span>
                                        <span class="label">products</span>
                                    </div>
                                    <div class="chart-statis mr-0">
                                        <span class="index decre">
                                            <i class="zmdi zmdi-long-arrow-down"></i>10%</span>
                                        <span class="label">services</span>
                                    </div>
                                </div>
                            </div>
                            <div class="recent-report__chart">
                                <canvas id="recent-rep-chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            @if(\Illuminate\Support\Facades\Session::has('berhasil'))
                                <div class="alert bg-primary">
                                    <b style="color: white">{{\Illuminate\Support\Facades\Session::get('berhasil')}}</b>
                                </div>
                            @endif
                            @if(\Illuminate\Support\Facades\Session::has('gagal'))
                                <div class="alert bg-danger">
                                    <b style="color: white">{{\Illuminate\Support\Facades\Session::get('gagal')}}</b>
                                </div>
                            @endif
                            <h3 class="title-2">Tabel Berita</h3><br>
                            <div class="table-responsive table--no-card m-b-30">
                                <a class="btn btn-primary" href="{{route('tambah_berita')}}">Tambah</a><br><br>
                                <table id="table" class="table table-borderless table-striped table-earning">
                                    <thead>
                                    <tr>
                                        <th>Aksi</th>
                                        <th>Judul Berita</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $no=1; @endphp
                                    @foreach($berita ?? '' as $key)
                                        <tr>
                                            <td>
                                                <a class="btn btn-info" href="{{route('edit_berita',$key->id)}}">Edit</a>
                                                | <a href="{{route('delete_berita',$key->id)}}" class="btn btn-danger text-white">Delete</a>
                                            </td>
{{--                                            <td><img class="img-120" src="{{asset('foto_materi/'.$key->foto)}}" alt=""></td>--}}
{{--                                            <td>{{$key->foto}}</td>--}}
                                            <td>{{$key->judul}}</td>
                                        </tr>
                                        @php $no++ @endphp
                                    @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


@include('admin.layouts.footer')
