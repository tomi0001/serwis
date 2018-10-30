@extends('layout.index')
@section('content')
<br>
<div id='down'>
    <div class='page'>
        <br>
        {{Form::open(array('url' => 'register_action','method' => 'post','files' => 'true'))}}
            {{csrf_field()}}
            <table border="0" align="center" width="500">
                <tr>
                    <td><span class="white">Twój login</span></td>
                    <td><input class="form-control" type="text" name="login" value={{Request::old('login')}}></td>
                </tr>
                <tr>
                    <td><span class="white">Twoje hasło</span></td>
                    <td><input class="form-control" type="password" name="password"></td>
                </tr>
                <tr>
                    <td><span class="white">Wpisz jeszcze raz  swoje hasło</span></td>
                    <td><input class="form-control" type="password" name="password2"></td>
                </tr>
                <tr>
                    <td><span class="white">Twój email</span></td>
                    <td><input class="form-control" type="text" name="email" value={{Request::old('email')}}></td>
                </tr>
                <tr>
                    <td><span class="white">Twoje imię</span></td>
                    <td><input class="form-control" type="text" name="name" value={{Request::old('name')}}></td>
                </tr>
                <tr>
                    <td><span class="white">Twoje nazwisko</span></td>
                    <td><input class="form-control" type="text" name="lastname" value={{Request::old('lastname')}}></td>
                </tr>
                <tr>
                    <td><span class="white">Data urodzenia</span></td>
                    <td><input class="form-control" type="date" name="born" value={{Request::old('born')}}></td>
                </tr>
                <tr>
                    <td><span class="white">Miasto</span></td>
                    <td><input class="form-control" type="text" name="city" value={{Request::old('city')}}></td>
                </tr>
                <tr>
                    <td><span class="white">Województwo</span></td>
                    <td><input class="form-control" type="text" name="voivodeship" value={{Request::old('voivodeship')}}></td>
                </tr>
                <tr>
                    <td><span class="white">Wykształcenie</span></td>
                    <td>
                        <select name="education" class="form-control" value={{Request::old('education')}}>
                            <option value="0">Bez wykształcenia</option>
                            <option value="1">Niepełne Podstawowe</option>
                            <option value="2">Podstawowe</option>
                            <option value="3">Zawodowe</option>
                            <option value="4">Niepełne średnie</option>
                            <option value="5">Policelane</option>
                            <option value="6">Średnie</option>
                            <option value="7">Niepełne wyższe</option>
                            <option value="8">Wyższe (Licencjat,inzynier,magister)</option>
                            <option value="9">Wyższe(Doktor,Profesor)</option>
                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><span class="white">Nr telefonu</span></td>
                    <td><input class="form-control" type="text" name="telefon" value={{Request::old('telefon')}}></td>
                </tr>
                <tr>
                    <td><span class="white">Hobby</span></td>
                    <td><textarea name="hobby" class="form-control" >{{Request::old('hobby')}}</textarea></td>
                </tr>
                <tr>
                    <td><span class="white">Zainteresowania</span></td>
                    <td><textarea name="interested" class="form-control" >{{Request::old('interested')}}</textarea></td>
                </tr>
                <tr>
                    <td><span class="white">Uzależnienia</span></td>
                    <td><textarea name="addition" class="form-control" >{{Request::old('addition')}}</textarea></td>
                </tr>
                <tr>
                    <td><span class="white">Płeć</span></td>
                    <td>
                        <select name="sex" class="form-control" value={{Request::old('sex')}}>
                            <option value="1">Mężczyzna</option>
                            <option value="0">Kobieta</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><span class="white">Zdjęcie</span></td>
                    <td>
                        <input type="file" name="file" class="form-control">
                    </td>
                </tr>
                <tr>
                    
                
                    <td colspan="2">
                        <div align="center"><button class="btn btn-primary">Zarejestrój</button></div>
                    </td>
                </tr>
                
                
                
            </table>
        </form>
    </div>
    <div>
        <div align="center">
            <?php $messages = $errors->all(':message') ?>
                <?php foreach ($messages as $msg): ?>
                   <span class=blad><?= $msg ?> <br></span>
                <?php endforeach; ?>
                <span class=blad>{{Session::get('ile')}}</span>
        </div>
        
        
        
    </div>
    
</div>
@endsection