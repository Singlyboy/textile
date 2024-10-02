@extends('backend.master')


@section('content')
<h1>Parts Form</h1>



<form action="{{route('parts.store')}}" method="post" enctype="multipart/form-data">
@csrf
  <div class="form-group">
    <label for="name">Enter Parts Name</label>
    <input required name="par_name" type="text" class="form-control" id="name" placeholder="Enter Parts Name">
  </div>

  <div class="form-group">
    <label for="xyz">Select Category Name:</label>
    <select name="category_id" class="form-select" aria-label="Default select example">
      
    @foreach ($allCategory as $category)
    
    <option value="{{$category->id}}">{{$category->name}}</option>
    @endforeach
     
  <div class="form-group" style="margin-top: 10px;">
    <label for="name">Enter Description</label>
   <textarea class="form-control" name="par_description" id="" placeholder="Enter Description"></textarea>
  </div>

  <div class="form-group">
    <label for="name">Parts Price</label>
    <input class="form-control" required name="par_price" type="number" min="1" id="" placeholder="Enter Prats price">
  </div>
  <div class="form-group">
    <label for="name">Parts Discount</label>
    <input class="form-control"  name="par_discount" type="number" min="1" id="" placeholder="Enter Prats Discount">
  </div>
  <div class="form-group">
    <label for="name">Enter Product Stock:</label>
    <input required name="par_stock" type="number" min="1" class="form-control" id="" placeholder="Enter product stock">
  </div>
  <div class="form-group">
    <label for="name">Parts Image</label>
    <input type="file" class="form-control" name="par_image" id="" placeholder="Enter the image"></input>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection