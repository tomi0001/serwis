<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="{{ asset('./java.js')}}"></script>

<link href="{{ asset('./style.css') }}" rel="stylesheet"> 
<br><br><br>
<div id='main_admin'>
    <div id='title_admin'>
        <br>
        <div class='title'>
            <a class="title_admin" href="{{url('/nurses/add_patients')}}">Dodaj nowego Pacjenta</a>
        </div>
        <div class='title'>
            <a class="title_admin" href="{{url('/nurses/main')}}">Kalendarz</a>
        </div>
        <div class='title'>
            <a class="title_admin" href="{{url('/nurses/logout')}}">Wyloguj się</a>
        </div>
    </div>
    
    <div id="add_patients">
        <br>
        <form  method="get" action="{{ url('/nurses/add_patients_action')}}">
        <table class="table table-condensed">
            <tr>
                <td class="patients">
                    Imię pacjenta
                </td>
                <td class="patients">
                    <input type="text" name="name" class="form-control" value={{Input::old('name')}}>
                </td>
            </tr>
            <tr>
                <td class="patients">
                    Nazwisko pacjenta
                </td> 
               <td class="patients">
                    <input type="text" name="lastname" class="form-control" value={{Input::old('lastname')}}>
                </td>
            </tr>
            <tr>
                <td class="patients">
                    PESEL
                </td> 
               <td class="patients">
                    <input type="text" name="pesel" class="form-control" value={{Input::old('pesel')}}>
                </td>
            </tr>
            <tr>
                <td class="patients">
                    Adres
                </td> 
               <td class="patients">
                    <input type="text" name="adress" class="form-control" value={{Input::old('adress')}}>
                </td>
            </tr>
            <tr>
                <td class="patients">
                    Płeć
                </td> 
               <td class="patients">
                   <select name="sex" class="form-control">
                       <option value="1">Męższczyzna</option>
                       <option value="0">Kobieta</option>
                   </select>
                    
                </td>
            </tr>
            <tr>
                <td class="patients">
                    Numer telefonu
                </td> 
               <td class="patients">
                    <input type="text" name="nr" class="form-control" value={{Input::old('nr')}}>
                </td>
            </tr>
            <tr>
                <td class="patients">
                    Choroby podać po przecinku
                </td> 
               <td class="patients">
                   <textarea name="diseases" class="form-control" >{{Input::old('diseases')}}</textarea>
                    
                </td>
            </tr>
            <tr>
                <td class="patients">
                    Data urodzenia
                </td> 
               <td class="patients">
                    <input type="date" name="date" class="form-control" value={{Input::old('diseases')}}>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="patients">
                    <input type="submit" value="dodaj" class="btn btn-primary" >
                </td>
            </tr>

            
        </table>
        </form>
        @if (session('errors'))
            @foreach (session('errors') as $errors)
                <span class='error'>{{$errors}}</span><br>
            @endforeach
            
        @endif
        @if (session('succes'))
                <span class='succes'>{{session('succes')}}</span><br>
            
        @endif
        
    </div>
    
</div>
<br>

