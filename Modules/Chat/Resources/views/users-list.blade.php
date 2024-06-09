@foreach($userlist as $chats)
<a onclick="" id="fetch-data" data-url="{{url('chat/show/'.$chats->id)}}" href="{{url('chat/show/'.$chats->id)}}" class="list-group-item list-group-item-action border-0">
<div class="badge bg-success float-right"></div>
<div class="d-flex align-items-start">
    <img src="{{url('public/uploads/'.$chats->image)}}" class="rounded-circle mr-1" alt="" width="40" height="40">
    <div class="flex-grow-1 ml-3">
        {{$chats->name}}
<!--<div class="small"><span class="fas fa-circle chat-offline"></span> offline</div> -->
        </div>
    </div>
</a>
@endforeach