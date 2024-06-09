@extends('admin.layouts.app')
@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                    <div class="float-left">
                        <span class=" font_600 font-18 font-md-20 mr-auto pr-20"> {{$seo->title}}</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-bg" href="{{url('/seo/manager')}}" title="Manage"><span class="fa fa-list"></span></a>
                        <a class="btn btn-bg" href="{{url('/seo/manager/edit')}}/{{$seo->id}}" title="Update"><span class="fa fa-pencil"></span></a>
                    </div>
                </div>
                <div class="card-body col-md-12">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="seo-detail-view" class="table table-striped table-bordered detail-view">
                                            <tbody>
                                                <tr>
                                                    <th>Title</th>
                                                    <td colspan="1">{{$seo->title}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Route</th>
                                                    <td colspan="1">{{$seo->route}}</td>
                                                </tr>
                                                <tr>
                                                    <th>keywords</th>
                                                    <td colspan="1">{{$seo->keywords}}</td>
                                                </tr>
                                                <tr>
                                                    <th>data</th>
                                                    <td colspan="1">{{$seo->data}}</td>
                                                </tr>
                                                <tr>
                                                    <th>State</th>
                                                    <td colspan="1">{{$seo->state}}</td>
                                                </tr>
                                                <tr></tr>
                                            </tbody>
                                        </table>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection