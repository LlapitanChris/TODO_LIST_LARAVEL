<!DOCTYPE html>
<html>
<head>
	<title>Show Categories</title>
</head>
<body>
	<h1>Show Category</h1>

	@foreach($categories as $category)
	<a href="/categories/{{ $category->id }}">{{ $category->name }}</a>

	@endforeach

</body>
</html>