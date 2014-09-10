@extends('chat::layouts.public')

@section('content')
<br/><br/><br/><br/><br/><br/>
<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        <h2 class="text-center">Booking Appointment</h2>

        <div class="form-white">
            @include('chat::layouts.partials.message')

            {{ Form::open(array('url' => 'chat/booking', 'id' => 'booking-form')) }}

            <div class="form-group">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', null, array('class' => 'form-control', 'required', 'placeholder' => 'Enter Your Name')) }}
            </div>

            <div class="form-group">
                {{ Form::label('gender', 'Gender') }}
                <select class="form-control" name="gender" id="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>


            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>

            {{ Form::close(); }}
        </div>

    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Booking Confirmation</h4>
            </div>
            <div class="modal-body">
                There are no slots available for your gender but still available for opposite gender. Please choose opposite
                gender to follow or keep you gender and wait for next show.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Re-Choose Gender</button>
                <button type="button" class="btn btn-primary" onclick="continueBooking()">Continue</button>
            </div>
        </div>
    </div>
</div>

@section('footer')
@parent
<script>
    var checkedSlot = false;
    $(document).ready(function(){
      $('#booking-form').submit(function(){
          if(!checkedSlot){
              var gender = $('#gender').val();
              checkHaveSlots(gender);
              return false;
          }
      });
    })
    function checkHaveSlots(gender)
    {
        var url = '{{url('chat/check-have-slot')}}/' + gender
        $.get(url, function(data) {
            if(data == 'true'){
                //show dialog
                $('#myModal').modal();
            }else{
                checkedSlot = true;
                $('#booking-form').submit();
            }
        });
    }
    function continueBooking()
    {
        $('#myModal').modal('hide');
        checkedSlot = true;
        $('#booking-form').submit();
    }
</script>
@stop
@stop