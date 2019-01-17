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
        <form action='{{url('/nurses/patients_list')}}' method='get'>
            <div class='row'>
              <div class='col-md-4 center'>
                Imię pacjenta <input type='text' name='name' class='form-control'>
              </div>
              <div class='col-md-4 center'>
                Nazwisko pacjenta pacjenta <input type='text' name='lastname' class='form-control'>
              </div>
              <div class='col-md-4 center'>
                data urodzenia <input type='text' name='date_born' class='form-control'>
              </div>
            </div>
            <div class='row'>
              <div class='col-md-12 center'>
                  <input type='submit' value='szukaj' class='btn btn-primary'>
              </div>
             
            </div>
        </form>
        <table class='table'>
            <tr>
                <td class='patients'>
                    <a class="link" href="{{ url('/nurses/patients_list')}}/?page={{Input::get('page')}}&sort=name&name={{$name}}&lastname={{$lastname}}&date_born={{$date_born}}"> IMIĘ</a>
                </td>
                <TD class='patients'>
                    <a class="link" href="{{ url('/nurses/patients_list')}}/?page={{Input::get('page')}}&sort=lastname&name={{$name}}&lastname={{$lastname}}&date_born={{$date_born}}"> NAZWISKO</a>
                </TD>
                <TD class='patients'>
                    <a class="link" href="{{ url('/nurses/patients_list')}}/?page={{Input::get('page')}}&sort=pesel&name={{$name}}&lastname={{$lastname}}&date_born={{$date_born}}"> PESEL</a>
                </TD>
                <TD class='patients'>
                    <a class="link" href="{{ url('/nurses/patients_list')}}/?page={{Input::get('page')}}&sort=date_born&name={{$name}}&lastname={{$lastname}}&date_born={{$date_born}}"> DATA URODZENIA</a>
                </TD>
                <TD class='patients'>
                    <a class="link" href="{{ url('/nurses/patients_list')}}/?page={{Input::get('page')}}&sort=adress&name={{$name}}&lastname={{$lastname}}&date_born={{$date_born}}"> ADRES</a>
                </TD>
                <TD class='patients'>
                    <a class="link" href="{{ url('/nurses/patients_list')}}/?page={{Input::get('page')}}&sort=telefon_nr&name={{$name}}&lastname={{$lastname}}&date_born={{$date_born}}"> NR TELEFONU</a>
                </TD>
            </tr>
        @foreach ($list_patients as $list) 
            <tr  class="href" onclick="document.location='{{url('/nurses/patients_list')}}/{{$list->id}}'">
                <td class='patients_list'>
                    {{$list->name}}
                </td>
                <TD class='patients_list'>
                    {{$list->lastname}}
                </TD>
                <TD class='patients_list'>
                    {{$list->pesel}}
                </TD>
                <TD class='patients_list'>
                    {{$list->date_born}}
                </TD>
                <TD class='patients_list'>
                    {{$list->adress}}
                </TD>
                <TD class='patients_list'>
                    {{$list->telefon_nr}}
                </TD>
            </tr>
            
            
        @endforeach
        </table>
        <div class='center'>
            {{$list_patients->appends(['name' => $name])->appends(['lastname' => $lastname])->appends(['date_born'=>$date_born])->appends(['sort'=>Input::get('sort')])->links()}}
        </div>
    </div>
   
    
</div>

<br>

