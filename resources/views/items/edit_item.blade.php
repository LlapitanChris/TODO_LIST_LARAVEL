<!DOCTYPE html>
<html>
<head>
	<title>Edit Item</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>
<body>
	<h1>Edit details</h1>

	<div class="container">
		@if(count($errors) > 0) {{-- $error - is predefined by laravel --}}
		@foreach($errors->all() as $error)
		<p>{{ $error }}</p>
		@endforeach
		@endif
		<form method="POST" enctype="multipart/form-data">
			{{ csrf_field()}}
			{{ method_field('PATCH') }}

			{{-- @csrf --}}
			<div class="form-group">
				<label>Name</label>
				<input type="text" name="name" class="form-control" value="{{ $item->name }}">
			</div>

			<div class="form-group">
				<label>Description</label>
				<textarea type="description" name="description" class="form-control">{{ $item->description }}</textarea>
			</div>
			<div class="form-group">
				<label>Price</label>
				<input type="number" name="price" class="form-control" value="{{ $item->price }}">
			</div> 

			<div class="form-group">
				<label for="category">Categories</label>
				<select id="category" name="categories" class="form-control">

					@foreach(\App\Category::all() as $category)
					<option value="{{ $category->id }}">{{ $category->name }}</option>

				</option>
				@endforeach

			</select>
		</div>

		<div class="form-group">
			<label for="image">Image</label>
			<input type="file" name="image" class="form-control" id="image">
		</div>  

		<button type="submit" class="btn btn-primary">Save Changes</button>
	</form>

</div>




<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>
</html>