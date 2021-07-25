@extends('layouts.app', [
'namePage' => 'Dashboard',
'class' => 'login-page sidebar-mini ',
'activePage' => 'home',
'backgroundImage' => asset('now') . "/img/bg14.jpg",
])
@section('title','Dashboard')
@section('content')
<div class="panel-header panel-header-sm">
</div>
<div class="content">
</div>
@endsection

@push('js')
@endpush
