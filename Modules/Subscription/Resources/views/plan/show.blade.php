@extends('admin.layouts.app')
@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class=" font_600 font-18 font-md-20 mr-auto pr-20">Plan</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-bg" href="{{ url('/settings/') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body"> 
                        <div class="form-group">
                            <strong>Module:</strong>
                            {{ $show->title }}
                        </div>
                        <div class="form-group">
                            <strong>Key:</strong>
                            {{ $show->validity }}
                        </div>
                        <div class="form-group">
                            <strong>Value:</strong>
                            {{ $show->price }}
                        </div>
                        <div class="form-group">
                            <strong>Created By:</strong>
                            {{ $show->getPlan() }}
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
