{{-- <!DOCTYPE html>
<html> --}}

@extends('layouts.app')
@section('content')

  <div class="container">
    <a href="/menu">Back to menu</a>

    <h1>Add Item Page</h1>

    @if(count($errors) > 0) {{-- $error - is predefined by laravel --}}
    @foreach($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach


    @endif
    <div class="container">
      <form method="POST" enctype="multipart/form-data">
        {{ csrf_field()}}

        {{-- @csrf --}}
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
        </div>

        <div class="form-group">
          <label for="description">Description</label>
          <textarea type="description" name="description" class="form-control" id="description" value="{{ old('description') }}"></textarea>
        </div>
        
        <div class="form-group">
          <label for="price">Price</label>
          <input type="number" name="price" class="form-control" id="price" value="{{ old('price') }}">
        </div> 

         <div class="form-group">
          <label for="category">Categories</label>
          <select id="category" name="categories" class="form-control">

            @foreach(\App\Category::all() as $category)
            {{-- <option value="{{ $category->id }}">{{ $category->name }}</option> --}}
            <option value='{{ $category->id }}' 
              @if(old('category') == $category->id){{"selected"}} @endif>
              {{ $category->name }}
            </option>
            @endforeach            
          </select>
        </div>

         <div class="form-group">
          <label for="image">Image</label>
          <input type="file" name="image" class="form-control" id="image">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>


  <!-- Optional JavaScript -->

{{-- </html> --}}
@endsection

