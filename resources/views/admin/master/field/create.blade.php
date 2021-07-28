@extends('layouts.app', [
'namePage' => 'Tambah Lapangan',
'class' => 'login-page sidebar-mini ',
'activePage' => 'field',
'backgroundImage' => asset('now') . "/img/bg14.jpg",
'parent' => 'master'
])
@section('title','Lapangan')
@section('content')
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="card-title">
                            Tambah Lapangan
                        </div>
                        <a href="{{route('admin.field.index')}}" class="btn btn-round btn-link">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.field.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Jenis Lapangan <small class="text-danger">*</small></label>
                            <select name="field_type_id" class="form-control">
                                <option value="" selected disabled>Pilih Jenis Lapangan</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Lapangan <small class="text-danger">*</small></label>
                                    <input type="text" name="name" placeholder="Nama Lapangan" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Harga Sewa per Jam <small
                                            class="text-danger">*</small></label>
                                    <input type="text" name="price" inputmode="numeric"
                                        placeholder="(IDR) Harga Sewa per Jam" class="form-control" value="0">
                                    <input type="hidden" name="price" id="price-submit">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Panjang (meter) <small
                                            class="text-danger">*</small></label>
                                    <input type="text" name="width" placeholder="Panjang Lapangan" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Lebar (meter) <small class="text-danger">*</small></label>
                                    <input type="text" name="height" placeholder="Lebar Lapangan" class="form-control">
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
    let cleanNumber = (value) => {
        value = value.toString();
        value = value.replace(/,/g, '');
        value = value.replace(/[^\d.-]/g, '');
        return parseFloat(value);
    }
    let formatNumber = (angka) => {
        angka = cleanNumber(angka);
        var rupiah = '';
        var angkarev = angka.toString().split('').reverse().join('');
        for (var i = 0; i < angkarev.length; i++)
            if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + ',';
        return rupiah.split('', rupiah.length - 1).reverse().join('');
    }
    $(document).ready(function(){
        //price
        let price = $('input[name=price]');
        price.keyup(function(){
            let val = $(this).val();
            val = cleanNumber(val);
            $(this).val((isNaN(val) ? 0 : formatNumber(val)));
        });
        //on submit
        $('form').submit(function(e){
            e.preventDefault();
            $('#price-submit').val(cleanNumber(price.val()));
            let url = $(this).attr('action');
            let type = $(this).attr('method');
            let data = $(this).serialize();
            submitForm({
                url : url,
                type : type,
                data : data,
                successCallback : function(){
                    $('button[type=reset]').click();
                }
            });
        })
    })
</script>
@endpush
