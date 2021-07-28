@extends('layouts.app', [
'namePage' => 'Kelola Pelanggan',
'class' => 'login-page sidebar-mini ',
'activePage' => 'customer',
'backgroundImage' => asset('now') . "/img/bg14.jpg",
'parent' => 'master'
])
@section('title','Pelanggan')
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
                            Kelola Pelanggan
                        </div>
                        <a href="{{route('admin.customer.create')}}" class="btn btn-round btn-primary">
                            <i class="fas fa-plus"></i> Buat Akun
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
                        <div class="card-header d-flex justify-content-center">
                            <h2 class="h4 card-title">Irwan Antonio</h2>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <p class="my-1">Email</p>
                                <p class="my-1 text-muted">
                                    irwanantonio2708@gmail.com
                                </p>
                            </div>
                            <div class="mb-3">
                                <p class="my-1">WhatsApp</p>
                                <p class="my-1 text-muted">
                                    +6282243440959
                                </p>
                            </div>
                            <div class="mb-3">
                                <p class="my-1">Bergabung pada</p>
                                <p class="my-1 text-muted">
                                    30 Mei 2021
                                </p>
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
