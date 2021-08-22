@extends('layouts.app', [
'namePage' => 'Rekap Orderan '.$order->futsal_field->name,
'class' => 'login-page sidebar-mini ',
'activePage' => 'rekap',
'backgroundImage' => asset('now') . "/img/bg14.jpg",
'parent' => 'order'
])
@section('title','Detail Order '.$order->futsal_field->name)
@section('content')
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-8 pt-5">
            <div class="d-flex justify-content-between">
                <h2 class="h4 mt-0 mb-4">Detail Order</h2>
                <a href="{{ route('admin.summary.index') }}" class="btn btn-link btn-round d-print-none">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-muted">Pemesan</p>
                        <p class="text-muted"><a href="#">{{ $order->user->name }}</a></p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-muted">Lapangan</p>
                        <p class="text-muted">{{ $order->futsal_field->name }}</p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-muted">Tanggal Sewa</p>
                        <p class="text-muted">{{ \Carbon\Carbon::parse($order->play_date)->locale('id')->translatedFormat('l, d F Y') }}</p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-muted">Jadwal Sewa</p>
                        <p class="text-muted">
                            {{ \Carbon\Carbon::parse($order->start_at)->format('H:i') }} - {{ \Carbon\Carbon::parse($order->end_at)->format('H:i') }} WIB ({{ $order->hours }} jam)
                        </p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-muted">Status Transaksi</p>
                        <p class="text-white">
                            <span class="badge @if ($order->status_transaction_id < 3) bg-danger @elseif($order->status_transaction_id > 4) bg-success @else bg-info @endif">
                                {{ $order->status_transaction->name_admin }}
                            </span>
                        </p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-muted">Total Tagihan</p>
                        <p class="text-success text-bold h2">Rp. {{ number_format($order->hours * $order->price) }}</p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-muted">Tanggal Order</p>
                        <p class="text-muted">{{ $order->created_at->locale('id')->translatedFormat('l, d F Y | H:i:s') }} WIB</p>
                    </div>
                    <a href="#" onclick="window.print()" class="d-print-none btn btn-success btn-round w-100 mr-2"><i
                        class="fas fa-print"></i> Print </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 pt-5">
            <div class="d-flex justify-content-between">
                <h2 class="h4 mt-0 mb-4">Transaksi Pembayaran</h2>
            </div>
            @foreach ($order->transactions as $transaction)
            <div class="card d-print-block">
                <div class="card-body description-box">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-muted">Jenis Pembayaran</p>
                        <p class="text-muted">
                            <span class="badge {{ $transaction->transaction_type_id == 1 ? "badge-info" : "badge-success"}}">
                                {{ $transaction->transaction_type->name }}
                            </span>
                        </p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-muted">Tagihan</p>
                        <p class="text-info h4">Rp.{{ number_format($transaction->code+$transaction->amount) }}</p>
                    </div>                   
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-muted">Metode Pembayaran</p>
                        <p class="text-muted">
                            {{ @$transaction->payment_type->bank_name ? $transaction->payment_type->bank_name : 'Belum Memilih' }}
                        </p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-muted">Bukti Pembayaran</p>
                        <p class="text-muted">
                            @empty($transaction->proof_file)
                                <span class="badge badge-secondary">Belum Membayar</span>
                            @else
                                <a href="{{ asset("storage/".$transaction->proof_file) }}" target="_blank">Download</a>
                            @endempty
                        </p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-muted">Status</p>
                        <p class="text-muted">
                            <span class="badge badge-{{ $transaction->is_valid == 1 ? 'success' : 'danger' }}">{{ $transaction->is_valid == 1 ? 'Pembayaran Valid' : $transaction->order->status_transaction->name_admin }}</span>
                        </p>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between d-print-none">
                    <button type="button" data-id="{{ $transaction->id }}" class="btn btn-primary btn-round w-100 btn-view mr-2"><i
                            class="fas fa-pen"></i> Edit </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
@push('modal')
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalFormTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormTitle">Edit Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="editForm">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label>Metode Pembayaran</label>
                        <p id="paymentMethod">Bank BRI</p>
                        <p><span id="paymentAccount">1231091039</span> a/n <span id="paymentAccountName">Irwan Antonio</span></p>
                    </div>
                    <div class="form-group">
                        <p><a id="paymentProof" href="" target="_blank"><i class="fas fa-download"></i> Bukti Pembayaran</a></p>
                        <label>Tagihan</label>
                        <p class="h4 mt-n2 text-info" id="paymentTotal">Rp. 25.515</p>
                    </div>
                    <div class="form-group">
                        <label class="d-block">Status Pembayaran</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_valid" id="invalid" value="0">
                            <label class="form-check-label" for="invalid">Tidak Valid</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_valid" id="valid" value="1">
                            <label class="form-check-label" for="valid">Valid</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="reset" class="d-none"></button>
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
    $(document).ready(function(){
        $('.btn-view').click(function(){
            const id = $(this).attr('data-id');
            $.ajax({
                url : `{{ url('api/json/transaction') }}/${id}`,
                type : 'get',
                dataType : 'json',
                success : function(data){
                    if(data?.success){
                        const trx = data?.data;
                        $('#paymentMethod').html(trx?.payment_type?.bank_name);
                        $('#paymentAccount').html(trx?.payment_type?.bank_account);
                        $('#paymentAccountName').html(trx?.payment_type?.holder_name);

                        $('#paymentProof').attr('href',`{{ asset("/") }}${trx?.proof_file}`)
                        const total = parseFloat(trx?.code)+parseFloat(trx?.amount);
                        $('#paymentTotal').html(`Rp. ${total.toLocaleString('id')}`);
                        $(`input[name="is_valid"]`).prop('checked',false);
                        $('#editForm').attr('action',`{{ url('admin/transaction/update') }}/${trx.id}`);
                        $(`input[name="is_valid"][value="${trx?.is_valid}"]`).prop('checked',true);
                        console.log(trx?.is_valid);
                        return $('#modalEdit').modal('show');
                    }
                    return toastr("error",data?.message);
                },
                error : function(xhr, status, err){
                    return toastr("error",err);
                }
            })
        });
        $('#editForm').submit(function(e){
            e.preventDefault();
            return swallConfirm(this,'Apakah Anda yakin ingin mengubah status transaksi?','Ya, Saya Yakin');
        })
    })
</script>
@endpush
