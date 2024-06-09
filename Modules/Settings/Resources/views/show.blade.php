@extends('admin.layouts.app')
@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class=" font_600 font-18 font-md-20 mr-auto pr-20">Setting</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-bg" href="{{ url('/settings/') }}"> Back</a>
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
                                                    <th>Module:</th>
                                                    <td colspan="1"> {{$show->getModule()}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Key:</th>
                                                    <td colspan="1"> {{$show->key}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Value:</th>
                                                    <td colspan="1">{{$show->value}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Created By:</th>
                                                    <td colspan="1"> {{$show->getUser->name}}</td>
                                                </tr>
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