<div class="row">
    {!! Form::open(['class'=>'form-horizontal', 'class'=>'box-body', 'id'=>'formEditarEvento' ])!!}  
    <div class="row">
        <input id="id_evento" name="cod_acti" value="{{ $evento->id }}" hidden="" type="number" />
        <div class="col-md-8">
            <div class="form-group">
                {!!Form::label('nombre','Nombre')!!}
				{!!Form::text('nombre',($evento->nombre.' '.$evento->apellido),['class'=>'form-control','placeholder'=>'Nombre', 'autocomplete'=>'off','disabled']) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group date dp">
                {!!Form::label('time','Hora')!!}
              	{!!Form::text('time', date("d-m-Y H:i:s",strtotime($evento->time)), ['class'=>'form-control', 'autocomplete'=>'off', 'disabled']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!!Form::label('description','Justificación')!!}
				{!!Form::textarea('description', ($evento->description), ['class'=>'form-control','placeholder'=>'Escriba su justificación','style'=>'height:55px', 'required']) !!}
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