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
          <th>ID</th>
          <th>Username</th>
          <th>Attribute</th>
          <th>OP</th>
          <th>Value</th>
        </tr>
        @foreach($registers as $register)
        <tr>

          <th>{{ $register->id}}</th>
          <th>{{ $register->username}}</th>
          <th>{{ $register->attribute}}</th>
          <th>{{ $register->op}}</th>
          <th>{{$register->value}}</th>
        </tr>
        @endforeach
      </table>
      @endif
      @else
    Bienvenidos!
    @endif
  </body>
</html>
