@extends('admin.layouts.app')

@section('template_title')
@endsection

@section('content')
<div class="mb-1 mt-2">
    <ul class="breadcrumb">
        <li><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="mx-1">/</li>
        <li class="active">Create Items</li>
    </ul>
</div>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12 p-0">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class=" font_600 font-18 font-md-20 mr-auto pr-20">Create Item</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('page::form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
