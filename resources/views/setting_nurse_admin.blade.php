@extends('layout.index_admin')
@section('content')
    <div class="admin_menu">
        <a class="admin_setting" href="{{ url("/admin/setting_doctor")}}">Modyfikuj konta lekarzy</a>
        
    </div>
    <div class="admin_menu">
        <a class="admin_setting" href="{{ url("/admin/setting_nurses")}}">Modyfikuj konta pielegniarek</a>
        
    </div>

<div class="body">
    
    
    
    
    <table class="table center">
        <tr>
            <th>
                IMIĘ
                
            </th>
            <th>
                NAZWISKO
            </th>
            
        </tr>
        
        @foreach ($nurse as $nurse2)
       
            
        <tr class="href" onclick="document.location='{{url('/admin/setting_nurse')}}/{{$nurse2->id}}'">
            <td >
              {{$nurse2->name}} 
            </td >
            <td>
              {{$nurse2->lastname}} 
            </td>
            
        </tr>
       
        @endforeach

        
    </table>
    
    
    
    
    
    
    
    
    
 
</div>

@endsection