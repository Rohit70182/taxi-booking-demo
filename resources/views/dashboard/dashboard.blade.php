@extends('admin.layouts.app')
@section('content')
<!-- Style Css -->
<link rel="stylesheet" href="{{ asset('public/dashboard-assets/css/pages-css/index.css') }}" />
<!-- Style Css -->
@if( Session::has('orig_user') )
<div class=" p-3 mb-2 bg-primary text-white">

  <span>You are now logged in as <strong>{{Auth()->user()->name }}</strong> Click
    <a href="{{url('/shadow/return')}}">here</a>
    to return back
  </span>
</div><br>
@endif
@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>{{ $message }}</strong>
</div>
@endif


<div>
  <ul class="breadcrumb">
    <li><a href="{{url('/dashboard')}}">Home</a></li>
    <li class="mx-1">/</li>
    <li class="active">Dashboard</li>
  </ul>
</div>

<div class="dash-home-cards">
  <div class="row row-cols-xxl-4 row-cols-xl-3 row-cols-md-2 row-cols-1 top-cards">
    <div class="col-md-6 col-lg-4 col-xl-3 mb-20">
      <a href="{{url('logActivity')}}">
        <div class="card">
          <div class="value white">
            <p class="cart-title mb-2">User History</p>
            <h5 class="main-results">{{\App\Models\LogActivity::count()}}</h5>
          </div>
          <div class="symbol">
            <i class="fas fa-user-clock"></i>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3 mb-20">
      <a href="{{url('dashboard/users')}}">
        <div class="card">
          <div class="value white">
            <p class="cart-title mb-2">Users</p>
            <h5 class="main-results">{{ \App\Models\User::count() }}</h5>
          </div>
          <div class="symbol">
            <i class="fas fa-users"></i>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3 mb-20">
      <a href="{{url('logs')}}">
        <div class="card">
          <div class="value white">
            <p class="cart-title mb-2">Logs</p>
            <h5 class="main-results">{{\Modules\Logger\Entities\Logger::count()}}</h5>
          </div>
          <div class="symbol">
            <i class="fas fa-history"></i>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3 mb-20">
      <a href="{{url('notifications')}}">
        <div class="card">
          <div class="value white">
            <p class="cart-title mb-2">Notifications</p>
            <h5 class="main-results">{{ \Modules\Notification\Entities\Notification::count() }}</h5>
          </div>
          <div class="symbol">
            <i class="fas fa-bell"></i>
          </div>
        </div>
      </a>
    </div>
    @if (Auth::user() && Auth::user()->role == App\Models\User::ROLE_ADMIN)
    <div class="col-md-6 col-lg-4 col-xl-3 mb-20">
      <a href="{{url('dashboard/team')}}">
        <div class="card" style="background-color: cornflowerblue;">
          <div class="value white">
            <p class="cart-title mb-2">Teams</p>
            <h5 class="main-results">{{ \App\Models\Team::count() }}</h5>
          </div>
          <div class="symbol">
            <i class="fas fa-users"></i>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3 mb-20">
      <a href="{{url('dashboard/driver')}}">
        <div class="card" style="background-color: #5b667a;">
          <div class="value white">
            <p class="cart-title mb-2">Drivers</p>
            <h5 class="main-results">{{ \App\Models\User::where('role', \App\Models\User::ROLE_DRIVER)->count() }}</h5>
          </div>
          <div class="symbol">
            <i class="fas fa-users"></i>
          </div>
        </div>
      </a>
    </div>
    @endif
  </div>
  <div class="col-md-12 p-lg-0">
    <div class="card">
      <div class="card-body">
        <figure class="highcharts-figure">
          <div id="container"></div>
        </figure>
      </div>
    </div>
  </div>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript">
  var userData = {
    {
      json_encode($userdata)
    }
  }

  Highcharts.chart('container', {
    title: {
      text: 'User Growth'
    },


    xAxis: {
      categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
        'October', 'November', 'December'
      ]
    },
    yAxis: {
      title: {
        text: 'Number of New Users'
      }
    },
    legend: {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle'
    },
    plotOptions: {
      series: {
        allowPointSelect: true
      }
    },
    series: [{
      name: 'New Users',
      data: userData
    }],
    responsive: {
      rules: [{
        condition: {
          maxWidth: 500
        },
        chartOptions: {
          legend: {
            layout: 'horizontal',
            align: 'center',
            verticalAlign: 'bottom'
          }
        }
      }]
    }
  });
</script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript">

  var userData = {{json_encode($userdata)}}

  Highcharts.chart('container', {
    title: {
      text: 'User Growth'
    },


    xAxis: {
      categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
        'October', 'November', 'December'
      ]
    },
    yAxis: {
      title: {
        text: 'Number of New Users'
      }
    },
    legend: {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle'
    },
    plotOptions: {
      series: {
        allowPointSelect: true
      }
    },
    series: [{
      name: 'New Users',
      data: userData
    }],
    responsive: {
      rules: [{
        condition: {
          maxWidth: 500
        },
        chartOptions: {
          legend: {
            layout: 'horizontal',
            align: 'center',
            verticalAlign: 'bottom'
          }
        }
      }]
    }
  });
</script>
@endsection