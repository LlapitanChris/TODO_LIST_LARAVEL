@extends('layouts.app')
@section('content')

<div class="container">
	<h1>My Orders:</h1>


	<hr>

	<table>
		{{-- <span class="pull-right">{{ $order->total }}</span> --}}
		<thead>
			<th>Name</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>Subtotal</th>
			<th>Date/Time</th>
			<th>Total</th>
		</thead>
		@foreach($orders as $order)
		<tbody>
			@foreach($order->items as $item)
			<tr>
				<td>{{ $item->name }}</td>				
				<td>{{ $item->pivot->quantity}}</td>				
				<td>{{ $item->price}}</td>
				<td>{{ $item->price*$item->pivot->quantity }}</td>
				<td>{{ $order->created_at->diffForHumans() }}</td>
				<td>{{ $order->total }}</td>
				
			</tr>
			@endforeach
		</tbody>
		@endforeach
	</table>

</div>

@endsection

