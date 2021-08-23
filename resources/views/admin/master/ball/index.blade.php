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
                        <a href="#" data-toggle="modal" data-target="#modalCreate" class="btn btn-round btn-primary">
                            <i class="fas fa-plus"></i> Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="get">
                        <div class="form-group">
                            <input type="text" name="q" value="{{ request()->q }}" placeholder="Cari" class="form-control form-control-md">

                        </div>
                    </form>
                    <div class="d-flex justify-content-between">
                        <p class="mt-3">
                            Hasil : {{ $balls->count() }}
                        </p>
                        <div>
                            <a href="{{ route('admin.ball.index') }}" class="btn btn-secondary">Reset</a>
                            <button class="btn btn-info">Cari</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">{{ $balls->links("pagination::bootstrap-4") }}</div>
                @foreach ($balls as $ball)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title h4 text-center">{{ $ball->name }}</h2>
                        </div>
                        <div class="card-body description-box">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Status</p>
                                <p class="text-muted">
                                    @if ($ball->is_available == 1)
                                        <span class="badge badge-success"> Tersedia </span>
                                    @else
                                        <span class="badge badge-danger"> Tidak tersedia </span>
                                    @endif
                                </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Jumlah</p>
                                <p class="text-muted">{{ $ball->amount }} Bola</p>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <button type="button" data-id="{{ $ball->id }}" class="btn btn-info btn-round w-100 mr-2 btn-edit">
                                <i class="fas fa-pen"></i>
                            </button>
                            <button type="button" data-id="{{ $ball->id }}" class="btn btn-danger btn-round w-100 btn-delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-md-12">{{ $balls->links("pagination::bootstrap-4") }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('modal')
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modalCreateTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.ball.store')}}" method="post" id="formCreate">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">Jenis Bola <small class="text-danger">*</small></label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Jenis Bola" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Jumlah <small class="text-info">(optional)</small></label>
                        <input type="text" name="amount" value="{{ old('amount') }}" inputmode="numeric" placeholder="Jumlah Bola"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="d-block">Status <small class="text-danger">*</small></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_available" id="available" value="1" {{ old('is_available') == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="available">Tersedia</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_available" id="not_available" value="0" {{ old('is_available') == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="not_available">Tidak Tersedia</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal"
                            aria-label="Close">
                            Tutup
                        </button>
                        <button type="reset" class="d-none"></button>
                        <button type="submit" class="btn btn-info btn-round">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Bola</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formEdit">
                    @csrf
                    @method("PATCH")
                    <div class="form-group mb-3">
                        <label class="form-label">Jenis Bola <small class="text-danger">*</small></label>
                        <input type="text" name="name" placeholder="Jenis Bola" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Jumlah <small class="text-info">(optional)</small></label>
                        <input type="text" name="amount" inputmode="numeric" placeholder="Jumlah Bola"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="d-block">Status <small class="text-danger">*</small></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_available" id="available1" value="1">
                            <label class="form-check-label" for="available1">Tersedia</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_available" id="not_available1" value="0">
                            <label class="form-check-label" for="not_available1">Tidak Tersedia</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal"
                            aria-label="Close">
                            Tutup
                        </button>
                        <button type="reset" class="d-none"></button>
                        <button type="submit" class="btn btn-info btn-round" id="btnSave">
                            Simpan Perubahan
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
        $('.btn-edit').click(function(){
            const id = $(this).data('id');
           $.ajax({
               url : `{{ url("api/json/ball") }}/${id}`,
               type : 'get',
               dataType : 'json',
               success : function(data){
                   if(data?.success){
                        const ball = data?.data;
                        const formEdit = $('#formEdit');
                        formEdit.attr('action',`{{ route("admin.ball.store") }}/update/${ball?.id}`);
                        formEdit.find("input[name='name']").val(ball?.name);
                        formEdit.find("input[name='amount']").val(ball?.amount);
                        formEdit.find(`input[name='is_available'][value='${ball?.is_available}']`).prop("checked",true);
                        return $('#modalEdit').modal('show');
                    }
                    return toastr("error","Invalid Error! Try again later");
                },
                error : function(xhr, status, err){
                   return toastr("error",`${err.toString()}`);
               }
           })
        });
        $('.btn-delete').click(function(){
            const id = $(this).data('id');
            return confirmDelete(`Anda yakin ingin menghapus Jenis Bola?`,function(){
                $.ajax({
                    url : `{{ route("admin.ball.store") }}/delete/${id}`,
                    type : 'DELETE',
                    dataType : 'json',
                    data : $(this).serialize(),
                    success : function(data){
                        if(data?.success){
                            toastr("success",data?.message);
                            return setTimeout(() => {
                                window.location.reload();
                            }, 800);
                        }
                        return toastr("error","Undefined Error!");
                    },
                    error : function(xhr, status, err){
                        return toastr("error",err.toString());
                    }
                })
            });
        })
    })
</script>
@endpush
