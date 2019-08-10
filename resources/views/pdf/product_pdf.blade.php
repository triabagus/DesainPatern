<!DOCTYPE html>
<html>
<head>
	<title>Data Product</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Data Product</h4>
	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Name Product</th>
				<th>Stock</th>
				<th>Price</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($product as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$p->name_product}}</td>
				<td>{{$p->stock}}</td>
				<td>{{ "Rp. ". number_format($p->price,2,',','.') }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>