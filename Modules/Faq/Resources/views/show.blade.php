@extends('admin.layouts.app')

@section('template_title')
{{ $faq->title ?? 'Show Faq' }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class=" font_600 font-18 font-md-20 mr-auto pr-20">Show Faq</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-bg" href="{{ route('faq') }}"> Back</a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <strong>Question:</strong>
                        {{ $faq->question }}
                    </div>
                    <div class="form-group">
                        <strong>Answer:</strong>
                        {{ $faq->answer }}
                    </div>



                </div>
            </div>
        </div>
    </div>
</section>
@endsection