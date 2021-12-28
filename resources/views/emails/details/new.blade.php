<html>
<body>
<h1>Hola! Tu orden ha sido procesada con exito</h1>
<h3>{{$buyDetail->details}}</h3>
<h2>Costo total</h2>
<p>{{$buyDetail->total}}</p>
<img src="{{$message->embed()}}">
</body>
</html>
