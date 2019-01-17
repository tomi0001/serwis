

	<table  align=center class='kalendar'>
	  <tr>
	    <td colspan=7><div align=center><span class="kalendar">{{$text_month}} {{$year}}</span></div></td>
	  </tr>
	  <tr>
	    <td width='14%'><div align=center><span class="kalendar">Pon</span></div></td>
	    <td width='14%'><div align=center><span class="kalendar">Wto</span></div></td>
	    <td width='14%'><div align=center><span class="kalendar">śro</span></div></td>
	    <td width='14%'><div align=center><span class="kalendar">Czwa</span></div></td>
	    <td width='14%'><div align=center><span class="kalendar">Pią</span></div></td>
	    <td width='14%'><div align=center><span class="kalendar">Sob</span></div></td>
	    <td width='14%'><div align=center><span class="kalendar">Nie</span></div></td>
	  </tr>
	  <tbody>


  @while ( $day2 <= $how_day_month) 

    <tr height=70>
    
    @for ($cols=0;$cols < 7;$cols++) 
    <td width="14%">
      @if ($day2 <= $how_day_month ) 

	
	
        @if ($day1 >= $day_week )

            @if ( $day2 == $day3 ) 
                <div align=center  class="cell_active"><span class="active">{{$day2}}</span></div>


            @else
     
                <div align=center  class="cell"><a class="no_active" href={{   url('/nurses/main')}}/{{$year}}/{{$month}}/{{$day2}}  }}>{{$day2}}</a></div>
                
            @endif
            </td>
            @php
                $day2++;
            @endphp
            
       
        
        
       
        @endif
	@php 
        $day1++;
	@endphp
	
      @endif
        
    @endfor
    </tr>

  @endwhile
  <tr>

</table>
<div class="row">
  <div class="col-md-2 col-xs-2"></div>
  <div class="col-md-2 col-xs-2"><a class="button" href={{ url('/nurses/main')}}/{{$back[0]}}/{{$back[1]}}/1/wstecz>Miesiąc Wstecz</a></div>
  <div class="col-md-2 col-xs-2"><a class="button" href={{ url('/nurses/main')}}/{{$back_year[0]}}/{{$back_year[1]}}/1/wstecz>Rok Wstecz</a></div>
  <div class="col-md-2 col-xs-2"><a class="button" href={{ url('/nurses/main')}}/{{$next_year[0]}}/{{$next_year[1]}}/1/wstecz>Rok Dalej</a></div>
  <div class="col-md-2 col-xs-2">
      <a class="button" href={{ url('/nurses/main')}}/{{$next[0]}}/{{$next[1]}}/1/dalej>miesiąc dalej</a>
      
  </div>
  
</div>


    
