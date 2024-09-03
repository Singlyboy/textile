@extends('frontend.master')


@section('content')

<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">
    <p>
    {{ $parts->count() }} items found for "{{ request()->search_key }}"
</p>

@foreach ($parts as $par )

                                    
<div class="col-md-6 col-lg-4 col-xl-3">
<a href="{{route('show.parts',$par->id)}}">
    <div class="rounded position-relative fruite-item">
        <div class="fruite-img">
            <img style="width:250px;" src="{{url('/upload/upload/'.$par->image)}}" class="img-fluid rounded-top" alt="">
        </div>
        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">{{$par->category->name}}</div>
        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
            <h4>{{$par->name}}</h4>
            <p>Stock : {{$par->stock >0 ?  $par->stock : 'out of stock'}}</p>
            <div class="d-flex justify-content-between flex-lg-wrap">
                <p class="text-dark fs-5 fw-bold mb-0">{{$par->price}} BDT</p>

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
</section>

@endsection