@extends('layout.index')
@section('content')
<br>
<div id='down'>
    <div class='page'>
        <br>
        {{Form::open(array('url' => 'login_action','method' => 'post'))}}
        <table border="0" width="500" align="center">
                <tr>
                    <td><span class="white">Twój login</span></td>
                    <td><input class="form-control" type="text" name="login" value={{Request::old('login')}}></td>
                </tr>
                <tr>
                    <td><span class="white">Twoje hasło</span></td>
                    <td><input class="form-control" type="password" name="password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div align="center"><button class="btn btn-primary">Zaloguj</button></div>
                    </td>
                </tr>
            
        </table>
        
        
        </form>
    </div>
    <div>
        <div align="center">
            
            <span class="blad">{{Session::get('login_error')}}</span>
 
        </div>
        
        
        
    </div>
    
</div>
@endsection