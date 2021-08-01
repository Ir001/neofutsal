@extends('layouts.app', [
'namePage' => 'Kelola Metode Pembayaran',
'class' => 'login-page sidebar-mini ',
'activePage' => 'payment-type',
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
                            Kelola Metode Pembayaran
                        </div>
                        <a href="#" data-toggle="modal" data-target="#modalForm" class="btn btn-round btn-primary">
                            <i class="fas fa-plus"></i> Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="get">
                        <div class="form-group">
                            <input type="text" name="q" placeholder="Cari" class="form-control form-control-md">

                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-info">Cari</button>
                        </div>
                    </form>

                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">BRI Payment</div>
                        </div>
                        <div class="card-body description-box">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Kode Bank</p>
                                <p class="text-muted">002</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Nomor Rekening</p>
                                <p class="text-muted">819289189213</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Status</p>
                                <p class="text-muted">
                                    <span class="badge badge-success">Aktif</span>
                                </p>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="#" data-id="1" class="btn btn-info btn-round w-100 btn-edit mr-2"><i
                                    class="fas fa-pen"></i></a>
                            <a href="#" data-id="1" class="btn btn-primary btn-round w-100 btn-view mr-2"><i
                                    class="fas fa-eye"></i></a>
                            <a href="#" data-id="1" class="btn btn-danger btn-round btn-delete w-100"><i
                                    class="fas fa-trash"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('modal')
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalFormTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormTitle">Tambah Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.paymentType.store')}}" method="post" id="formModal">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Nama Pembayaraan <small class="text-danger">*</small></label>
                                <input type="text" name="bank_name" placeholder="Nama bank / Jenis Pembayaran"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Kode <small class="text-danger">*</small></label>
                                <input type="text" name="bank_code" inputmode="numeric"
                                    placeholder="Kode Bank / Kode Pembayaran" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Nomor Rekening <small class="text-danger">*</small></label>
                                <input type="text" name="bank_account" inputmode="numeric"
                                    placeholder="Nomor Rekening / Pembayaran" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Status <small class="text-danger">*</small></label>
                                <div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="status1" name="status" class="custom-control-input">
                                        <label class="custom-control-label" for="status1">Aktif</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="status2" name="status" class="custom-control-input">
                                        <label class="custom-control-label" for="status2">Tidak Aktif</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Tata Cara Pembayaran <small class="text-danger">*</small></label>
                            <textarea name="description" rows="3" class="form-control"
                                placeholder="Tata Cara Pembayaran"></textarea>
                        </div>
                    </div>


                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal"
                            aria-label="Close">
                            Tutup
                        </button>
                        <button type="reset" class="d-none"></button>
                        <button type="submit" class="btn btn-info btn-round" id="btnSave">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endpush
@push('js')
<script>
    $(document).ready(function(){
        //on btn-edit click
        $('.btn-edit').click(function(){
            let id = $(this).attr('data-id');
            $('#modalForm').modal('show');
            $('#modalFormTitle').html(`Edit Jenis Pembayaran`);
            $('#formModal').attr('action');
            $('#btnSave').html(`Simpan Perubahan`);
        });
        //modal on close
        $('#modalForm').on('hidden.bs.modal', function () {
            //setting form to defaul
            $('#formModal').attr('action',`{{route('admin.ball.store')}}`)
            $('#modalFormTitle').html(`Tambah Baru`);
            $('#btnSave').html(`Simpan`);
        });
        //on form submit
        $('#formModal').submit(function(e){
            e.preventDefault();
            let button = $(this).find('button[type=submit]');
            let url = $(this).attr('action');
            let data = $(this).serialize();
            let type = $(this).attr('method');
            submitForm({
                url,
                type,
                data,
                button,
                successCallback : ()=>{
                    $(this).find('button[type=reset]').click();
                    $('#modalForm').modal('hide');
                }
            });
        })
    })
</script>
@endpush
