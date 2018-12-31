
<table class="table no-margin">
  <thead>
  <tr>
    <th>Nombre</th>
    <th>Descripcion</th>
    <th>Inicio</th>
    <th>Fin</th>
  </tr>
  </thead>
  <tbody>
@if(!empty($proyectos))
  @foreach($proyectos as $proyecto)
  <tr>
    <td><a href="#" onclick="infoProyecto({{ $proyecto->id }})">{{ $proyecto->nombre }}</a></td>
    <td>{{ $proyecto->descripcion }}</td>
    <td>{{  date("d-m-y",strtotime($proyecto->inicio)) }}</td>
    <td>{{  date("d-m-y",strtotime($proyecto->fin)) }}</td>
  </tr>
  @endforeach
  </tbody>
</table>
<div align="center" id="pg-proyecto">
    {{ $proyectos->links() }}
</div>
@else
    </tbody>
  </table>
  <div align="center">
      <h5>No hay resultados</h5>
  </div>
@endif
