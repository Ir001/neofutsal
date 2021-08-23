@extends('layouts.app', [
'namePage' => 'Edit Lapangan',
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
                            Edit Lapangan
                        </div>
                        <a href="{{route('admin.field.index')}}" class="btn btn-round btn-link">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.field.update',['field'=>$field->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label class="form-label">Jenis Lapangan <small class="text-danger">*</small></label>
                            <select name="field_type_id" class="form-control">
                                <option value="" selected disabled>Pilih Jenis Lapangan</option>
                                @foreach ($fieldTypes as $type)
                                    <option value="{{ $type->id }}" {{ old('field_type_id',$field->field_type_id) == $type->id ? 'selected':'' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Gambar Sampul <small class="text-danger">*</small></label>
                                <img src="{{ asset($field->img) }}" alt="" class="img mx-1 mb-3">
                                <input type="file" name="img" class="d-none" id="cover">
                                <div class="px-2 py-3 rounded border text-secondary upload-image" data-target="#cover">
                                    <i class="fas fa-image"></i> Upload Gambar
                                </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                    <label class="form-label">Gambar Detail <small>(opsional)</small></label>
                                    <div class="row my-1">
                                        @foreach ($field->futsal_images as $img)
                                        <div class="col-md-4">
                                            <img src="{{ asset($img->img) }}" alt="" class="img mx-1">
                                        </div>
                                        @endforeach
                                    </div>
                                    <input type="file" name="detail[]" class="d-none" id="images" multiple>
                                    <div class="px-2 py-3 rounded border text-secondary upload-image" data-target="#images">
                                        <i class="fas fa-image"></i> Upload Gambar
                                    </div>
                               </div>
                               <div class="form-group">
                                    <label class="form-label">Lapangan <small class="text-danger">*</small></label>
                                    <input type="text" name="name" placeholder="Nama Lapangan" value="{{ old('name',$field->name) }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Harga Sewa per Jam <small
                                            class="text-danger">*</small></label>
                                    <input type="text" name="price" value="{{ number_format(old('price',$field->price)) }}" inputmode="numeric"
                                        placeholder="(IDR) Harga Sewa per Jam" class="form-control">
                                    <input type="hidden" name="price" value="{{ old('price',$field->price) }}" id="price-submit">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Panjang (meter) <small
                                            class="text-danger">*</small></label>
                                    <input type="text" name="width" value="{{ old('width',$field->width) }}" placeholder="Panjang Lapangan" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Lebar (meter) <small class="text-danger">*</small></label>
                                    <input type="text" name="height" value="{{ old('height',$field->height) }}" placeholder="Lebar Lapangan" class="form-control">
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
@push('css')
<style> .upload-image{ cursor: pointer; overflow:hidden } </style>
@endpush
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
            $('#price-submit').val(val);
        });

        //Upload Image
        $('.upload-image').click(function(){
            const target = $(this).data('target');
            $(target).click();
        })

        //
        $('input[name="detail[]"]').change(function(){
            let images = ``;
            const files = document.querySelector('input[name="detail[]"]').files;
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                images += `<span class="badge badge-info">${file?.name?.split(/(\\|\/)/g).pop()+'\n'}</span>,`;
            }
            if(images == ``){
                images = `<i class="fas fa-image"></i> Upload Gambar`;
            }
            $('.upload-image[data-target="#images"]').html(images);
        })
        $('input[name="img"]').change(function(){
            let images = ``;
            const files = document.querySelector('input[name="img"]').files;
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                images += `<span class="badge badge-info">${file?.name?.split(/(\\|\/)/g).pop()+'\n'}</span>,`;
            }
            if(images == ``){
                images = `<i class="fas fa-image"></i> Upload Gambar`;
            }
            $('.upload-image[data-target="#cover"]').html(images);
        })
    })
</script>
@endpush
