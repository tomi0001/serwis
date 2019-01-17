@extends('layout.index_doctor')
@section('content')
<div id='body_patients'>
    <div class="center">
        <span class="visit">Opis wizyty</span>
    </div>
    <form method="get">
        <textarea name="visit_text"  rows="16" class="form-control"></textarea>
        <div class="center">
            <span class="visit">Jakie leki</span>
        </div>
        
            <table class="table" >
             
                <tr class="drugs">
                    <td width="30%">
                        Nazwa leku
                    </td>
                    <td width="10%">
                        dawka leku
                    </td>
                    <td width="10%">
                        Porcja rano
                    </td>
                    <td width="10%">
                        Porcja południe
                    </td>
                    <td width="10%">
                        Porcja wieczór
                    </td>
                    <td width="10%">
                        Porcja noc
                    </td>
                    <td width="10%">
                        Ilość tabletek
                    </td>
                    
                </tr>
                <tbody id='drugss'>
                @php
                $i = 0;
                @endphp
                @foreach ($drugs as $drugs2)
                <tr class="drugs" id="drug_">
                    <td >
                        <input type="text" name="drugs1[]" value="{{$drugs2->name}}" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="drugs2[]" value="{{$drugs2->field1}}" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="drugs3[]" value="{{$drugs2->field2}}" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="drugs4[]" value="{{$drugs2->field3}}" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="drugs5[]" value="{{$drugs2->field4}}" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="drugs6[]" value="{{$drugs2->field5}}" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="drugs7[]" value="{{$drugs2->field6}}" class="form-control">
                    </td>
                    <td>
                        <button onclick='delete_drugs()'  class="btn btn-primary drugsss">Usuń wpis</button>
                    </td>
                </tr>
                    @php
                    $i++;
                    @endphp
                @endforeach
                </tbody>
                  
                <tr class="drugs" id="hide_tr">
                    <td width="30%">
                        <input type="text" name=drugs1[] class="form-control">
                    </td>
                <td width="10%">
                            <input type="text" name="drugs2[]" class="form-control">
                </td>
                <td width="10%"><input type="text" name="drugs3[]" class="form-control">
                </td>
                <td width="10%">
                    <input type="text" name="drugs4[]" class="form-control">
                </td><td width="10%">
                    <input type="text" name="drugs5[]" class="form-control">
                </td>
                <td width="10%">
                    <input type="text" name="drugs6[]" class="form-control">
                </td>
                <td width="10%">
                <input type="text" name="drugs7[]" class="form-control">
                <td>
                    <button onclick="delete_drugs()"  class="btn btn-primary">Usuń wpis</button>
                </td>
                </tr>
              
                <table class="table drug">
                    
                </table>
            </table>
        
            <button type="button" class="btn btn-primary" onclick="add_drugs()">Dodaj leki</button>
        
        <div class="center">
            <span class="visit">Choroby pacjenta</span>
        </div>
            
        <textarea class="form-control" name="diseases" rows="7">{{$diseases}}</textarea>
               <input type="hidden" name="patient_id" value="{{$patient_id}}">
               <input type="hidden" name="id_visit" value="{{$id_visit}}">
               <input type="hidden" name="doctor_id" value="{{$doctor_id}}">
        <div class="center">
            <input type="button" value="Zapisz" class="btn btn-primary" onclick="save_visit('{{url('/doctor/new_visit_submit')}}')">
        </div>
    </form>
    <div id='ajax'>
                
    </div>
</div>

    
@endsection
