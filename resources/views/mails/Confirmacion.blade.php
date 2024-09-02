<h1 style="text-align:center">AVISO DIA DE PAGO</h1>
<h2 style="text-align:center">Las siguientes personas tienen que cancelar mensualidad el dia de hoy</h2>
@foreach ($Nombre as $cliente)
<ul>
<li>{{$cliente['Nombre']}}</li>
</ul>
@endforeach
<br>
<br>
<br>
<h4 style="text-align:center">No responder a este mensaje</h4>