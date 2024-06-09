@extends('admin.layouts.app')
@section('content')
<div class="mb-1 mt-2">
    <ul class="breadcrumb">
        <li><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="mx-1">/</li>
        <li class="active">Gateway</li>
    </ul>
</div>
<div class="card">

	<div class="card-header">
		<h1>{{$gateways->title}}</h1>
		<div class="page-head">
			<div class="head-content">
			</div>
		</div>
		<!-- panel-menu -->
	</div>
	<div class="card-body">
		<div class="card-body">
			<div class="table-responsive">
				<table id="payment-gateway-detail-view" class="table table-bordered">
					<tbody>
						<tr>
							<th>ID</th>
							<td colspan="1">{{$gateways->id}}</td>
						</tr>
						<tr>
							<th>Gateway Type</th>
							<td colspan="1">{{$gateways->type_id}}</td>
						</tr>
						<tr>
							<th>Created On</th>
							<td colspan="1">{{$gateways->created_at}}</td>
						</tr>
						<tr>
							<th>Updated On</th>
							<td colspan="1">{{$gateways->updated_at}}</td>
						</tr>
						<tr>
							<th>Created By</th>
							<td colspan="1"><a href="/moneda-yii2-1557/user/1/super-admin">{{$gateways->create_by_id}}</a></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="clearfix"></div>
			<hr>
			<h3> Details </h3>
			<div class="col-md-12 m-t-10">
				<div class="col-md-2">
					<strong>Twilio account sid - </strong>
					<div class="col-md-10">{{$sid}}</div>
				</div>

			</div>
			<div class="col-md-12 m-t-10">
				<div class="col-md-2">
					<strong>Twilio account token - </strong>
					<div class="col-md-10">{{$token}}</div>
				</div>
			</div>


			<div class="col-md-12 m-t-10">
				<div class="col-md-2">
					<strong>Phone number - </strong>
					<div class="col-md-10">{{$phone}}</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<hr>
		</div>
	</div>
</div>
@endsection