@extends('home')
@section('content')
<div class="container">
  <?php
  $totalPrice=0;
  ?>
  <div class="row">
    <a class="col-lg-3 col-md-6" href="{{route('order')}}">
      <div class="card nk-cyan">
        <div class="card-body">
          <div class="stat-widget-five">
            <div class="stat-icon dib flat-color-1">
              <i class="fas fa-money-check"></i>
            </div>
            <div class="stat-content">
              <div class="text-left dib">
                <div class="stat-text">MMK
                  @foreach ($priceInfo as $key=>$total)
                  <?php
                  $totalPrice+=$total['total_price'];
                  ?>
                  @endforeach
                  <span class="count"> 
                    {{$totalPrice}}
                  </span>
                 </div>
                <div class="stat-heading">Revenue</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </a>
    <a class="col-lg-3 col-md-6" href="{{route('order')}}">
      <div class="card nk-blue ">
        <div class="card-body">
          <div class="stat-widget-five">
            <div class="stat-icon dib flat-color-2">
              <i class="fas fa-spinner"></i>
            </div>
            <div class="stat-content">
              <div class="text-left dib">
                <div class="stat-text">
                  <?php
                  $total=0;
                  ?>
                  @foreach ($saleInfo as $key=>$value)
                  <?php
                  $total+=$value->quantity;
                  ?>
                  @endforeach 
                  <span class="count">
                    {{$total}}
                  </span>
                </div>
                <div class="stat-heading">Pending Items</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </a>
    <a class="col-lg-3 col-md-6" href="{{route('order')}}">
      <div class="card nk-deep-purple">
        <div class="card-body">
          <div class="stat-widget-five">
            <div class="stat-icon dib flat-color-3">
              <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="stat-content">
              <div class="text-left dib">
                <div class="stat-text"><span class="count">{{$countOrder}}</span></div>
                <div class="stat-heading">Total Orders</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </a>
    <a class="col-lg-3 col-md-6" href="{{route('showCustomer')}}">
      <div class="card nk-gray">
        <div class="card-body">
          <div class="stat-widget-five">
            <div class="stat-icon dib flat-color-4">
              <i class="fas fa-user-friends"></i>
            </div>
            <div class="stat-content">
              <div class="text-left dib">
                <div class="stat-text"><span class="count">{{$count}}</span></div>
                <div class="stat-heading">Customers</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>
  <div style="margin-bottom:5%;"></div>
  <div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <div class="recent-post-wrapper notika-shadow sm-res-mg-t-30 tb-res-ds-n dk-res-ds">
        <div class="recent-post-ctn">
          <div class="recent-post-title">
            <h2>Recent News</h2>
          </div>
        </div>
        <div class="recent-post-items">
          @foreach ($newsInfo as $key=>$value)
          <div class="recent-post-signle rct-pt-mg-wp">
            <a href="{{route('AllNews')}}">
              <div class="recent-post-flex">
                <div class="recent-post-it-ctn">
                  <h2>{{ $value->news_title }}</h2>
                  <?php $details = strip_tags($value->news_detail) ?>
                <p style="margin:2% 0% 2% 0%;">{{$details}}</p>
                </div>
              </div>
            </a>
          </div>
          @endforeach
          <div class="recent-post-signle">
            <a href="{{route('AllNews')}}">
              <div class="recent-post-flex rc-ps-vw">
                <div class="recent-post-line rct-pt-mg">
                  <p>View All</p>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <div class="recent-items-wp notika-shadow sm-res-mg-t-30">
        <div class="rc-it-ltd">
          <div class="recent-items-ctn">
            <div class="recent-items-title">
              <h2>Recent Items</h2>
            </div>
          </div>
          <div class="recent-items-inn">
            <table class="table table-inner table-vmiddle">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th style="width: 60px">Price</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($productInfo as $key=>$item)
                <tr>
                  <td class="f-500 c-cyan">{{ $item->id }}</td>
                  <td>{{ $item->model }}</td>
                  <td class="f-500 c-cyan">{{ $item->price }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <div class="recent-items-wp notika-shadow sm-res-mg-t-30">
        <div class="rc-it-ltd">
          <div class="recent-items-ctn">
            <div class="recent-items-title">
              <h2>Admins</h2>
            </div>
          </div>
          <div class="recent-items-inn">
            <table class="table table-inner table-vmiddle">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($userInfo as $key=>$admin)
                <tr>
                  <td class="f-500 c-cyan">{{ $admin->id }}</td>
                  <td>{{ $admin->name }}</td>
                  <td class="f-500 c-cyan">{{ $admin->email }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>  
  <div style="margin-bottom:5%;"></div> 
  <div class="row">
    <div class="col-lg-6 col-md-8 col-sm-7 col-xs-12">
      <div class="sale-statistic-inner notika-shadow mg-tb-30">
        <div class="curved-inner-pro">
          <div class="curved-ctn">
            <h2>Sales Statistics</h2>
          </div>
        </div>
        {!!$chart->html()!!}
      </div>
    </div>    
    <div class="col-lg-6 col-md-8 col-sm-7 col-xs-12">
      <div class="sale-statistic-inner notika-shadow mg-tb-30">
        <div class="curved-inner-pro">
          <div class="curved-ctn">
            <h2>Sale of Product </h2>
          </div>
        </div>
        {!!$pie->html()!!}
      </div>
    </div>
    {!! Charts::assets() !!}
    {!! $pie->script() !!}
    {!! $chart->script() !!}
    </div>
  <div style="margin-bottom:2%;"></div> 
</div>
<script src="{{asset('js/dashboard.js')}}">
</script>
@endsection
