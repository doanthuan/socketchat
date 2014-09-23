@extends('chat::layouts.public')

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div id="main">
            <div class="content">
                <div class="counter">
                    <h3>Estimated Time Remaining Before Launch:</h3>
                    <div id="countdown">

                    </div><!-- /#Countdown Div -->
                </div> <!-- /.Counter Div -->
            </div> <!-- /.Content Div -->
        </div> <!-- /#Main Div -->
    </div> <!-- /.Columns Div -->
</div> <!-- /.Row Div -->
{{ Form::open(array('url' => 'chat/video', 'id' => 'reminder-form')) }}
{{ Form::close()}}
@section('footer')
@parent
<script>
    // set the date we're counting down to
    function startTimer()
    {
        var target_date = new Date('{{$showTime}}').getTime();
        var current_date = new Date('{{$currentTime}}').getTime();

        // variables for time units
        var days, hours, minutes, seconds;

        // get tag element
        var countdown = document.getElementById('countdown');

        var seconds_left = (target_date - current_date) / 1000;

        // update the tag with id "countdown" every 1 second
        var refreshIntervalId = setInterval(function () {

            // find the amount of "seconds" between now and target
            seconds_left--;

            // do some time calculations
            days = parseInt(seconds_left / 86400);
            seconds_left = seconds_left % 86400;

            hours = parseInt(seconds_left / 3600);
            seconds_left = seconds_left % 3600;

            minutes = parseInt(seconds_left / 60);
            seconds = parseInt(seconds_left % 60);

            // format countdown string + set tag value
            countdown.innerHTML = '<span class="hours">' + hours + ' <b>Hours</b></span> <span class="minutes">'
                + minutes + ' <b>Minutes</b></span> <span class="seconds">' + seconds + ' <b>Seconds</b></span>';

            if(hours <= 0 && minutes <= 0 && seconds <= 0){
                //redirect to video show
                //window.location = '{{url('chat/video')}}';
                clearInterval(refreshIntervalId);
                countdown.innerHTML = '<h1>Waiting video show from server...</h1>';
            }

        }, 1000);
    }

</script>
<script src="http://autobahn.s3.amazonaws.com/js/autobahn.min.js"></script>
<script>
    var connected = false;
    var queueNumber = {{$queue_number}};
    var channelId = 'video_{{$queue_number}}';

    connectChat();
    function connectChat()
    {
        var conn = new ab.Session('ws://{{$server}}:19888',
            function() {
                conn.subscribe(channelId, function(topic, data) {
                    countdown.innerHTML = '<h1>Video is starting...</h1>';
                    $('#reminder-form').submit();
                });

                console.log("Connection established!");
                connected = true;
                startTimer();

//                function add2(args) {
//                    return args[0] + args[1];
//                }
//                conn.register('com.myapp.add2', add2);

                conn.call(channelId, '{{$userId}}').then(
                    function (res) {

                    }
                );
            },
            function() {
                console.warn('WebSocket connection closed');
                if(!connected){
                    alert('Can not connect to socket server');
                }
            },
            {'skipSubprotocolCheck': true}
        );
    }

</script>

@stop
@stop