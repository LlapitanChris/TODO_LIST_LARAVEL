{{-- <!DOCTYPE html>
<html> --}}
@extends('layouts.app')
@section('content')
	<div class="container">
		

		@if(Session::has('success_message'))
		<div class="alert alert-success">
			{{ Session::get('success_message') }}


		</div>
		@endif


		@if(Session::has('delete_message'))
		<div class="alert alert-danger">
			{{ Session::get('delete_message') }}


		</div>
		@endif

		<h1>Show items</h1>


		<div class="container">

			<div class="row">
				<div class="col-md-6">
					<h2>Existing Items</h2><br> 					
				</div>
				<div class="col-md-3 text-center">
					<a href="/menu/add"><button class="btn btn-success">Add Item</button></a>
				</div>
				<div class="col-md-3 text-center">
					<a href="/mycart"><button class="btn btn-success">My cart</button></a>
				</div>
			</div>

				
			<div class="container">
			
					@foreach(\App\Category::all() as $category)
				<a href="/menu/categories/{{ $category->id }}" class="btn btn-primary">{{ $category->name }}</a>

					@endforeach


				
				<div class="row">
					@foreach($items as $item)
					<div class="col-md-3">
						<div class="grid">
							<div class="grid-item" style="width: 200px; border: 1px solid black">
								
								<div class="grid-item grid-item--width2" style="width: 200px; border: 1px solid black">
									<img style="width: 100%;" class="img-responsive" src="/{{ $item->image }}">
									<p>{{ $item->name  }}</p>
									<p>{{ $item->category->name}}</p>				
									<div class="text-left">
										<a href="/menu/{{ $item->id }}">View details</a>
									</div>

									<form method="POST" action="/addtocart/{{ $item->id }}" class="form-inline">
										{{ csrf_field() }}

										<div class="form-group mx-sm-3 mb-2">
											<input type="number" min="1" name="quantity">
										</div>
										<button type="submit" class="btn btn-primary mb-2">Add to Cart</button>

									</form>
								</div>
							</div>
						</div>

					</div>
					@endforeach
				</div>

			</div>

		</div> 

	</div>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
{{-- </html> --}}
@endsection