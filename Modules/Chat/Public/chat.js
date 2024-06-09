var message_html_send_from = `
<div class="chat-message-right pb-4">
    <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
        <div class="font-weight-bold mb-1">
                 replace_message_send_from
        </div>
    </div>
</div>
`; 
 
 $('#frmSub').on('submit', function(event) {
    event.preventDefault();
    message = $('#message').val();
    if ($('#message').val() == "") {
        alert('Please write message first');
    } else {
    	$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

        $.ajax({
            type: "POST",
            url: SITEURL+'/chat/send/'+to_id,
            data: {
                message: message,

            },
            success:function(data){
	           if(data.message){

		            var scroll_height = $('.chat-messages').height();
					var scroll_height = scroll_height + 1000;
					$('.chat-messages').animate({ scrollTop: scroll_height }, 1);
					
		            result = message_html_send_from.replace('replace_message_send_from', data.message);
				    $('#chat-messages').append(result);
				   
	           }
	           else {
		                result = message_html_send_file;
				        $('#chat-messages').append(result);
            } 
        });
        document.getElementById("frmSub").reset();
    }
});


var message_html_send_file = `
<div class="chat-message-right pb-4">
    <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">                                   
		<div class="font-weight-bold mb-1 msg-chat-wrapper">
		      <a><img  src="replace_image _send"  width="100px" height="100px"></a>  
		</div>                                                                   
   </div>
</div>  
`;

$('#OpenImgUpload').click(function(){
 $('#file').trigger('click'); 

  var fileupload = document.getElementById("file");
  var files = $('#file')[0].files;
        if(files.length > 0){
	
         var fd = new FormData(); 
         fd.append('file',files[0]);
          $.ajaxSetup({
                 headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
                      });
       // AJAX request 
         $.ajax({
           url: SITEURL+'/chat/send/'+to_id,
           type:"POST",
           data: fd,
           contentType: false,
           processData: false,
           dataType: 'json',
           success:function(data){

	            result = message_html_send_file.replace('replace_image _send',data.file);
				$('#chat-messages').append(result);
            } 
            
         });
      }
 
    });

    
var message_html = `
<div class="chat-message-left pb-4">
    <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                 replace_message_send_to
         </div>
    </div>
</div>
`; 
  
function fetchdata(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	$.ajax({
		url: SITEURL+'/chat/get-message/'+to_id,
	  	type: 'POST',
	  	data: {
	        'to_id' : to_id,
	    },
	    success: function (data) {
			if(data.message){
				
				var scroll_height = $('.chat-messages').height();
				var scroll_height = scroll_height + 1000;
				$('.chat-messages').animate({ scrollTop: scroll_height }, 1);
				
				result = message_html.replace('replace_message_send_to', data.message);
				$('#chat-messages').append(result);	
				
				}
				
	    }
             
     });
     }
   $(document).ready(function(){
	setInterval(fetchdata,2000);
}); 



	