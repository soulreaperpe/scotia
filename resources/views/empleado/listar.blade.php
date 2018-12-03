
<table class="table no-margin">
  <thead>
  <tr>
    <th>Activo</th>
    <th>Codigo</th>
    <th>Nombre</th>
    <th>Proyecto</th>    
    <th>Registrado</th>
  </tr>
  </thead>
  <tbody>
@if(count($empleados)>0)
  @foreach($empleados as $empleado)
  <tr>
    <td>{{  $empleado->activo }}</td>
    <td>{{  $empleado->codigo }}</td>
    <td><a href="#" onclick="infoEmpleado({{ $empleado->id }})">{{ $empleado->apellidos }}, {{ $empleado->nombres }}</a></td>
    <td><a href="#" onclick="infoProyecto({{ $empleado->idProyecto }})">{{ $empleado->proyecto }}</a></td>
    <td>{{  date("d-m-y",strtotime($empleado->created_at)) }}</td>
  </tr>
  @endforeach
  </tbody>
</table>
@else
    </tbody>
  </table>
  <div align="center">
      <h5>No hay resultados</h5>
  </div>
@endif
<div align="center" id="pg-empleado">
    {{ $empleados->links() }}
</div>