@extends('layouts.app', [
'namePage' => 'Buat Akun',
'class' => 'login-page sidebar-mini ',
'activePage' => 'user',
'backgroundImage' => asset('now') . "/img/bg14.jpg",
'parent' => 'master'
])
@section('title','Lapangan')
@section('content')
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="card-title">
                            Buat Akun
                        </div>
                        <a href="{{route('admin.user.index')}}" class="btn btn-round btn-link">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.customer.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Nama Lengkap <small class="text-danger">*</small></label>
                                    <input type="text" name="name" placeholder="Nama Lengkap" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Email <small class="text-danger">*</small></label>
                                    <input type="email" name="email" placeholder="Email Aktif" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">WhatsApp <small class="text-danger">*</small></label>
                                    <input type="text" name="phone" placeholder="WhatsApp" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Password <small class="text-danger">*</small></label>
                                    <input type="password" name="password" placeholder="Password" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Konfirmasi Password<small
                                            class="text-danger">*</small></label>
                                    <input type="password" name="password_confirmation"
                                        placeholder="Ketik ulang Password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-end">
                                <button class="d-none" type="reset"></button>
                                <button class="btn btn-info" type="submit">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function(){
        //on submit
        $('form').submit(function(e){
            e.preventDefault();
            let button = $(this).find('button[type=submit]');
            let url = $(this).attr('action');
            let type = $(this).attr('method');
            let data = $(this).serialize();
            submitForm({
                url,
                type,
                data,
                successCallback : function(){
                    $('button[type=reset]').click();
                },
                button : button
            });
        })
    })
</script>
@endpush
