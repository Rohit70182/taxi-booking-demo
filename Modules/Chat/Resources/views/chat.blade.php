@extends('admin.layouts.app')
@section('content')
<link href="{{ asset('public/assets/css/chat.css') }}" rel="stylesheet">

<div class="mb-1 mt-2">
    <ul class="breadcrumb">
        <li><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="mx-1">/</li>
        <li class="active">Chats</li>
    </ul>
</div>
<main class="content">
    <div class="card">
        <div class="card-header">
            <div class="ProfileHader d-flex flex-wrap align-items-center">
                <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Chats</h3>
            </div>
        </div>
        <div class="row g-0">
            <div class="col-12 col-lg-5 col-xl-3 border-right">
                <div class="px-4 d-none d-md-block">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <input type="text" class="form-control my-3" placeholder="Search...">
                            <!--  <button type="button" onclick="fetchdata()">hit ajax</button>  -->
                        </div>
                    </div>
                </div>
                <div class="user-list">
                    @include('chat::users-list')
                </div>
                <hr class="d-block d-lg-none mt-1 mb-0">
            </div>
            @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif
            @if(request()->route('id'))
            <div class="col-12 col-lg-7 col-xl-9">
                <div class="py-2 px-4 border-bottom d-none d-lg-block">
                    <div class="d-flex align-items-center py-1">
                        <div class="position-relative">
                            <img src="{{url('public/uploads/'.App\Models\User::find(request()->route('id'))->image)}}" class="rounded-circle mr-1" alt="" width="40" height="40">
                        </div>
                        <span class="font-weight-bold mb-1">{{App\Models\User::find(request()->route('id'))->name}}</span>
                        <div class="flex-grow-1 pl-3">
                            <strong></strong>
                            <div class="text-muted small"><em></em></div>
                        </div>
                        <div>
                            <button class="btn btn-light border btn-lg px-3"><svg xmlns="" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal feather-lg">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                </svg></button>
                        </div>
                    </div>
                </div>
                @endif
                @if(request()->route('id'))
                <div class="position-relative">
                    <div class="chat-messages p-4" id="chat-messages">
                        @foreach($messages as $chats)

                        @if($chats->to_id == request()->route('id'))
                        <div class="chat-message-right pb-4 ">
                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3 ">
                                <div class="font-weight-bold mb-1 msg-chat-wrapper">
                                    {{$chats->message}}
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($chats->from_id == request()->route('id'))
                        <div class="chat-message-left pb-4 ">
                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                <div class="font-weight-bold mb-1 msg-chat-wrapper ">
                                    {{$chats->message}}
                                </div>
                            </div>

                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>

                <div class="flex-grow-0 py-3 px-4 border-top">
                    <div class="input-group">
                        <form class="input-group" id="frmSub">
                            <input id="message" type="text" name="message" class="form-control" placeholder="Type your message">
                            <button id="send" type="submit" class="btn btn-primary">Send</button>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</main>
<script>
    var SITEURL = "{{url('/')}}";
    var to_id = {
        {
            request() - > route('id')
        }
    };
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ url('/Modules/Chat/Public/chat.js') }}"></script>

@endsection