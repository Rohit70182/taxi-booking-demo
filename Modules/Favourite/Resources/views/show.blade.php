@extends('admin.layouts.app')

@section('template_title')
    {{ $item->title ?? 'Show Page' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class=" font_600 font-18 font-md-20 mr-auto pr-20">Show Page</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-bg" href="{{ url('favourite') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Model Id:</strong>
                            {{ $item->model_id }}
                        </div>
                         <div class="form-group">
                            <strong>Model Type:</strong>
                            {{ $item->model_type }}
                        </div>
                        
                    

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
