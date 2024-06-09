@extends('admin.layouts.app')
@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                    <div class="float-left">
                        <span class=" font_600 font-18 font-md-20 mr-auto pr-20"></span>
                    </div>
                    @if(Auth::check() && Auth::user()->role == '0')
                    <div class="float-right">
                        <form method="post" action="{{url('shadow/switch/'.$show_category->id)}}">
                            @csrf
                            <div><button class="btn btn-bg" type="submit">Shadow</button></div>
                        </form>
                    </div>
                    @endif
                </div>
                <div class="card-body col-md-12">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <strong>Information</strong><br>
                                <div class="table-responsive">
                                    <table class="table table-user-information">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        <span class="text-dark">Category:</span>
                                                        {{$show_category->title}}
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
                <div class="col-md-12">
                    <x-comment />
                </div>
            </div>
        </div>
    </div>
</section>
@endsection