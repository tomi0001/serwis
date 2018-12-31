<br><br>
<div id="register">
    <div id="title_register">
      REJESTRACJA ADMINA  
    </div>
    <div id="register_table">
        <form action="{{ url('/admin/register_action')}}" method="post">
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
            <tr>
                <td>
                    <span class="login">Wpisz jeszcze swoje hasło</span>
                </td>
                <td>
                    <input type="password" name="password_confirn" class="form-control">
                </td>
            </tr>
            <tr>
                <td>
                    <span class="login">Długość pojedyńczej wizity</span>
                </td>
                <td>
                    <input type="text" name="visit" class="form-control">
                </td>
            </tr>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <tr>
                <td colspan="2">
                    <div align="center"><input type="submit" class="btn btn-primary" value="Zarejestruj"></div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                            <div align="center">
                                <span class=error>
                        
                                    
                                  @if (session('error'))
                                     
                                    @foreach (session('error') as $error)
                                        {{$error}}<br>
                                        
                                    @endforeach
                                  @endif
                                    
                                </span>
                            </div>
                </td>
            </tr>
            
        </table>
        </form>
    </div>
    
</div>