<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="{{ asset('./java.js')}}"></script>

<link href="{{ asset('./style.css') }}" rel="stylesheet"> 
<div id='body'>
    <div id="top">



    </div>
<br>
<div id='down'>
    <a href="{{url('statistic')}}" class="menu">STATYSTYKI</a>
    <a href="{{url('profile')}}" class="menu">MÓJ PROFIL</a>
    <a href="{{url('show_search_friends')}}" class="menu">WYSZUKAJ</a>
    
</div>
    @yield('content')
</div>