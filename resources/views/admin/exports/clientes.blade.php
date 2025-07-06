<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombres del cliente </th>
            <th>Email</th>
            <th>DNI</th>
            <th>Telefono</th>
            <th>Cargo</th>
            <th>Estado</th>
            <th>Fecha de registro</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clientes as $cliente)
        <tr>
            <td>{{$cliente -> id}} </td>
            <td>{{$cliente -> nombres}} {{$cliente -> apellidos}}</td>
            <td>{{$cliente -> email}}</td>
            <td>{{$cliente -> dni ?? '-' }}</td>
            <td>{{$cliente -> telefono ?? '-' }}</td>
            <td>{{$cliente -> cargo ?? '-' }}</td>
            <td>
                @if ($cliente -> estado == 1)
                Visitante
                @elseif ($cliente -> estado ==2)
                Interesado
                @elseif ($cliente -> estado == 3)
                No Interesado
                @else
                Contacto 
                @endif
            </td>
            <td>{{\Carbon\Carbon::parse($cliente -> created_at)->format('d/m/Y')}}</td>
        </tr>
        @endforeach
    </tbody>
</table>