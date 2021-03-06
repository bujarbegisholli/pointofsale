@extends('layouts.main')

@section('content')
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="col-md-3">
        <div class="wrimagecard wrimagecard-topimage">
           <a href="#">
           <div class="wrimagecard-topimage_header" style="background-color:rgba(187, 120, 36, 0.1) ">
             <center><i class="fa fa-shopping-cart" style="color:#BB7824"></i></center>
           </div>
           <div class="wrimagecard-topimage_title">
             <h4>Sales Today
             <div class="pull-right badge">{{$data['total_qty']}}</div></h4>
           </div>
         </a>
       </div>
      </div>
      <div class="col-md-3">
        <div class="wrimagecard wrimagecard-topimage">
           <a href="#">
           <div class="wrimagecard-topimage_header" style="background-color:rgba(187, 120, 36, 0.1) ">
             <center><i class="fa fa-area-chart" style="color:#BB7824"></i></center>
           </div>
           <div class="wrimagecard-topimage_title">
             <h4>Products
             <div class="pull-right badge">{{$data['total_products']}}</div></h4>
           </div>
         </a>
       </div>
      </div>
      <div class="col-md-3">
        <div class="wrimagecard wrimagecard-topimage">
           <a href="#">
           <div class="wrimagecard-topimage_header" style="background-color:rgba(187, 120, 36, 0.1) ">
             <center><i class="fa fa-area-chart" style="color:#BB7824"></i></center>
           </div>
           <div class="wrimagecard-topimage_title">
             <h4>Charts
             <div class="pull-right badge">18</div></h4>
           </div>
         </a>
       </div>
      </div>
      <div class="col-md-3">
        <div class="wrimagecard wrimagecard-topimage">
           <a href="#">
           <div class="wrimagecard-topimage_header" style="background-color:rgba(187, 120, 36, 0.1) ">
             <center><i class="fa fa-area-chart" style="color:#BB7824"></i></center>
           </div>
           <div class="wrimagecard-topimage_title">
             <h4>Charts
             <div class="pull-right badge">18</div></h4>
           </div>
         </a>
       </div>
      </div>
    </div>
  </div>
@endsection
