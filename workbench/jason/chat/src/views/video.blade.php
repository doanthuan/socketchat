@extends('chat::layouts.public')

@section('content')

<video width="800" height="600" autoplay >
    <source src="{{url('packages/jason/chat/videos/mov_bbb.mp4')}}" type="video/mp4">
    Your browser does not support the video tag.
</video>

@section('footer')
@parent
<script>
$("video").bind("ended", function() {
    //redirect to chat page
    window.location = '{{url('chat/chat')}}';
});
</script>
@stop
@stop