@extends('layouts.app', [
'namePage' => 'Kelola Pengguna',
'class' => 'login-page sidebar-mini ',
'activePage' => 'user',
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
                        <button data-toggle="modal" data-target="#modalCreate" class="btn btn-round btn-primary">
                            <i class="fas fa-plus"></i> Buat Akun
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="get">
                        <div class="form-group">
                            <input type="text" name="q" value="{{ request()->q }}" placeholder="Cari" class="form-control form-control-md">

                        </div>
                    </form>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="pt-2">{{ empty(request()->q) ? 'Total' : 'Hasil Pencarian' }} : {{ $users->count() }} User</p>
                        <div>
                            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                                Reset
                            </a>
                            <button class="btn btn-info">Cari</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {!! $users->links('pagination::bootstrap-4') !!}
                </div>
                @foreach ($users as $user)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-center">
                            <h2 class="h4 card-title">{{ $user->name }}</h2>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <p class="my-1">Role</p>
                                <p class="my-1 text-muted">
                                    @if ($user->is_admin == 1)
                                    <span class="badge badge-success">
                                        Superadmin
                                    </span>
                                    @else
                                    <span class="badge badge-primary">
                                        Customer
                                    </span>
                                    @endif
                                </p>
                            </div>
                            <div class="mb-3">
                                <p class="my-1">Email</p>
                                <p class="my-1 text-muted">
                                    {{ $user->email }}
                                </p>
                            </div>
                            <div class="mb-3">
                                <p class="my-1">WhatsApp</p>
                                <p class="my-1 text-muted">
                                    {{ $user->phone }}
                                </p>
                            </div>
                            <div class="mb-3">
                                <p class="my-1">Bergabung pada</p>
                                <p class="my-1 text-muted">
                                    {{ $user->created_at->locale('id')->translatedFormat('l, d F Y | H:i:s') }} WIB
                                </p>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <button type="button" data-id="{{ $user->id }}" class="btn btn-info btn-round btn-edit w-100 mr-2"><i class="fas fa-pen"></i></button>
                            <button type="button" data-id="{{ $user->id }}" class="btn btn-danger btn-round btn-delete w-100"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>    
                @endforeach
                <div class="col-md-12">
                    {!! $users->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('modal')
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modalFormTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormTitle">Create User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.user.store') }}" method="post" id="createForm">
                    @csrf
                    <div class="form-group">
                        <label>Nama Lengkap <small class="text-danger">*</small></label>
                        <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email <small class="text-danger">*</small></label>
                        <input type="email" name="email" placeholder="Email Valid" value="{{ old('email') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>WhatsApp <small class="text-danger">*</small></label>
                        <input type="text" name="phone" placeholder="WhatsApp" value="{{ old('phone') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="d-block">Role <small class="text-danger">*</small></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_admin" id="admin" value="1" {{ old('is_admin') == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="admin">Admin</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_admin" id="customer" value="0" {{ old('is_admin') == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="customer">Customer</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password <small class="text-danger">*</small></label>
                        <input type="password" name="password" placeholder="Password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password  <small class="text-danger">*</small></label>
                        <input type="password" name="password_confirmation" placeholder="Ketik Ulang Password" class="form-control">
                    </div>
                    <input type="hidden" name="is_aggree" value="1">
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-round btn-primary">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalFormTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormTitle">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="editForm">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label>Nama Lengkap <small class="text-danger">*</small></label>
                        <input type="text" name="name" placeholder="Nama Lengkap" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>WhatsApp <small class="text-danger">*</small></label>
                        <input type="text" name="phone" placeholder="WhatsApp" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="d-block">Role <small class="text-danger">*</small></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_admin" id="admin" value="1">
                            <label class="form-check-label" for="admin">Admin</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_admin" id="customer" value="0">
                            <label class="form-check-label" for="customer">Customer</label>
                        </div>
                    </div>
                    <p class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-info-circle"></i> Isi formulir dibawah jika ingin mengubah password
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </p>
                    <div class="form-group">
                        <label>Password (opsional)</label>
                        <input type="password" name="password" placeholder="Ganti Password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" placeholder="Ketik Ulang Password Baru" class="form-control">
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-round btn-primary">
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
        // Edit Click
        $('.btn-edit').click(function(){
            const id = $(this).data('id');
            $.ajax({
                url : `{{ url("api/json/user") }}/${id}`,
                type : 'get',
                dataType : 'json',
                success : function(data){
                    if(data?.success){
                        const user = data.data;
                        const form = $('#editForm');
                        form.find('input[name=name]').val(user?.name);
                        form.find('input[name=email]').val(user?.email);
                        form.find('input[name=phone]').val(user?.phone);
                        form.find(`input[name=is_admin][value=${user?.is_admin}]`).prop('checked',true);
                        form.attr('action',`{{ route('admin.user.store')}}/update/${id}`);
                        return $('#modalEdit').modal('show');
                    }
                    toastr('error','Undefined Error!');
                },
                error : function(xhr, status, err){
                    toastr('error',err.toString());
                }
            })
        })
        // Edit Submit
        $('#editForm').submit(function(e){
            e.preventDefault();
            return swallConfirm(this,'Anda yakin ingin mengubah data user?','Ya, Saya Yakin');
        })
        // Delete Click
        $('.btn-delete').click(function(){
            const id = $(this).data('id');
            confirmDelete('Apakah Anda yakin ingin menghapus User?',function(){
                $.ajax({
                    url : `{{ route('admin.user.store') }}/delete/${id}`,
                    type : 'DELETE',
                    dataType : 'json',
                    data : $(this).serialize(),
                    success : function(data){
                        if(data?.success){
                            toastr('success',data?.message,'Tutup');
                            return setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        }
                        return toasstr('error',data?.message)
                    },
                    error : function(xhr, status, err){
                        return toasstr('error',err.toString())
                    }
                })
            })
        })
    })
</script>
@endpush
