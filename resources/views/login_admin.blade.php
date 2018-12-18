@extends('layout.index_register')
@section('content')
<br><br>
<div id="register">
    <div id="title_register">
      REJESTRACJA ADMINA  
    </div>
    <div id="register_table">
        <form action="{{ url('/admin/login_action')}}" method="post">
        <br>
        <table width="500">
            <tr>
                <td>
                    <span class="login">Twój login</span>
                </td>
                <td>
                    <input type="text" name="login" class="form-control">
                </td>
            </tr>
            <tr>
                <td>
                    <span class="login">Twoje hasło</span>
                </td>
                <td>
                    <input type="password" name="password" class="form-control">
                </td>
            </tr>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <tr>
                <td colspan="2">
                    <div align="center"><input type="submit" class="btn btn-primary" value="Zaloguj"></div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                            <div align="center">
                                <span class=error>
                        
                                    
                                  @if (session('error'))
                                     
                                  
                                        {{session('error')}}<br>
                                        
                                    
                                  @endif
                                    
                                </span>
                            </div>
                </td>
            </tr>
            
        </table>
        </form>
    </div>
    
</div>
@endsection




