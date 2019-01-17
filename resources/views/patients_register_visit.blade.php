@extends('layout.index_doctor')
@section('content')
<div id='body_patients'>

        <table class='table'>
            <tr>
                <td class='patients'>
                    <a class="link" > IMIĘ</a>
                </td>
                <TD class='patients'>
                    <a class="link" > NAZWISKO</a>
                </TD>
                <TD class='patients'>
                    <a class="link"> PESEL</a>
                </TD>
                <TD class='patients'>
                    <a class="link"> GODZINA</a>
                </TD>
                <TD class='patients'>
                    <a class="link"> CZY WIZYTA BYŁA</a>
                </TD>
                
            </tr>
        @for($i=0;$i < count($list_patients);$i++)
        
            <tr  class="href" onclick="document.location='{{url('/doctor/patients_list')}}/{{$list_patients[$i]['id']}}/{{$list_patients[$i]['id_visit']}}'">
                <td class='patients_list'>
                    {{$list_patients[$i]['name']}}
                </td>
                <TD class='patients_list'>
                    {{$list_patients[$i]['lastname']}}
                </TD>
                <TD class='patients_list'>
                    {{$list_patients[$i]['pesel']}}
                </TD>
                <TD class='patients_list'>
                    {{$list_patients[$i]['date']}}
                </TD>
                <TD class='patients_list'>
                    @if ($list_patients[$i]['visit'] == 0)
                    <span class="error">Wizyta jeszcze się nie odbyła</span>
                    @else
                    <span class="succes">Wizyta się  odbyła</span>
                    @endif
                </TD>
            </tr>
            
            
        @endfor
        </table>

    </div>
   
    

    
@endsection
