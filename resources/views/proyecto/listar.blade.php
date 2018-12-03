
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
@if(count($proyectos)>0)
  @foreach($proyectos as $proyecto)
  <tr>
    <td><a href="#" onclick="infoLead({{ $proyecto->id }})">{{ $proyecto->nombre }}</a></td>
    <td>{{ $proyecto->descripcion }}</td>
    <td>{{  date("d-m-y",strtotime($proyecto->inicio)) }}</td>
    <td>{{  date("d-m-y",strtotime($proyecto->fin)) }}</td>
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
<div align="center" id="pg-proyecto">
    {{ $proyectos->links() }}
</div>