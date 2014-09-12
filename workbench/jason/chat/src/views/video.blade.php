@extends('chat::layouts.public')

@section('content')

<video width="800" height="600" autoplay >
    <source src="{{url('packages/jason/chat/videos/mov_bbb.mp4')}}" type="video/mp4">
    Your browser does not support the video tag.
</video>
{{ Form::open(array('url' => 'chat/chat', 'id' => 'video-form')) }}
{{ Form::close()}}
@section('footer')
@parent
<script>
$("video").bind("ended", function() {
    //redirect to chat page
    $('#video-form').submit();
});
</script>
@stop
@stop