<div class="alert alert-danger print-error-msg" style="display:none">
  <ul></ul>
</div>
<div class="row">
    <form  class="form box-body" id="formNuevoProyecto"> 
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Proyecto</label>
                    <input type="text" placeholder="Proyecto" name="Proyecto" value="" autofocus="autofocus" class="form-control" autocomplete="off">
                </div>
            </div>
        </div>                     
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Inicio</label>
                    <input type="text" id="fechaInicio" name="Inicio" value="" class="form-control datepicker" autocomplete="off">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Fin</label>
                    <input type="text" id="fechaFin" name="Fin" value="" class="form-control datepicker" autocomplete="off">
                </div>
            </div>
        </div>                 
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Descripción</label>
                    <textarea placeholder="Descripción" name="Descripcion" value="" class="form-control" style="height:55px"></textarea> 
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