@extends('layouts.app', [
'namePage' => 'Kelola Lapangan',
'class' => 'login-page sidebar-mini ',
'activePage' => 'field',
'backgroundImage' => asset('now') . "/img/bg14.jpg",
'parent' => 'master'
])
@section('title','Lapangan')
@section('content')
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="card-title">
                            Kelola Lapangan
                        </div>
                        <a href="{{route('admin.field.create')}}" class="btn btn-round btn-primary">
                            <i class="fas fa-plus"></i> Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="get">
                        <div class="form-group">
                            <input type="text" name="q" placeholder="Cari" class="form-control form-control-md">

                        </div>
                    </form>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-info">Cari</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Lapangan X</div>
                        </div>
                        <div class="card-body description-box">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Harga Sewa per Jam</p>
                                <p class="text-muted">Rp. 75,000</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Jenis Lapangan</p>
                                <p class="text-muted">Sintetis</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Status</p>
                                <p class="text-muted">
                                    <span class="badge badge-success">Tersedia</span>
                                </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Panjang</p>
                                <p class="text-muted">25 m</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Lebar</p>
                                <p class="text-muted">16 m</p>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="" class="btn btn-info btn-round w-100 mr-2"><i class="fas fa-pen"></i></a>
                            <a href="" class="btn btn-danger btn-round w-100"><i class="fas fa-trash"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
@endpush
