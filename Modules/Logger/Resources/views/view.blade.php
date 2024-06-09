@extends('admin.layouts.app')
@section('content')
<div class="mb-1 mt-2">
    <ul class="breadcrumb">
        <li><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="active">Manage</li>
        <li class="active">Logs</li>
        <li class="active">{{$logs->level_name}}{{$logs->level}}</li>
	</ul>

</div>


<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="page-head-text">
                <div class="ProfileHader d-flex flex-wrap align-items-center">
                <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">{{$logs->message}}</h3>

                </div>
            </div>
            <div class="card">
            <div class="card-body col-md-12">
					<div class="form-group">
						<div class="row">

                        <div class="col-md-12">
								<div class="table-responsive">
									<table class="table table table-bordered">
										<tbody>
											<tr>
												<th>
													<strong>
														<span class="text-dark">id </span>
													</strong>
												</th>
												<td>
													<strong>
														{{$logs->id}}
													</strong>

												</td>
												<th>
													<strong>
														<span class="text-dark">Level </span>
													</strong>
												</th>
												<td>
													<strong>
														{{$logs->level}}
													</strong>
												</td>
											</tr>


											<tr>
												<th>
													<strong>
														<span class="text-dark">Level Name </span>
													</strong>
												</th>
												<td>
													<strong>
														{{ $logs->level_name}}
													</strong>
												</td>
												<th>
													<strong>
														<span class="text-dark">Error Location </span>
													</strong>
												</th>
												<td>
													<strong>
														{{$logs->file}}
													</strong>
												</td>
                                                
											</tr>

											<tr>
												<th>
													<strong>
														<span class="text-dark">Error Containing Line </span>
													</strong>
												</th>
												<td>
													<strong>
														{{$logs->error_line}}
													</strong>
												</td>
												<th>
													<strong>
														<span class="text-dark">Message </span>
													</strong>
												</th>
												<td>
													<strong>
														{{$logs->message}}
													</strong>
												</td>
											</tr>
                                            <tr>
												<th>
													<strong>
														<span class="text-dark">User Agent </span>
													</strong>
												</th>
												<td>
													<strong>
														{{$logs->user_agent}}
													</strong>
												</td>
												<th>
													<strong>
														<span class="text-dark">Created On </span>
													</strong>
												</th>
												<td>
													<strong>
														{{$logs->created_at}}
													</strong>
												</td>
											</tr>

											

										</tbody>
									</table>

								</div>
							</div>
						</div>
					</div>
				</div>
                <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Trace</h3>
                                            @php foreach (explode("\n", $logs->trace) as $line) { @endphp
                                            {{$line}}<br/>
                                            @php } @endphp
                
            </div>
        </div>
    </div>
</section>
@endsection