<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="{{ asset('./java.js')}}"></script>

<link href="{{ asset('./style.css') }}" rel="stylesheet"> 
<br><br><br>
<div id='main_admin'>
    <div id='title_admin'>
        <br>
        <div class='admin_menu'>
            <a class="title_admin" href="{{url('/nurses/add_patients')}}">Dodaj nowego Pacjenta</a>
        </div>
        <div class='admin_menu'>
            <a class="title_admin" href="{{url('/nurses/main')}}">Kalendarz</a>
        </div>
        <div class='admin_menu'>
            <a class="title_admin" href="{{url('/nurses/patients_list')}}">Lista pacjentów</a>
        </div>
        <div class='admin_menu'>
            <a class="title_admin" href="{{url('/nurses/logout')}}">Wyloguj się</a>
        </div>
    </div>
    <div id='body_patients'>
      
        <table class='table'>
            <tr>
                <td class='patients_list'>
                    <a class="link" href="{{url('/nurses/patients_list')}}/{{$id}}?sort=name_p&page={{Input::get('page')}}">IMIĘ PACJENTA</a>
                </td>
                <TD class='patients_list'>
                    <a class="link" href="{{url('/nurses/patients_list')}}/{{$id}}?sort=lastname_p&page={{Input::get('page')}}">NAZWISKO PACJNETA</a>
                </TD>
                <TD class='patients_list'>
                    <a class="link" href="{{url('/nurses/patients_list')}}/{{$id}}?sort=name_d&page={{Input::get('page')}}">IMIĘ LEKARZA</a>
                </TD>
                <TD class='patients_list'>
                    <a class="link" href="{{url('/nurses/patients_list')}}/{{$id}}?sort=lastname_d&page={{Input::get('page')}}">NAZWISKO LEKARZA</a>
                </TD>
                <TD class='patients_list'>
                    <a class="link" href="{{url('/nurses/patients_list')}}/{{$id}}?sort=date&page={{Input::get('page')}}">DATA</a>
                </TD>
                <TD class='patients_list'>
                    <a class="link" href="{{url('/nurses/patients_list')}}/{{$id}}?sort=visit&page={{Input::get('page')}}">CZY WIZYTA SIĘ ODBYŁA</a>
                </TD>
                <td>
                    
                </td>
            </tr>
        @foreach ($list as $list_patients) 
         
            <tr id="list_{{$list_patients->id}}">
                <td class='patients_list'>
                    {{$list_patients->name_p}}
                </td>
                <TD class='patients_list'>
                    {{$list_patients->lastname_p}}
                </TD>
                <TD class='patients_list'>
                    {{$list_patients->name_d}}
                </TD>
                <TD class='patients_list'>
                    {{$list_patients->lastname_d}}
                </TD>
                <TD class='patients_list'>
                    {{$list_patients->date}}
                </TD>
                <TD class='patients_list'>
                    @if ($list_patients->visit == 1)
                        <span class="succes">Wizyta odbyła się</span>
                    @else
                        <span class="error">Wizyta nie odbyła się</span>
                    @endif
                </TD>
                
                <TD class='patients_list'>
                    @if ($list_patients->visit == 0)
                    
                    <button class="btn btn-primary" onclick="delete_visit('{{url('/ajax_nurses/delete_visit')}}','{{$list_patients->id}}')">Usuń wizytę</button>
                    @endif
                </TD>
            </tr>
         </div>
            
        @endforeach
        </table>
         <div class='center'>
            {{$list->appends(['sort'=>Input::get('sort')])->links()}}
        </div>
    </div>
   
    
</div>

<br>

