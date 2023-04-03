<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    @if(request('search'))
      @if( $registers->isEmpty())
        No hay registros para el usuario {{request('search')}}

      @else
        <table>
          <tr>
            <th>PPPoE User</th>
            <th>Assigned IP Address</th>
            <th>NAS IP Address</th>
            <th>Start of Sesion</th>
            <th>Stop of Sesion</th>
            <th>Status</th>
          </tr>
          @foreach($registers as $register)
          <tr>

            <th>{{ $register->username}}</th>
            <th>{{ $register->framedipaddress}}</th>
            <th>{{ $register->nasipaddress}}</th>
            <th>{{ $register->acctstarttime}}</th>
            <th>{{$register->acctstoptime}}</th>
            <th>{{ is_null($register->acctstoptime) ? 'Active' : 'Disconnected by: ' . $register->acctterminatecause }}</th>
          </tr>
          @endforeach
        </table>
      @endif
    @else
      Bienvenidos!
    @endif
  </body>
</html>
