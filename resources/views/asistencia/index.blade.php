@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Empleados
@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-12">    
            <div class="box box-primary">
                <div class="box-header with-border">
                  <i class="fa fa-briefcase"></i><h3 class="box-title">Asistencia</h3>             
                </div>
                <div class="box-body">
                    <div class="row">
                      <div class="col-md-3">
                          <label for="fdesde">Desde</label>
                        <div class='input-group'>
                            <input type='text' class="form-control datepicker" id="fechaDesde" name="fdesde"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                      </div>
                      <div class="col-md-3">
                            <label for="fhasta">Hasta</label>
                        <div class='input-group '>
                            <input type='text' class="form-control datepicker" id="fechaHasta" name="fhasta"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                      </div>
                      <div class="col-md-3">
                            <label for="cardid">Usuario</label>
                            <select id="cardid" name="cardid" class="form-control">
                                <option value="todos">Todos</option>
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
                    </div>
                    <div class="row">
                        <div id="asistencias" class="col-md-12 table-responsive">                            
                        </div>
                    </div>
                  <!-- /.row -->
                </div>
                <!-- ./box-body -->
            </div> 
        </div>
    </div>

    <script>       
    </script>
@endsection
