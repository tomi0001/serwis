@extends('layout.index_doctor')
@section('content')
<div id='body_patients'>

        <table class='table'>
            <tr>
                <td class='patients'>
                    <a class="link" > DATA</a>
                </td>

                <TD class='patients'>
                    <a class="link"> IMIĘ LEKARZA</a>
                </TD>
                <TD class='patients'>
                    <a class="link"> NAZWISKO LEKARZA</a>
                </TD>
                
            </tr>
        @foreach ($list as $list_visit)
        
            <tr>
                <td class='patients_list'>
                    {{$list_visit->date}}
                </td>
                <td class='patients_list'>
                    {{$list_visit->name}}
                </td>
                <td class='patients_list'>
                    {{$list_visit->lastname}}
                </td>
            </tr>
            
            
        @endforeach
        </table>
        <div class='center'>
            {{$list->links()}}
        </div>
        <div class="center">
            <a class="title_admin" href="{{url('/doctor/new_visit')}}/{{$id_visit}}">Zacznij nową wizytę</a>
        </div>
    </div>
   
    

    
@endsection
