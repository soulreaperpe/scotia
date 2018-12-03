<div class="alert alert-danger print-error-msg" style="display:none">
  <ul></ul>
</div>
<div class="row">
    {!! Form::open(['class'=>'form-horizontal', 'class'=>'box-body', 'id'=>'formLead' ])!!}    
    <input id="leadID" name="leadID" value="{{ $lead->id }}" hidden="" type="number" />
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                {!!Form::label('Nombre','Nombre')!!}
                {!!Form::text('Nombre',(!empty($lead->id) ? $lead->Nombre:Null),['class'=>'form-control','placeholder'=>'Nombre', 'autocomplete'=>'off','required']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                {!!Form::label('Empresa','Empresa')!!}
                {!!Form::text('Empresa',(!empty($lead->id) ? $lead->Empresa:Null),['class'=>'form-control','placeholder'=>'Empresa', 'autocomplete'=>'off','required']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                {!!Form::label('Correo','Correo')!!}
                {!!Form::text('Correo',(!empty($lead->id) ? $lead->Correo:Null),['class'=>'form-control','placeholder'=>'Correo', 'autocomplete'=>'off','required']) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!!Form::label('Asignado','Asignado')!!}
                <select id="asignado" name="UsuarioID" class="form-control" @if(Auth::User()->idRol>2) disabled @endif>
                    <option value="0"></option>
                    @foreach($usuarios as $usuario) 
                        <option value="{{ $usuario->id }}" @if(count($lead)>0) @if($lead->UsuarioID == $usuario->id) selected="selected" @endif @endif> 
                            {{ $usuario->name }} 
                        </option> 
                    @endforeach
                </select> 
            </div>
        </div>

    </div>                      
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!!Form::label('Comentario','Comentario')!!}
                {!!Form::textarea('Comentario',(!empty($lead->id) ? $lead->Comentario:Null), ['class'=>'form-control','placeholder'=>'Comentario','style'=>'height:55px', 'required']) !!}
            </div>
        </div>
    </div>                    
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!!Form::label('Requerimientos','Requerimientos')!!}
				{!!Form::textarea('Requerimientos',(!empty($lead->id) ? $lead->Requerimientos:Null), ['class'=>'form-control','placeholder'=>'Comentario','style'=>'height:55px', 'required']) !!}
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
    {!! Form::close()!!}
</div>