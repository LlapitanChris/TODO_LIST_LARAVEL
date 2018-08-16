<!DOCTYPE html>
<html>
<head>
	<title>Show items</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
</head>
<body>

	<div class="container">

		<a href="/menu">Go back to menu</a>

		@if(Session::has('delete_message'))
		<div class="alert alert-danger">
			{{ Session::get('delete_message') }}


		</div>
		@endif

		<h1>My Cart</h1>

		

		<div class="row">
			<div class="col-md-6">

				@if($cart_items != null)

				<table>
					<thead style="border: 1px solid black">
						<tr style="border: 1px solid black">
							
							<th style="border: 1px solid black">
								Name:
							</th>
							<th style="border: 1px solid black">
								Price:
							</th>
							<th style="border: 1px solid black">
								Quantity:
							</th>
							<th style="border: 1px solid black">
								Update/Remove
							</th>
							<th style="border: 1px solid black">					
								Subtotal:
							</th>

						</tr>

					</thead>

					<tbody style="border: 1px solid black">
						@foreach($cart_items as $my_cart)
						<tr style="border: 1px solid black">
							<td style="border: 1px solid black">
								{{ $my_cart->name }}
							</td>
							<td style="border: 1px solid black">
								{{ $my_cart->price }}
							</td>

							<form method="POST" action="/addtocart/{{ $my_cart->id }}">

								<td style="border: 1px solid black">
									{{ csrf_field() }}
									{{ method_field('PATCH') }}
									<input type="number" name="quantity" value="{{ $my_cart->quantity }}">
								</td>

								<td style="border: 1px solid black" class="text-center">								
									<button class="btn btn-success"><i class="far fa-save"></i></button>
								</form>

								<form method="POST" action="/remove/{{ $my_cart->id }}">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
								</form>
							</td>							
							<td style="border: 1px solid black">
								{{ $my_cart->subtotal }}
							</td>
							</tr>

						@endforeach
					</tbody>

				</table>
				Total: {{ $total }}
				<form method="POST" action="/clearcart">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<button type="submit" class="btn btn-danger">Empty My Cart</button>
				</form>
					<a href="/checkout">Proceed to CheckOut</a>
				@else

				<p>Your Cart is Empty asf!</p>

				@endif


			</div>
		</div>


		


	</div>

</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

</body>
</html>