
<table class="table no-margin">
  <thead>
  <tr>
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Registrado</th>
  </tr>
  </thead>
  <tbody>
@if(count($turnos)>0)
  @foreach($turnos as $turno)
  <tr>
    <td><a href="#" onclick="infoLead({{ $turno->id }})">{{ $turno->codigo }}</a></td>
    <td>{{ $turno->descripcion }}</td>
    <td>{{  date("d-m-Y",strtotime($turno->created_at)) }}</td>
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
<div align="center" id="pg-turnos">
    {{ $turnos->links() }}
</div>