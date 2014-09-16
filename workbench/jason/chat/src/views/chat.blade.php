@extends('chat::layouts.public')

@section('content')


<div class="chat-window" id="chat-window"></div>

<input type="text" id="input-chat" name="input" class="form-control" placeholder="Type here...">

{{ Form::open(array('url' => 'chat/finish', 'id' => 'finish-form')) }}
{{ Form::close()}}

@section('footer')
@parent
<script src="http://autobahn.s3.amazonaws.com/js/autobahn.min.js"></script>
<script>
    var channelId = '{{$channelId}}';

    if(channelId == ''){
        alert('Could not find a partner for you.');
        window.location = '{{url('chat')}}';
    }

    var username = '{{$username}}';
    var conn = new ab.Session('ws://{{$server}}:19888',
        function() {
            conn.subscribe(channelId, function(topic, data) {
                console.log(data);
                if(data == 'end-chat'){
                    alert('Terminate chat application');
                    $('#finish-form').submit();
                    return false;
                }

                var messages = $('#chat-window').html();
                var dataArr = data[0].split(":");
                var className = 'comment';
                if(dataArr[1] == username){
                    className += ' mine';
                }

                var msgRow =
                '<div class="'+className+'">' +
                    '<h2>'+dataArr[1]+'</h2>' +
                    '<p>'+dataArr[0]+'</p>' +
                '</div>';
                $('#chat-window').html(messages + msgRow);
            });
        },
        function() {
            console.warn('WebSocket connection closed');
        },
        {'skipSubprotocolCheck': true}
    );

    $(document).ready(function(){
        $('#input-chat').keypress(function(e){
            if(e.which == 13) {
                var message = $('#input-chat').val();
                message += ':'+username;
                $('#input-chat').val('')
                conn.publish(channelId, [message]);
            }
        });
    });
</script>

@stop
@stop