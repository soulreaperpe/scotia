<section class="content">
    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Asistencia</h3>              
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
            {!! Form::open(['class'=>'form-vertical', 'class'=>'box-body', 'id'=>'formRptAsist' ])!!}
              <div class="col-md-3">
                  <label for="fdesde">Desde</label>
                <div class='input-group date'>
                    <input type='text' class="form-control dp" id="fdesde" name="fdesde"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
              </div>
              <div class="col-md-3">
                    <label for="fhasta">Hasta</label>
                <div class='input-group date'>
                    <input type='text' class="form-control dp" id="fhasta" name="fhasta"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
              </div>
              <div class="col-md-3">
                    <label for="cardid">Usuario</label>
                    <select id="cardid" name="cardid" class="form-control">
                        <option value="todos">Todos</option>
                        @foreach($usersinfo as $userinfo) 
                        <option value="{{ $userinfo->cardid }}"> {{ $userinfo->nombre }} </option> 
                        @endforeach
                    </select>
              </div>
              <div class="col-md-3">
                    <div class="form-group">
                        <br>
                        <button class="btn btn-primary" type="submit">
                            Reporte
                        </button>
                    </div>
              </div>
            {!! Form::close()!!}
            </div>
            <div class="row">
                <div id="asistencias" class="col-md-12 table-responsive"></div>
            </div>
          <!-- /.row -->
        </div>
        <!-- ./box-body -->
        <div class="box-footer">
          
        </div>
      <!-- /.box-footer -->
    </div> 
</section>

<script> 
    
    $('.dp').datepicker({
        format: "dd-mm-yyyy",
        todayBtn: "linked",
        language: "es",
        orientation: "auto right",
        weekStart: 1,
        daysOfWeekDisabled: "0",
        daysOfWeekHighlighted: "0",
        todayHighlight: true,
        autoclose: true     
    }).datepicker("setDate", "0"); 



    $( "form" ).on( "submit", function( event ) {
        event.preventDefault();
        var fdesde = $("#fdesde").val(); 
        var fhasta = $("#fhasta").val(); 
        var cardid = $("#cardid").val(); 
        data = $( "#formRptAsist" ).serialize();        
        $.ajax({
            type: 'get',
            url: '/asistencia/reporte/'+fdesde+'/'+fhasta+'/'+cardid,
            success: function(data) {
                $('#asistencias').empty().html(data);                
            }
        });   
        console.log('Asistencias');
    });

    $(document).on("click", "#pg-asist .pagination li a",function(e) {
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            type:'get',
            url: url,
            success: function(data){
                $('#asistencias').empty().html(data);
            }
        });
    });
</script>