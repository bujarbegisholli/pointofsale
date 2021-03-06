@extends('layouts.main')

@section('content')
<div class="row myrow">
  <div class="row">
    <div class="col-md-3">
      <h4><i class="fa fa-barcode"></i> Sales</h4>
    </div>

    <div class="col-md-2 pull-right">
      <select class="form-control" name="type" id="type">
        <option value="all">All</option>
        <option value="paid">Paid</option>
        <option value="notpaid">Not Paid</option>
      </select>
    </div>
  </div>
  <div class="row">
  <div class="col-md-12">
    <table class="table table-striped table-hover table-bordered">
      <thead>
        <tr>
          <th>Expand</th>
          <th>Payment Method</th>
          <th>Paid</th>
          <th>Total Price</th>
          <th>Costumer</th>
          <th>Created At</th>
          <th>Time</th>
          <th>Delete</th>
          <th id="paidth" style="display:none;">Paid</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($sales as $sale)
          <tr>
            <td><a href="{{route('sale-single',$sale->id)}}" class="btn btn-info btn-block btn-sm">Expand</a></td>
            <td>{{$sale->payment_method}}</td>
            <td>{{$sale->paid == 1 ? 'Paid' : "Not Paid"}}</td>
            <td>{{$sale->total_price}} Eur</td>
            <td>{{$sale->costumer}}</td>
            <td>{{$sale->created_at->format('D M')}}</td>
            <td>{{$sale->time}}</td>
            <td>
              <form action="{{route('sale-delete',$sale->id)}}" method="post">
                {{csrf_field()}}
                <input type="submit" value="Delete" class="btn btn-danger btn-block btn-sm" />
              </form>
            </td>
              @if($sale->paid == 0)
                <td id="paidtd">
                  <a href="#" class="btn btn-success btn-block btn-sm">Mark as paid</a>
                </td>
              @endif
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  </div>
</div>
{{$sales->links()}}
@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function(){
    $('#type').change(function(){
      var type = $('#type').find(":selected").val();
      if (type=="paid") {
        window.location.search = '?type=paid';
      }else if(type=="notpaid"){
        window.location.search = '?type=notpaid';
      }else{
        window.location.search = "";
      }
    });
  });
</script>
@endsection
