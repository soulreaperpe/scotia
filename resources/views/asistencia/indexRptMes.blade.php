<section class="content">
    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Asistencia</h3>              
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
            {!! Form::open(['class'=>'form-vertical', 'class'=>'box-body'])!!}
              <div class="col-md-3">
                  <label for="fdesde">Mes</label>
                <div class='input-group date'>
                    <input type='text' class="form-control dp" id="mes" name="mes"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
              </div>
              <div class="col-md-3">
                    <label for="cardid">Usuario</label>
                    <select id="cardid" name="cardid" class="form-control">
                        <option value=""></option>
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
            <div class="col-md-2 pull-right">
                <button type="button" class="btn btn-success btn-flat export-excel" style="display: none;"><i class="fa fa-file-excel-o"></i> Exportar</button>
            </div>          
        </div>
      <!-- /.box-footer -->
    </div> 
</section>

<script> 
    
    $('.dp').datepicker({
        minViewMode: 1,
        format: "mm-yyyy",
        todayBtn: "linked",
        language: "es",
        orientation: "auto right",
        daysOfWeekDisabled: "0",
        daysOfWeekHighlighted: "0",
        todayHighlight: true,
        autoclose: true     
    }).datepicker("setDate", "0"); 



    $( "form" ).on( "submit", function( event ) {
        event.preventDefault();
        var mes = $("#mes").val(); 
        var cardid = $("#cardid").val();         
        $.ajax({
            type: 'get',
            url: '/asistencia/mes/'+mes+'/'+cardid,
            success: function(data) {
                $('#asistencias').empty().html(data); 
                $('button.export-excel').show();               
            }
        });   
        console.log('Asistencias');
    });

     $('.modal-body').on('click', '.actualizar', function(e){
        e.preventDefault();
        var id = $( "#id_evento" ).val();        
        data = $( "#formEditarEvento" ).serialize();
        $.post( "/asistencia/"+id+"/actualizar", data ); 
        $(".panel-collapse").collapse('hide'); 
        $("#myModalMd").modal("hide");
    });

     $("button.export-excel").click(function(){
        var mes= $("#mes").val();
        var cardid=$('#cardid').val();
        window.location.href = '/asistencia/mes/'+mes+'/'+cardid+'/export2excel';    
    });
</script>