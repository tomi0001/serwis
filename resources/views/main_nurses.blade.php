@extends('layout.index_nurse')
@section('content')
<div id='main'>
    
    @for($i=0;$i < count($array_doctor['id']);$i++)
    
        <div class='visit_doctor'>
             {{$array_doctor['hour'][$i]}}
            @for ($j=0;$j < count($array_doctor['id'][$i]);$j++)
            
            {{$array_doctor['name'][$i][$j]}}
            @endfor
        </div>
        <br>
    @endfor
    
    
</div>
    
@endsection
