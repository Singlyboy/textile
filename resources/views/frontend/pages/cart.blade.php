@extends('frontend.master')


@section('content')
<div class="container-fluid py-5 " style="margin-top:200px;">
            <div class="container py-5">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($myCart as $cartData)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{url('/upload/upload/'.$cartData['image'])}}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{ $cartData['parts_name'] }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4"> {{$cartData['price']}}</p>
                                </td>
                                <form action="{{route('update.cart',$cartData['parts_id'])}}" method="post">  
                                @csrf
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <input id="form1" min="1" type="number" name="quantity" value="{{$cartData['quantity']}}" class="form-control form-control-sm" />
                                        </div>
                                        <button class="btn btn-primary active" style="margin-top:10px;" type="submit">Update</button>
                                </td>
                            </form>

                                        </div>
                                    </div>
                                </td>
                                
                                
                                
                                <td>
                                    <p class="mb-0 mt-4">{{ $cartData['subtotal'] }}</p>
                                </td>
                                <td>
                                    <a href="{{route('cart.item.delete',$cartData['parts_id'])}}" class="btn btn-md rounded-circle bg-light border mt-4" >
                                        <i class="fa fa-times text-danger"></i>
</a>
                                </td>
                                
                            
                            </tr>
                            
                            @endforeach
                           
                        </tbody>
                    </table>
                </div>
              
                <div class="row g-4 justify-content-end">
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                        <div class="bg-light rounded">
                            <div class="p-4">
                                <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                               
                               
                            </div>
                            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                <h5 class="mb-0 ps-4 me-4">Total</h5>
                                <p class="mb-0 pe-4">{{array_sum(array_column(session()->get('basket'),'subtotal'))}} BDT</p>
                            </div>
                            <a href="{{route('checkout')}}" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4">Proceed Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection