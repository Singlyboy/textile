@extends('backend.master')

@section('content')

<div class="row">

  <div class="col-md-6">
    <h1>Parts List</h1>
    <a class="btn btn-success" href="{{route('parts.form')}}">Create new Parts</a>
  </div>

  <div class="col-md-6">
    <form action="{{route('set.alert.stock')}}" method="post" >
      @csrf

      <input value="{{session()->get('alert')}}" name="alert_qty" type="text" class="form-control" placeholder="Enter Stock alert">
      <button class="btn btn-success">Set</button>

    </form>
  </div>


</div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Category Name</th>
      <th scope="col">Descption</th>
      <th scope="col">Price</th>
      <th scope="col">Stock</th>
      <th scope="col">Image</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($allParts as  $key=>$parts)
    <tr>
    <th scope="row">{{$key+1}}</th>
      <td>{{$parts->name}}</td>
      <td>{{$parts->category->name}}</td>
      <td>{{$parts->description}}</td>
      <td>{{$parts->price}} BDT</td>
      @if(session()->has('alert') and  (int) session()->get('alert') < $parts->stock)
      <td>{{$parts->stock}}</td>
      @else
      <td style="background: red;">{{$parts->stock}}</td>
      @endif
      
      <td>
        <img src="{{url('/upload/upload/')}}" alt="">
      <img width="100px" height="100px" src="{{url('/upload/upload/'.$parts->image)}}" alt="">
      </td>
      <td>
      <a href="{{route('parts.view',$parts->id)}}" class="btn btn-primary">View</a>
      <a href="{{route('parts.edit',$parts->id)}}" class="btn btn-success">Edit</a>
      <a href="{{route('parts.delete',$parts->id)}}" class="btn btn-danger">Delete</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{$allParts->links()}}

@endsection