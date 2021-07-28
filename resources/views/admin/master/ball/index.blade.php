@extends('layouts.app', [
'namePage' => 'Kelola Jenis Bola',
'class' => 'login-page sidebar-mini ',
'activePage' => 'ball',
'backgroundImage' => asset('now') . "/img/bg14.jpg",
'parent' => 'master'
])
@section('title','Jenis Bola')
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
                            Kelola Jenis Bola
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
                            <h2 class="card-title h4 text-center">Besar</h2>
                        </div>
                        <div class="card-body description-box">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Jumlah</p>
                                <p class="text-muted">8 Bola</p>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <button type="button" data-id="" class="btn btn-info btn-round w-100 mr-2 btn-edit">
                                <i class="fas fa-pen"></i>
                            </button>
                            <button type="button" data-id="" class="btn btn-danger btn-round w-100 btn-delete">
                                <i class="fas fa-trash"></i>
                            </button>
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
                <form action="{{route('admin.ball.store')}}" method="post" id="formModal">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">Jenis Bola <small class="text-danger">*</small></label>
                        <input type="text" name="name" placeholder="Jenis Bola" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Jumlah <small class="text-info">(optional)</small></label>
                        <input type="text" name="name" inputmode="numeric" placeholder="Jumlah Bola"
                            class="form-control">
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
            $('#modalFormTitle').html(`Edit Jenis Bola`);
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
