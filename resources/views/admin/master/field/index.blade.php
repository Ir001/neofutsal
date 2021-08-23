@extends('layouts.app', [
'namePage' => 'Kelola Lapangan',
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="card-title">
                            Kelola Lapangan
                        </div>
                        <a href="{{route('admin.field.create')}}" class="btn btn-round btn-primary">
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
                        <p class="pt-2">{{ empty(request()->q) ? 'Total' : 'Hasil Pencarian' }} : {{ $fields->count() }} Lapangan</p>
                        <div>
                            <a href="{{ route('admin.field.index') }}" class="btn btn-secondary">Reset</a>
                            <button type="submit" class="btn btn-info">Cari</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12"> {{ $fields->links("pagination::bootstrap-4") }} </div>
                @foreach ($fields as $field)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title text-center h5">{{ $field->name }}</div>
                            <img src="{{ asset($field->img) }}" alt="" class="img" style="object-fit:cover;width:100%;max-height:150px">
                        </div>
                        <div class="card-body description-box">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Harga Sewa per Jam</p>
                                <p class="text-info h5">Rp. {{ number_format($field->price) }}</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Jenis Lapangan</p>
                                <p class="text-muted">{{ $field->field_type->name }}</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Status</p>
                                <p class="text-muted">
                                    <span class="badge badge-{{ $field->is_available == 1 ? 'success' : 'danger' }}">
                                        {{ $field->is_available == 1 ? 'Tersedia' : 'Tidak Tersedia' }}
                                    </span>
                                </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Panjang</p>
                                <p class="text-muted">{{ $field->width }} m</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">Lebar</p>
                                <p class="text-muted">{{ $field->height }} m</p>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <button type="button" class="btn-view btn btn-primary btn-round w-100 mr-2"><i class="fas fa-eye"></i></button>
                            <a href="{{ route('admin.field.edit',['field'=>$field->id])."" }}" class="btn-edit btn btn-info btn-round w-100 mr-2"><i class="fas fa-pen"></i></a>
                            <button type="button" data-id="{{ $field->id }}" class="btn-delete btn btn-danger btn-round w-100"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-md-12"> {{ $fields->links("pagination::bootstrap-4") }} </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

<script>
    $(document).ready(function(){
        // Delete Field
        $('.btn-delete').click(function(){
            const id = $(this).data('id');
            return confirmDelete('Anda yakin ingin menghapus lapangan?',function(){
                $.ajax({
                    url : `{{ route('admin.field.store') }}/delete/${id}`,
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
                        return  toastr('error',data?.message,'Tutup');
                         
                    },
                    error : function(xhr, status, err){
                        return  toastr('error',err.toString(),'Tutup');
                    }
                })
            })
        })
    });
</script>
@endpush
