@extends('layouts.app', [
'namePage' => 'Rekap Orderan',
'class' => 'login-page sidebar-mini ',
'activePage' => 'rekap',
'backgroundImage' => asset('now') . "/img/bg14.jpg",
'parent' => 'order'
])
@section('title','Rekap Orderan')
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
                            Rekap Orderan
                        </div>
                        {{-- <a href="#" data-toggle="modal" data-target="#modalFilter" class="btn btn-round btn-primary">
                            <i class="fas fa-filter"></i> Filter
                        </a> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tbl-orders">
                            <thead>
                                <th></th>
                                <th>Pemesaan</th>
                                <th>Lapangan</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Jadwal</th>
                                <th>Total Tagihan</th>
                                <th>Tanggal Order</th>
                                <th>Terakhir Diubah</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            {{-- <div class="d-flex justify-content-between">
                <h2 class="h4 mt-0 mb-4">Rekap Orderan Terbaru</h2>
                <a href="#" class="btn btn-info btn-round">
                    <i class="fas fa-filter"></i> Filter by
                </a>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Lapangan X</div>
                        </div>
                        <div class="card-body description-box">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Pemesan</p>
                                <p class="text-muted"><a href="#">Irwan Antonio</a></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Tanggal</p>
                                <p class="text-muted">Jumat, 27 Agustus 2021</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Waktu</p>
                                <p class="text-muted">08:00 - 10:00 WIB (2 jam)</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Tagihan</p>
                                <p class="text-muted">2 x 75,000 = Rp. 150,000</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Skema Pembayaran</p>
                                <p class="text-muted">
                                    <span class="badge badge-info">Down Payment</span>
                                    <span class="badge badge-primary">Bayar Full</span>
                                </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Metode Pembayaran</p>
                                <p class="text-muted">
                                    BRI Transfer
                                </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Bukti Pembayaran</p>
                                <p class="text-muted">
                                    <span class="badge badge-secondary">Belum Membayar</span>
                                    <img src="" alt="" class="img">
                                </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Status</p>
                                <p class="text-muted">
                                    <span class="badge badge-secondary">Belum Membayar</span>
                                    <span class="badge badge-danger">Expired</span>
                                    <span class="badge badge-danger">Pembayaran Tidak Valid</span>
                                    <span class="badge badge-info">Menunggu Konfirmasi</span>
                                    <span class="badge badge-primary">DP Terkonfirmasi</span>
                                    <span class="badge badge-success">Lunas</span>
                                </p>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="#" data-id="1" class="btn btn-primary btn-round w-100 btn-view mr-2"><i
                                    class="fas fa-eye"></i> Detail </a>
                            <a href="#" data-id="1" class="btn btn-success btn-round w-100 btn-view mr-2"><i
                                    class="fas fa-print"></i> Print </a>
                        </div>
                    </div>
                </div>
            </div> --}}
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
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Pemesan</label>
                                <select name="user_id" class="form-control">
                                    <option value="">Pilih Pemesan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Lapangan</label>
                                <select name="futsal_field_id" class="form-control">
                                    <option value="">Pilih Lapangan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Status</label>
                                <select name="status_id" class="form-control">
                                    <option value="">Pilih Status</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Skema Pembayaran</label>
                                <select name="status_id" class="form-control">
                                    <option value="">Pilih Status</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Rentang Jadwal</label>
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
    $('#tbl-orders').DataTable({
        ajax : {
            url : `{{ route('api.orders') }}`         
        },
        serverSide : true,
        processing : true,
        columns : [
            {
                render :function(data,type,row){
                    return `<a href="{{ route('admin.summary.store') }}/${row.id}" class="btn btn-round btn-info" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>`;
                },
                data : 'id'
            },
            {
                data : 'user.name'
            },
            {
                data : 'futsal_field.name'
            },
            {
                name : 'status_transaction.id',
                data : 'status_transaction.name_admin'
            },
            {
                data:'play_date',
            },
            {   render: function(data,type,row){
                    return `${row?.start_at} - ${row?.end_at} (${row?.hours} jam)`;
                },
                data : 'hours'
            },
            {
                render: function(data,type,row){
                    return `Rp. ${row?.total?.toLocaleString('id')}`;
                },
                data : 'total'
            },
            {
                data : 'created_at'
            },
            {
                data : 'updated_at'
            },
        ],
    });
</script>
@endpush
