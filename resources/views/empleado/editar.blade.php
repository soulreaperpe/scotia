<div class="alert alert-danger print-error-msg" style="display:none">
  <ul></ul>
</div>
<div class="row">
    <form  class="form box-body" id="formNuevoEmpleado"> 
        @csrf
        <input id="idEmpleado" name="idEmpleado" value="{{ $empleado->id }}" hidden="" type="number" />
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Código</label>
                    <input type="text" placeholder="Codigo" name="Codigo" value="{{ $empleado->codigo }}" class="form-control" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nombres</label>
                    <input type="text" placeholder="Nombres" name="Nombres" value="{{ $empleado->nombres }}" autofocus="autofocus" class="form-control" autocomplete="off">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Apellidos</label>
                    <input type="text" placeholder="Apellidos" name="Apellidos" value="{{ $empleado->apellidos }}" class="form-control" autocomplete="off">
                </div>
            </div>
        </div>  
        <div class="row">
            <div class="col-md-6">
                <div class="form-group proyectos">
                    <label>Proyecto</label>
                    <select class="form-control" name="Proyecto">     
                        <option value="0"></option>
                    @foreach($proyectos as $proyecto) 
                        <option value="{{ $proyecto->id }}" @if(!empty($empleadosproyecto)>0) @if($empleadosproyecto->idProyecto == $proyecto->id) selected="selected" @endif @endif> 
                            {{ $proyecto->nombre }} 
                        </option> 
                    @endforeach                       
                    </select>
                </div>
            </div>
        </div>        
        <div class="row">
            <div class="col-md-12">
                <div class="form-group pull-right">
                    <button class="btn btn-primary actionBtn" id="footer_action_button" type="submit">
                        Grabar
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>