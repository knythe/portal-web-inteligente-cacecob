<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Categoria</th>
            <th>Titulo</th>
            <th>Descripcion</th>
            <th>Price</th>
            <th>Oferta</th>
            <th>Modalidad</th>
            <th>Tipo de certificado</th>
            <th>Horas academicas </th>
            <th>Fecha de inicio</th>
            <th>Fecha de fin</th>
            <th>Estado</th>
            <th>Fecha de creacion</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($servicios as $servicio)
        <tr>
            <td>{{$servicio->id}}</td>
            <td>{{$servicio->categoria->nombre}}</td>
            <td>{{$servicio->titulo}}</td>
            <td>{{$servicio->descripcion}}</td>
            <td>S/. {{$servicio->precio}}.00</td>
            <td>S/. {{$servicio->oferta ?? 'sin oferta'}}.00</td>
            <td>
                @if ($servicio->modalidad == 1)
                Virtual
                @elseif ($servicio->modalidad == 2)
                Presencial
                @else
                Semipresencial
                @endif
            </td>
            <td>
                @if ($servicio->tipo_certificado == 1)
                Diploma
                @elseif ($servicio->tipo_certificado == 2)
                Certificado
                @elseif ($servicio->tipo_certificado == 3)
                Reconocimiento
                @else
                Titulo
                @endif
            </td>
            <td>{{$servicio->horas_academicas}} H.A.</td>
            <td>{{\Carbon\Carbon::parse($servicio->fecha_inicio)->format('d/m/Y')}}</td>
            <td>{{\Carbon\Carbon::parse($servicio->fecha_fin)->format('d/m/Y')}}</td>
            <td>
                @if($servicio->estado == 1)
                Activo
                @else 
                Inactivo
                @endif
            </td>
            <td>{{\Carbon\Carbon::parse($servicio->created_at)->format('d/m/Y')}}</td>
        </tr>
        @endforeach
    </tbody>
</table>