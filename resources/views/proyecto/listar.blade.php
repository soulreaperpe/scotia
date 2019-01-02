
<table class="table no-margin">
  <thead>
  <tr>
    <th>Nombre</th>
    <th>Descripcion</th>
    <th>Inicio</th>
    <th>Fin</th>
    <th></th>
  </tr>
  </thead>
  <tbody>
@if(!empty($proyectos))
  @foreach($proyectos as $proyecto)
  <tr>
    <td><a href="#" onclick="infoProyecto({{ $proyecto->id }})">{{ $proyecto->nombre }}</a></td>
    <td>{{ $proyecto->descripcion }}</td>
    <td>{{  date("d-m-Y",strtotime($proyecto->inicio)) }}</td>
    <td>{{  date("d-m-Y",strtotime($proyecto->fin)) }}</td>
    <td>
      <a href="#" onclick="editarProyecto({{ $proyecto->id }})">
         <i class="fa fa-fw fa-pencil"></i>
      </a>
    </td>
  </tr>
  @endforeach
  </tbody>
</table>
<div align="center" id="pg-proyectos">
    {{ $proyectos->links() }}
</div>
@else
    </tbody>
  </table>
  <div align="center">
      <h5>No hay resultados</h5>
  </div>
@endif
