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
    
    @include ('layout.kalendar')
    
</div>
<br>
@yield('content')