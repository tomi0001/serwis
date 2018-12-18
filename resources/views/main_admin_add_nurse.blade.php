@extends('layout.index_admin')
@section('content')
<form action="{{ url('/admin/add_nurse_form')}}/nurse" method="post">
<table class="table">
    <tr>
        <td>
            <span class="data_doctor">Imię</span>
        </td>
        <td>
            <input type="text" name="name" class="form-control">
        </td>
        
    </tr>
    <tr>
        <td>
            <span class="data_doctor">Nazwisko</span>
        </td>
        <td>
            <input type="text" name="lastname" class="form-control">
        </td>
    
    </tr>
    <tr>
        <td>
            <span class="data_doctor">płeć</span>
        </td>
        <td>
            <select name="sex" class="form-control">
                <option value="0">Kobieta</option>
                <option value="1" selected>Mężczyzna</option>
            </select>
        </td>
    
    </tr>
    <tr>
        <td>
            <span class="data_doctor">Login</span>
        </td>
        <td>
            <input type="text" name="login" class="form-control">
        </td>
    
    </tr>
    <tr>
        <td>
            <span class="data_doctor">Hasło</span>
        </td>
        <td>
            <input type="password" name="password" class="form-control">
        </td>
    {{ csrf_field() }}
    </tr>
    <tr>
        
        <td colspan="2">
            <div align="center">
                <input type="submit" value="Dodaj" class="btn btn-primary">
            </div>
        </td>
    
    </tr>
    <tr>
        <td colspan="2">
            <div align="center">
                @if (session('errors'))
                    @foreach (  session('errors') as $errors)
                    <span class="error">{{$errors}}</span><br>

                    @endforeach

                @endif
                @if (session('errors_login') != "")
                <span class="error">{{session('errors_login')}}</span><br>
                @endif
            </div>
        </td>
        
    </tr>
</table>
</form>
@endsection