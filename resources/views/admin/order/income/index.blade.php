@extends('layouts.app', [
'namePage' => 'Pendapatan',
'class' => 'login-page sidebar-mini ',
'activePage' => 'income',
'backgroundImage' => asset('now') . "/img/bg14.jpg",
'parent' => 'order'
])
@section('title','Lapangan')
@section('content')
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <p class="lead">Pendapatan Hari Ini</p>
                    <p class="h4">Rp. 0</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <p class="lead">Pendapatan Sebulan Terakhir</p>
                    <p class="h4">Rp. 0</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <p class="lead">Pendapatan Tahunan</p>
                    <p class="h4">Rp. 0</p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="card-title">
                            Transaksi Valid
                        </div>
                        <a href="#" data-toggle="modal" data-target="#modalFilter" class="btn btn-round btn-primary">
                            <i class="fas fa-filter"></i> Filter
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tbl-orders">
                            <thead>
                                <th></th>
                                <th>Order ID</th>
                                <th>Jenis Transaksi</th>
                                <th>Jumlah Transaksi</th>
                                <th>Bukti Pembayaran</th>
                                <th>Tanggal</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="#" class="btn btn-round btn-info" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                    <td><a href="#">#1023</a></td>
                                    <td><span class="badge badge-info">Down Payment</span></td>
                                    <td>Rp. 150,000</td>
                                    <td><a href="#">Lihat</a></td>
                                    <td>Jumat, 27 Agustus 2021 08:58 WIB</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@push('modal')
<div class="modal fade" id="modalFilter" tabindex="-1" role="dialog" aria-labelledby="modalFormTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormTitle">Filter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="filterForm">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label>Jenis Transaksi</label>
                                <select name="transaction_type_id" class="form-control">
                                    <option value="">Pilih Jenis Transaksi</option>
                                    <option value="1">Down Payment</option>
                                    <option value="2">Pelunasan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Rentang Tanggal Transaksi</label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Tanggal Mulai</label>
                                <input type="date" name="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Tanggal Selesai</label>
                                <input type="date" name="" class="form-control">

                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-round btn-primary">
                            Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endpush
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
<style>
    #tbl-orders thead th {
        font-size: 12px !important;
        color: #000 !important;
    }
</style>
@endpush
@push('js')
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script>
    $('#tbl-orders').DataTable();
</script>
@endpush
