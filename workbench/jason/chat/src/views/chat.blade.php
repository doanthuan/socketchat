@extends('chat::layouts.public')

@section('content')


<div class="chat-window" id="chat-window"></div>

<input type="text" id="input-chat" name="input" class="form-control" placeholder="Type here...">

@section('footer')
@parent
<script>
    var conn = new WebSocket('ws://localhost:8080');
    conn.onopen = function(e) {
        console.log("Connection established!");
    };

    conn.onmessage = function(e) {
        var messages = $('#chat-window').text();
        messages += e.data + '\n';
        $('#chat-window').text(messages);
    };
    $(document).ready(function(){
       $('#input-chat').keypress(function(e){
           if(e.which == 13) {
               var message = $('#input-chat').val();
               $('#input-chat').val('')
               conn.send(message);
           }
       });
    });
</script>
@stop
@stop