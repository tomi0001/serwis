@extends('layout.index_admin')
@section('content')
    <div class="admin_menu">
        <a class="admin_setting" href="{{ url("/admin/setting_doctor")}}">Modyfikuj konta lekarzy</a>
        
    </div>
    <div class="admin_menu">
        <a class="admin_setting" href="{{ url("/admin/setting_nurses")}}">Modyfikuj konta pielegniarek</a>
        
    </div>

<div class="body">
    <span class="kalendar">Czas trwania pojedyńczej wizyty</span>
    <form method="get">
        <input type="text" id="how_visit" value="{{$visit}}" class="form-control">
        <input type="button" value="modyfikuj" class="btn btn-primary" onclick="modyfik_setting('{{ url('/ajax_admin/modyfik_setting')}}')">
    </form>
    <div id="modyfik_setting"></div>
    </div>

@endsection