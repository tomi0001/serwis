@extends('layout.index_doctor')
@section('content')
<div id='body_patients'>
    <div class="old_visit">
    @foreach ($name_patients as $name_p)
        {{$name_p->name}}
        {{$name_p->lastname}}
    @endforeach
    do
    @foreach ($name_doctor as $name_d)
        {{$name_d->name}}
        {{$name_d->lastname}}
    @endforeach
    
    </div>
    @for($i=0;$i < count($visit_text);$i++)
    
    <div class='old_visit'>
        <span class="bold">Treść wizyty</span>
            <br>
        {!!nl2br(e($visit_text["visit_text"]))!!}
        
    </div>
    
    @endfor
    
        
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
                @foreach ($drugs as $drugs2)
                <tr class="drugs" id="drug_">
                    <td class='old_visit'>
                        {{$drugs2->name}}
                    </td>
                    <td class='old_visit'>
                        {{$drugs2->field1}}
                    </td>
                    <td class='old_visit'>
                        {{$drugs2->field2}}
                    </td>
                    <td class='old_visit'>
                        {{$drugs2->field3}}
                    </td>
                    <td class='old_visit'>
                        {{$drugs2->field4}}
                    </td>
                    <td class='old_visit'>
                        {{$drugs2->field5}}
                    </td>
                    <td class='old_visit'>
                        {{$drugs2->field6}}
                    </td>
                    
                </tr>
                  @endforeach
                </tbody>
                  

         
            </table>
            @for($i=0;$i < count($diseases);$i++)
    
    <div class='old_visit'>
        <span class="bold">Choroby pacjenta</span>
        <br>
        {{$diseases}}
        
    </div>
    
    @endfor
           
</div>

    
@endsection
