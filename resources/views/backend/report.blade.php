@extends('backend.master')

@section('content')


<div class="container">
  <button class="btn btn-primary" onclick="printReport()">Print</button>
  

<h1>Order Report</h1>

<form action="{{ route('report.list') }}">

  <label for="">From date</label>
  <input required name="from_date" type="date" placeholder="From date" class="form-control">

  <label for="">To date</label>
  <input required name="to_date" type="date" placeholder="To date" class="form-control">

  <button type="submit" class="btn btn-success">Search</button>

</form>

<div class="card" id="printArea">
  
<div class="row">
  <div class="col-md-5"></div>
  <div class="col-md-5">
    <h1>Order List Report</h1>
    <h4>Date: {{ request()->from_date }} to {{ request()->to_date }}</h4>
  </div>
  <div class="col-md-4"></div>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Order Id</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Receiver Name</th>
      <th scope="col">Receiver Mobile</th>
      <th scope="col">Status</th>
      <th scope="col">Total Amount</th>
      <th scope="col">Payment Method</th>
      <th scope="col">Order Date</th>
      
    </tr>
  </thead>
  <tbody>
    

    @foreach($allOrders as $order)
     
      <tr>
        <th scope="row">{{ $order->id }}</th>
        <td>{{ $order->customer->name }}</td>
        <td>{{ $order->receiver_name }}</td>
        <td>{{ $order->receiver_mobile }}</td>
        <td>{{ $order->status }}</td>
        <td>{{ $order->total_amount }} .BDT</td>
        <td>{{ $order->payment_method }}</td>
        <td>{{ $order->created_at }}</td>
        
      </tr>
    @endforeach

    
    <tr>
      <td colspan="7" class="text-right">Total Amount:</td>
      <td>{{ $allOrders->sum('total_amount') }} BDT</td>
    </tr>

    
  </tbody>
</table>
</div>
</div>

<script type="text/javascript">
    function printReport()
    {
        var printContents = document.getElementById("printArea").innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();

			document.body.innerHTML = originalContents;
    }
</script>
@endsection
