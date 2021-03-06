@extends('layout.index_admin')
@section('content')
    <div class="admin_menu">
        <a class="admin_setting" href="{{ url("/admin/setting_doctor")}}">Modyfikuj konta lekarzy</a>
        
    </div>
    <div class="admin_menu">
        <a class="admin_setting" href="{{ url("/admin/setting_nurses")}}">Modyfikuj konta pielegniarek</a>
        
    </div>

<div class="body">
    
    
    
    

    
    
    
    
    
    
    
   
    
    <form method="get">
    <table class='table'>
        <tr>
            <td>
                <span class="kalendar">Imię</span>
                
            </td>
            <td width="70%" class="center">
                <span class="name">{{$doctor["name"]}}</span>
            </td>
            
            
        </tr> 
        <tr>
            <td>
                <span class="kalendar">Nazwisko</span>
                
            </td>
            <td width="70%" class="center">
                <span class="name">{{$doctor["lastname"]}}</span>
            </td>
            
            
        </tr> 
        <tr>
            <td>
                <span class="kalendar">Nowe hasło</span>
                
            </td>
            <td width="70%">
                <input type="password" id="password" class="form-control">
            </td>
            
            
        </tr> 
        <tr>
            <td>
                <span class="kalendar">Wpisz jeszcze raz nowe hasło</span>
                
            </td>
            <td width="70%">
                <input type="password" id="password_confirm" class="form-control">
            </td>
            
            
        </tr>
        <tr>
            <td>
                <span class="kalendar">Godzina otwarcia</span>
                
            </td>
            <td width="70%">
                <input type="text" id="hour_open" class="form-control" value="{{$doctor["hour_open"]}}">
            </td>
            
            
        </tr> 
        <tr>
            <td>
                <span class="kalendar">Godzina zamknięcia</span>
                
            </td>
            <td width="70%">
                <input type="text" id="hour_close" class="form-control" value="{{$doctor["hour_close"]}}">
            </td>
            
            
        </tr> 
        <tr>
            <td>
                <span class="kalendar">Nr telefonu</span>
                
            </td>
            <td width="70%">
                <input type="text" id="nr" class="form-control" value="{{$doctor["telefon_nr"]}}">
            </td>
            
            
        </tr> 
        <tr>
            <td width="100%" colspan="2" class="center">
                <input type='button' class="btn btn-primary" onclick="modyfik_doctor_id('{{ url('/admin/modyfik_doctor_id')}}','{{$doctor['id']}}')" value='Modyfikuj'>
            </td>
            
            
        </tr>
        <tr>
            <td width="100%" colspan="2" class="center">
                <div id='result'></div>
            </td>
            
            
        </tr>
    </table>
    </form>
    
</div>

@endsection