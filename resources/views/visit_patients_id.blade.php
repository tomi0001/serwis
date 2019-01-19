@extends('layout.index_doctor')
@section('content')
<div id='body_patients'>
    <div class="center">
        @foreach ($name as $name_p)
            {{$name_p->name}}
            {{$name_p->lastname}}
        @endforeach
    </div>
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
        
            <tr  class="href" onclick="document.location='{{url('/doctor/visit_patients_old')}}/{{$list_visit->visits_id}}'">
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
       @if ($if_visit == true)
        <div class="center">
            <a class="title_admin" href="{{url('/doctor/new_visit')}}/{{$id_visit}}">Zacznij nową wizytę</a>
        </div>
       @endif
    </div>
   
    

    
@endsection
