@extends('layout.index_nurse')
@section('content')
<div id='main'>
    
    @for($i=0;$i < count($array_doctor['id']);$i++)
    
        <div class='visit_doctor'>
            <form method="get">
            <div class='hour'>
                <span class="hour">Godzina {{$array_doctor['hour'][$i]}}</span>
            </div>
            <div class="left_nurses">
             <div class='select_doctor'>
                Zarejestruj pacjenta    
                <br>
             
                <select id="patients_{{$i}}" class='form-control'>
                   @foreach($patients as $patients2) 
                   <option value='{{$patients2->id}}'>{{$patients2->name}} {{$patients2->lastname}}</option>
                   @endforeach
                </select>
             </div>
            </div>
            <div class="right_nurses">
                <div class='select_doctor'>
                    Zarejestruj do lekarza
                    <br>
                   
                        <select id="doctor_{{$i}}" class='form-control'>
                        @for ($j=0;$j < count($array_doctor['id'][$i]);$j++)
                            <option value="{{$array_doctor['id'][$i][$j]}}">{{$array_doctor['name'][$i][$j]}}</option>

                        @endfor
                        </select>
                   </div>
                
                
                
            </div>
                <div class='down_nurses'>
                    <input type='button' value='zarejestrój' class='btn btn-primary' onclick="register_patients({{$i}},'{{$date}}{{$array_doctor['hour'][$i]}}','{{url('/ajax_nurser/register_to_doctor')}}')"><br>
                    <div id='register_to_doctor_{{$i}}'>
                    </div>
                </div>
            </form>
        </div>
        <br>
    @endfor
    
    
</div>
    
@endsection
