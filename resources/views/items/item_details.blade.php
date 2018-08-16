{{-- <!DOCTYPE html>
<html>
<head>
	<title>Item Details</title> --}}

	@extends('layouts.app')
	@section('content')
	<div class="container">
		<a href="/menu">Go to Menu</a>
		
		<h1>Items details</h1>

		@if(Session::has('success_message'))
		<div class="alert alert-success">
			{{ Session::get('success_message') }}


		</div>
		@endif

		Image:	<img style="width: 400px" src="/{{ $item->image }}"> <br>
		Name:	{{ $item->name }} <br>
		Price:	{{ $item->price }} <br>
		Description: {{ $item->description }} <br>
		Categories:	{{ $item->category->name }} <br>
		<a href="/menu/{{ $item->id }}/edit" class="btn btn-primary btn-sm">Edit</a>

		<button class="btn btn-danger" data-toggle="modal" data-target="#favoritesModal">Delete</button>


		{{-- Modal  --}}

		<div class="modal fade" id="favoritesModal" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="favoritesModalLabel">Delete this file</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							<p>Are you sure you want to delete this?</p>
							ID:	{{ $item->id }} <br>
							Name:	{{ $item->name }} <br>
							Price:	{{ $item->price }} <br>
						</div>
						<div class="modal-footer">
							<button type="button" 
							class="btn btn-default" 
							data-dismiss="modal">Close</button>
							<span class="pull-right">
								<form method="POST" action="/menu/{{ $item->id }}/delete">
									{{ csrf_field() }}
									{{ method_field('DELETE') }} {{-- for security purposes --}}
									<button class="btn btn-danger">Delete</button> 
								</form>
							</span>
						</div>
					</div>
				</div>
			</div>


			{{-- EndModal --}}



		</div>

		<!-- Optional JavaScript -->
		
{{-- 	</html> --}}
@endsection