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
                        <div class="d-flex justify-content-between">
                            <p class="mt-4">Hasil : {{ $paymentTypes->count() }}</p>
                            <div>
                                <a href="{{ route('admin.paymentType.index') }}" class="btn btn-secondary">Reset</a>
                                <button type="submit" class="btn btn-info">Cari</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">{{ $paymentTypes->links("pagination::bootstrap-4") }}</div>
                @foreach ($paymentTypes as $payment)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{ $payment->bank_name }}</div>
                        </div>
                        <div class="card-body description-box">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Kode Bank</p>
                                <p class="text-muted">{{ $payment->bank_code }}</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Nomor Rekening</p>
                                <p class="text-muted">{{ $payment->bank_account }}</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Atas Nama</p>
                                <p class="text-muted">{{ $payment->holder_name }}</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Status</p>
                                <p class="text-muted">
                                    @if ($payment->is_active == 1)
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-danger">Tidak Aktif</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="#" data-id="{{ $payment->id }}" class="btn btn-info btn-round w-100 btn-edit mr-2"><i
                                    class="fas fa-pen"></i></a>
                            <a href="#" data-id="{{ $payment->id }}" class="btn btn-danger btn-round btn-delete w-100"><i
                                    class="fas fa-trash"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-md-12">{{ $paymentTypes->links("pagination::bootstrap-4") }}</div>
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
                <form action="{{route('admin.paymentType.store')}}" method="post" id="formCreate">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Nama Pembayaraan <small class="text-danger">*</small></label>
                                <input type="text" name="bank_name" placeholder="Nama bank / Metode Pembayaran"
                                    class="form-control" value="{{ old('bank_name') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Kode <small class="text-danger">*</small></label>
                                <input type="text" name="bank_code" inputmode="numeric"
                                    placeholder="Kode Bank / Kode Pembayaran" class="form-control" value="{{ old('bank_code') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Nomor Rekening <small class="text-danger">*</small></label>
                                <input type="text" name="bank_account" inputmode="numeric"
                                    placeholder="Nomor Rekening / Pembayaran" class="form-control" value="{{ old('bank_account') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Atas Nama <small class="text-danger">*</small></label>
                                <input type="text" name="holder_name" inputmode="numeric"
                                    placeholder="Atas Nama" class="form-control" value="{{ old('holder_name') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Status <small class="text-danger">*</small></label>
                                <div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="active" name="is_active" value="1" {{ old('is_active') == 1 ? 'checked' : '' }} class="custom-control-input">
                                        <label class="custom-control-label" for="active">Aktif</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="nonactive" name="is_active" value="0" {{ old('is_active') == 0 ? 'checked' : '' }} class="custom-control-input">
                                        <label class="custom-control-label" for="nonactive">Tidak Aktif</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Tata Cara Pembayaran <small class="text-danger">*</small></label>
                            <textarea name="instruction" rows="15" class="form-control"
                                placeholder="Tata Cara Pembayaran">{{ old('instruction') }}</textarea>
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
                <h5 class="modal-title">Edit Metode Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formEdit">
                    @csrf
                    @method("PATCH")
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Nama Pembayaraan <small class="text-danger">*</small></label>
                                <input type="text" name="bank_name" placeholder="Nama bank / Metode Pembayaran"
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
                                <label class="form-label">Atas Nama <small class="text-danger">*</small></label>
                                <input type="text" name="holder_name" inputmode="numeric"
                                    placeholder="Atas Nama" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Status <small class="text-danger">*</small></label>
                                <div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="active1" name="is_active" value="1" class="custom-control-input">
                                        <label class="custom-control-label" for="active1">Aktif</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="nonactive1" name="is_active" value="0" class="custom-control-input">
                                        <label class="custom-control-label" for="nonactive1">Tidak Aktif</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Tata Cara Pembayaran <small class="text-danger">*</small></label>
                            <textarea name="instruction" rows="15" class="form-control"
                                placeholder="Tata Cara Pembayaran"></textarea>
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
@endpush
@push('js')
<script>
    $(document).ready(function(){
        $('.btn-edit').click(function(){
            const id = $(this).data('id');
            $.ajax({
                url : `{{ url("api/json/payment-type") }}/${id}`,
                type : 'GET',
                dataType : 'json',
                success : function(data){
                    if(data?.success){
                        const formEdit = $('#formEdit');
                        const payment = data?.data;
                        formEdit.find("input[name=bank_name]").val(payment?.bank_name);
                        formEdit.find("input[name=bank_code]").val(payment?.bank_code);
                        formEdit.find("input[name=bank_account]").val(payment?.bank_account);
                        formEdit.find("input[name=holder_name]").val(payment?.holder_name);
                        formEdit.find(`[name=is_active][value=${payment?.is_active}]`).prop("checked",true);
                        formEdit.find("textarea[name=instruction]").val(payment?.instruction);
                        formEdit.attr(`action`,`{{ route('admin.paymentType.store') }}/update/${id}`);
                        return $('#modalEdit').modal('show');
                    }
                    return toastr("error","Undefined Error!");
                },
                error : function(xhr, status, err){
                    return toastr("error",err.toString());
                }
            })
        });
        $('.btn-delete').click(function(){
            const id = $(this).data('id');
            return confirmDelete('Anda yakin ingin menghapus metode pembayaran?',function(){
                $.ajax({
                    url : `{{ route('admin.paymentType.store') }}/delete/${id}`,
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
        });
    })
</script>
@endpush
