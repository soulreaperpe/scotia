<div class="alert alert-danger print-error-msg" style="display:none">
  <ul></ul>
</div>
<div class="row">
    <form  class="form box-body" id="formNuevoEmpleado"> 
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Código</label>
                    <input type="text" placeholder="Codigo" name="Codigo" value="" class="form-control" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nombres</label>
                    <input type="text" placeholder="Nombres" name="Nombres" value="" autofocus="autofocus" class="form-control" autocomplete="off">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Apellidos</label>
                    <input type="text" placeholder="Apellidos" name="Apellidos" value="" class="form-control" autocomplete="off">
                </div>
            </div>
        </div>  
        <div class="row">
            <div class="col-md-6">
                <div class="form-group proyectos">
                    <label>Proyecto</label>
                    <select class="form-control" name="Proyecto">                            
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