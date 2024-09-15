@extends('frontend.master')


@section('content')

<style>
    .fruite-img {
    width: 100%; /* Ensure it uses full width of the container */
    height: 200px; /* Set a fixed height */
    overflow: hidden; /* Hide overflow to maintain aspect ratio */
    position: relative; /* Allow absolute positioning within the container */
}
</style>
<div class="tab-content " style="margin-top:200px;">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div  class="row g-4">
                                <div  class="col-lg-12">
                                    <div class="row g-4">
                                    @foreach ($parts as $par )

                                    
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                        <a href="{{route('show.parts',$par->id)}}">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img style="width:3000px;" src="{{url('/upload/upload/'.$par->image)}}" class="img-fluid rounded-top" alt="">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><h4>{{$par->category->name}}</h4>  
                                                    @if($par->discount>0)
                                            <span class="badge badge-success">{{$par->discount}}%</span>
                                           @endif</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <!-- Display Part Name -->    
                                                <h4>{{$par->name}}</h4>
                                                    <!-- Display Discount Badge if Discount Exists -->
                                                   
                                               
                                                    <p>Stock : {{$par->stock >0 ?  $par->stock : 'out of stock'}}</p>
                                                    
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                                 
                                                    <!-- discount Calculate -->
                                                    <p class="text-dark fs-5 fw-bold mb-0">
                                                              @if($par->discount > 0)
                                                                <span class="mb-2"><del>{{$par->price}} BDT</del></span>
                                                                <span class="text-danger">
                                                                    {{ $par->price - ($par->price * $par->discount / 100) }} BDT
                                                                </span>
                                                            @else
                                                                <span class="mb-2">{{$par->price}} BDT</span>
                                                            @endif
                                                            </p>
                                                                                                                                                    

                                                        @if ($par->stock > 0)
                                                        <a href="{{route('add.to.cart',$par->id)}}" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                        @else
                                                        <a disabled href="{{route('add.to.cart',$par->id)}}" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                       
                                      @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>



@endsection