@extends('layouts.main')
@section('content')
  <div class="col-md-2 pull-right">
    <a href="{{route('report-daily')}}" class="btn btn-info pull-right">Daily Report</a>
  </div>
  <h4><i class="fa fa-barcode"></i> Sales Register - <strong class="mystrong">F3</strong></h4>
  <div class="row">
    <div class="col-md-8">
      <div class="row">
        <form action="{{route('addToCart')}}" method="post">
          {{csrf_field()}}
            <input type="text" class="form-control barcode-reader" placeholder="Search product by sku or name,you can scan barcode too" name="search" id="search"/>
        </form>

          <table class="table table-striped">
            <thead>
              <tr>
                <th>Delete</th>
                <th>SKU</th>
                <th>Name</th>
                <th>Price</th>
                <th>Qty - <strong class="mystrong">F4</strong></th>
                <th>Discount - <strong class="mystrong">F6</strong></th>
                <th>SubTotal</th>
              </tr>
            </thead>
            <tbody>
              @if (count($mycart)>0)
                @foreach ($mycart as $cart)
                  <tr id="fade">
                    <td>
                      <form action="{{route('delete-item',$cart->id)}}" method="post">
                        {{csrf_field()}}
                        <button class="btn btn-danger btn-sm" id="fade">Remove</button>
                      </form>
                    </td>
                    <td>2212431</td>
                    <td>{{DB::table('products')->where('id','=',$cart->product_id)->pluck('name')->first()}}</td>
                    <td>{{$cart->product_price}}</td>
                    <td>
                      <form action="{{route('update-qty',$cart->product_id)}}" method="post">
                        {{csrf_field()}}
                        <input type="text" class="form-control input-sm product-input" value="{{$cart->quantity}}" name="qty" id="qty"/>
                      </form>
                    </td>
                    <td>
                      <form action="{{route('update-disc',$cart->product_id)}}" method="post">
                        {{csrf_field()}}
                        <input type="text" class="form-control input-sm product-input" value="{{$cart->product_price}}" name="disc" id="disc"/>
                      </form>
                    </td>
                    <td>{{($cart->quantity)*($cart->product_price)}}</td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
      </div>
    </div>
    <div class="col-md-4">
      <table class="table table-striped">
        <thead>
        </thead>
        <form action="{{route('sale-register')}}" method="post">
          {{csrf_field()}}
          <tbody>
            <tr>
              <br />
              <td class="col-md-12">
                <label class="lab"><i class="fa fa-user"></i> Costumer</label>
                <input type="text" class="form-control" placeholder="Select a costumer name" name="costumer" id="costumer"/>
              </td>
            </tr>
          </tbody>
        </table>
        <table class="table table-striped">
          <thead>
          </thead>
          <tbody>
            <tr>
              <td class="col-sm-6">
                No. of Items in Cart
              </td>
              <td class="col-sm-6">
                {{$items}}
              </td>
            </tr>
            <tr>
              <td class="col-sm-6">
                Subtotal:
              </td>
              <td class="col-sm-6">
                Eur {{$subtotal}}
              </td>
            </tr>
            <tr>
              <td class="col-sm-6">
                Tax:
              </td>
              <td class="col-sm-6">
                Eur {{$tax}}
              </td>
            </tr>
            <tr>
              <td class="col-sm-6">
              </td>
              <td class="col-sm-6">
                <h1>Eur {{$totalprice}}</h1>
              </td>
            </tr>
            <tr>
              <td class="col-sm-6">
                <h4>Paid By:</h4>
              </td>
              <td class="col-sm-6">
                <select class="form-control" name="type" id="type">
                  <option value="cash">Cash</option>
                  <option value="bank">Bank</option>
                </select>
              </td>
            </tr>
            <tr>
              <td class="col-sm-6">
                <h4>Owe:</h4>
              </td>
              <td class="col-sm-6">
                <input type="checkbox" name="owe" id="owe" class="form-control"/>
              </td>
            </tr>
            <tr>
              <td class="col-sm-6">
                <h4>Bill ?</h4>
              </td>
              <td class="col-sm-6">
                <input type="checkbox" name="bill" id="bill" class="form-control"/>
              </td>
            </tr>
          </tbody>
      </table>
      <div class="row">
        <div class="col-md-6">
          <a href="#" class="btn btn-default btn-block" id="modalclick" data-toggle="modal" data-target="#myModal">Pay</a>
        </div>
      </div>

    </div>
  </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <input type="text" name="cash" id="cash" placeholder="Para te gatshme" class="form-control payformcontrol" autofocus autocomplete="off">
              </div>
              <div class="col-md-6 col-md-offset-3" style="margin-top:30px;">
                <h3 class="text-center">Kusuri</h3>
                <div class="row kusurrow">
                  <h1 class="text-center" id="kusur"></h1>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-md-6">
                <input type="submit" name="regjistro" id="regjistro" value="Regjistro" class="btn btn-primary btn-block" disabled>
              </div>
              <div class="col-md-6">
                <a href="#" class="btn btn-danger btn-block">Anulo</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
@endsection

@section('script')
  <script>

    $(function(){
      $('#cash').keyup(function(){
        var cash = $('#cash').val();
        var total = {{$totalprice}}
        var kusur = cash - total;
        var fixedkusur = kusur.toFixed(2);
        if (cash < total) {
          $('#kusur').html("Imposible");
          $('#regjistro').prop("disabled", true);
        }else{
          $('#kusur').html(fixedkusur);
          $('#regjistro').prop("disabled", false);
        }
      });
    });

    $(document).keydown(function(e){
      if (e.keyCode == 113) {
         $("#modalclick").click();
         $("#cash").show().focus();
         return false;
      }
      if (e.keyCode == 114) {
         $("#search").show().focus();
         return false;
      }
      if (e.keyCode == 115) {
         $("#qty").show().focus();
         return false;
      }
      if (e.keyCode == 117) {
         $("#disc").show().focus();
         return false;
      }
    });

    $( function() {
      $( "#search" ).autocomplete({
        source: 'http://localhost:8000/search'
      });
    });
  </script>
@endsection
