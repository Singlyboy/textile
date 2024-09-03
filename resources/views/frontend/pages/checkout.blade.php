@extends('frontend.master')

@section('content')
<div class="container-fluid py-5">
            <div class="container py-5">
                <h1 class="mb-4">Billing details</h1>
                <form action="{{route('order.place')}}" method="post">
                @csrf
                    <div class="row g-5">
                        <div class="col-md-12 col-lg-6 col-xl-7">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Receiver name<sup>*</sup></label>
                                        <input name="receiver_name" requiredtype="text" class="form-control">
                                    </div>
                                </div>
                             
                            </div>
                          
                            <div class="form-item">
                                <label class="form-label my-3">Address <sup>*</sup></label>
                                <input name="address" required type="text" class="form-control" placeholder="House Number Street Name">
                            </div>
                           
                            
                           
                            <div class="form-item">
                                <label class="form-label my-3">Mobile<sup>*</sup></label>
                                <input name="receiver_mobile" required type="tel" class="form-control">
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Email Address<sup>*</sup></label>
                                <input name="email" required type="email" class="form-control">
                            </div>
                          
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-5">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Products</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($myCart as $chackData)
                                        <tr>
                                            <th scope="row">
                                                <div class="d-flex align-items-center mt-2">
                                                    <img src="{{url('/upload/upload/'.$chackData['image'])}}" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                                </div>
                                            </th>
                                            <td class="py-5">{{ $chackData['parts_name'] }}</td>
                                            <td class="py-5">{{ $chackData['price'] }}</td>
                                            <td class="py-5">{{ $chackData['quantity'] }}</td>
                                            <td class="py-5"> {{ $chackData['subtotal'] }}</td>
                                        </tr>
                                        @endforeach
                                      
                                       
                                        <tr>
                                            <th scope="row">
                                            </th>
                                            <td class="py-5">
                                                <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                                            </td>
                                            <td class="py-5"></td>
                                            <td class="py-5"></td>
                                            <td class="py-5">
                                                <div class="py-3 border-bottom border-top">
                                                    <p class="mb-0 text-dark">{{ session()->has('basket')  ? array_sum(array_column(session()->get('basket'),'subtotal')):0}}</p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-12">
                                    <div class="form-check text-start my-3">
                                        <input type="radio"  name="paymentMethod" value="online" required class="form-check-input bg-primary border-0" id="Payments-1" name="Payments" value="Payments">
                                        <label class="form-check-label" for="Payments-1">Check Payments</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-12">
                                    <div class="form-check text-start my-3">
                                        <input type="radio" name="paymentMethod" value="cod" required class="form-check-input bg-primary border-0" id="Delivery-1" name="Delivery" value="Delivery">
                                        <label class="form-check-label" for="Delivery-1">Cash On Delivery</label>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                                <button class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary" type="submit">Place Order</button>
                            </div>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>

@endsection