@extends('backend.master')


@section('content')
<h1>Update Parts</h1>



<form action="{{route('parts.update',$parts->id)}}" method="post" enctype="multipart/form-data">
@csrf
  <div class="form-group">
    <label for="name">Enter Parts Name</label>
    <input value="{{$parts->name}}" name="par_name" type="text" required class="form-control" id="name" placeholder="Enter Parts Name">
  </div>

  <div class="form-group">
    <label for="xyz">Select Category Name:</label>
    <select name="category_id" class="form-select" aria-label="Default select example">
      
    @foreach ($allCategory as $category)
    <option value="{{$category->id}}">{{$category->name}}</option>
    @endforeach
 
  <div class="form-group">
    <label for="name">Parts Price</label>
    <input value="{{$parts->price}}" required name="par_price" type="number" class="form-control" id="p_price" placeholder="Enter product price">
  </div>
  <div class="form-group">
    <label for="name">Parts Discount</label>
    <input value="{{$parts->discount}}" class="form-control"  name="par_discount" type="number" id="" placeholder="Enter Prats Discount">
  </div>
  <div class="form-group">
    <label for="name">Enter Product Stock:</label>
    <input value="{{$parts->stock}}" required name="par_stock" type="number" class="form-control" id="" placeholder="Enter product stock">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  
@endsection