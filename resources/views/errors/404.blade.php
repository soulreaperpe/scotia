@extends('adminlte::layouts.errors')

@section('htmlheader_title')
    Página no encontrada
@endsection

@section('main-content')

    <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>
        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! Página no encontrada.</h3>
            <p>
                No pudimos encontrar la página que estas buscando.
                Puedes regresar a la <a href='{{ url( '/') }}'>Marcación</a>.
            </p>
        </div><!-- /.error-content -->
    </div><!-- /.error-page -->
@endsection