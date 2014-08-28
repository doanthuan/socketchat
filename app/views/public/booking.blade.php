@extends('layouts.public')

@section('head')
@parent

{{ HTML::style('assets/bootstrap/css/bootstrap-datetimepicker.css') }}
{{ HTML::style('assets/bootstrap-validator/css/bootstrapValidator.min.css') }}
{{ HTML::style('css/styles.css') }}
@stop

@section('content')


<div class="wrapper"> <!-- wrapper -->
    <div class="house-bg">
        <div class="house-bg-inside">
            <div class="container"> <!-- container -->
                <div class="col-sm-12">
                    <div class="row text-center text-white">
                        <h1>YOU’RE 60 SECONDS AWAY FROM AWESOME CLEANING!</h1>
                        <br>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="crp-ft">
                                    <i class="text-color fa fa-calendar fa-3x"></i>
                                    <h4>Choose Your Date &amp; Time</h4>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="crp-ft">
                                    <i class="text-color fa fa-lock fa-3x"></i>
                                    <h4>Pay securely online</h4>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="crp-ft">
                                    <i class="text-color fa fa-ban fa-3x"></i>
                                    <h4>No contracts, cancel anytime</h4>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="crp-ft">
                                    <i class="text-color fa fa-smile-o fa-3x"></i>
                                    <h4>No upsells or hidden pricing</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row text-center">
            <h2>Our 200% Money Back Guarantee</h2>
            <p>If you’re not happy, we come back and re-clean and if you still don’t think we did a good enough job to recommend us we issue a full refund!</p>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-10">
                <div class="row text-center">
                    <?php if(!empty($_SESSION['error_zip'])) { echo "<p style='color: red;'>". $_SESSION['error_zip'] . "</p>"; }  ?>
                </div>

                <div class="form-wrapper">
                {{ Form::open(array('method' => 'post', 'url' => '/book-appointment', 'class' => 'form-horizontal', 'id' => 'book-form')) }}

                <div class="form-group">
                    <div class="col-sm-4"><h3>STEP 1: WHO YOU ARE</h3></div>
                    <div class="col-sm-8"><div class="form-step-heading"></div></div>
                </div>

                <div class="form-group">
                    {{ Form::label('fname', 'First name', array('class' => 'col-sm-4 control-label')) }}
                    <div class="col-sm-8">
                        {{ Form::text('first_name', Input::old('first_name'), array('class' => 'form-control', 'required')) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('last_name', 'Last Name', array('class' => 'col-sm-4 control-label')) }}
                    <div class="col-sm-8">
                        {{ Form::text('last_name', Input::old('last_name'), array('class' => 'form-control', 'required')) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('email', 'Email', array('class' => 'col-sm-4 control-label')) }}
                    <div class="col-sm-8">
                        {{ Form::text('email', Input::old('email'), array('class' => 'form-control', 'required')) }}
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('phone', 'Phone', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-8">
                        {{Form::text('phone', Input::old('phone'), array('class' => 'form-control', 'required'))}}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-4"><h3>STEP 2: YOUR HOME</h3></div>
                    <div class="col-sm-8"><div class="form-step-heading"></div></div>
                </div>

                <div class="form-group">
                    {{Form::label('address', 'Address', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-8">
                        {{Form::text('address', Input::old('address'), array('class' => 'form-control', 'required'))}}
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('city', 'City', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-8">
                        {{Form::text('city', Input::old('city'), array('class' => 'form-control','required'))}}
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('state', 'State', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-8">
                        {{Form::select('state', $stateList, null, array('class' => 'form-control') ) }}
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('zipcode', 'Zip Code', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-8">
                        {{Form::text('zipcode', Input::old('zipcode'), array('class' => 'form-control', 'required'))}}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-4"><h3>STEP 3: YOUR SERVICE</h3></div>
                    <div class="col-sm-8"><div class="form-step-heading"></div></div>
                </div>

                <div class="form-group">
                    {{Form::label('service_type', 'Type of Service', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-8">
                        {{Form::select('service_type', array(
                        '1:119' => 'One Bedroom Apt: $119 Flat rate',
                        '2:139' => 'Two Bedroom Apt: $139 Flat rate',
                        '3:159' => 'Three Bedroom Townhome or SF Home: $159 Flat rate',
                        '4:189' => 'Four Bedroom Home: $189 Flat rate',
                        '5:219' => 'Five Bedroom Home: $219 Flat rate',
                        '6:249' => 'Six Bedroom Home: $249 Flat rate',
                        ),
                        Input::old('service_type'), array('class' => 'form-control'))}}
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('take_time', 'Date/Time', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-8">
                        <div class="input-group date" id="datetimepicker1">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            {{Form::text('take_time', null, array('class' => 'form-control', 'required'))}}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('service_frequency', 'Frequency of Service', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-8">
                        {{Form::select('service_type', array(
                        '1' => 'One time cleaning',
                        '2' => 'Weekly cleaning - 15.0%',
                        '3' => 'Bi-weekly cleaning - 15.0%',
                        '4' => 'Tri-weekly - 10.0%',
                        '5' => 'Monthly cleaning - 10.0%',
                        ),
                        Input::old('service_frequency'), array('class' => 'form-control'))}}
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('discount_code', 'Discount Code', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-8">
                        {{Form::text('discount_code', Input::old('discount_code'), array('class' => 'form-control'))}}
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-4"><h3>STEP 4: EXTRAS</h3></div>
                    <div class="col-sm-8"><div class="form-step-heading"></div></div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="extras" value="20"> Clean Inside cabinets +$20
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-offset-4 col-sm-8">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="extras" value="20"> Clean Inside the Fridge +$20
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-offset-4 col-sm-8">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="extras" value="20"> Clean Inside the Oven +$20
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-offset-4 col-sm-8">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="extras" value="60"> Clean Interior windows +$60
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-offset-4 col-sm-8">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="extras" value="60"> Finished Basement Apartment +60
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-offset-4 col-sm-8">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="extras" value="60"> Move-in/Move-out cleaning +$60
                                (Refrigerator Included)
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-offset-4 col-sm-8">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="extras" value="60"> One hour of organizing +$60
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-offset-4 col-sm-8">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="extras" value="20"> One Load of laundry +$20
                            </label>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-4"><h3>STEP 5: SELECT PAYMENT</h3></div>
                    <div class="col-sm-8"><div class="form-step-heading"></div></div>
                </div>

                <div class="form-group">
                    {{Form::label('total', 'Total Amount', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-8">
                        <div id="total-amount" style="margin-top: 5px;"></div>
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('card_number', 'Card Number', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-8">
                        {{Form::text('card_number', null, array('class' => 'form-control','required'))}}
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('card_cvc', 'Card CVC', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-8">
                        {{Form::text('card_cvc', null, array('class' => 'form-control','required'))}}
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('expires_on', 'Expires on', array('class' => 'col-sm-4 control-label'))}}
                    <div class="col-sm-3">
                        {{Form::select('card-expiry-month', array(
                        '1' => '01 - January',
                        '2' => '02 - February',
                        '3' => '03 - March',
                        '4' => '04 - April',
                        '5' => '05 - May',
                        '6' => '06 - Jun',
                        '7' => '07 - Jul',
                        '8' => '08 - Aug',
                        '9' => '09 - Sep',
                        '10' => '10 - Oct',
                        '11' => '11 - Nov',
                        '12' => '12 - Dec',
                        ),
                        null, array('class' => 'form-control'))}}
                    </div>
                    <div class="col-sm-2">
                        {{Form::select('card-expiry-year', array(
                        '2014' => '2014',
                        '2015' => '2015',
                        '2016' => '2016',
                        '2017' => '2017',
                        '2018' => '2018',
                        '2019' => '2019',
                        '2020' => '2020',
                        '2021' => '2021',
                        '2022' => '2022',
                        '2023' => '2023',
                        '2024' => '2024',
                        ),
                        null, array('class' => 'form-control'))}}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-4"><h3>WHAT HAPPENS NEXT?</h3></div>
                    <div class="col-sm-8"><div class="form-step-heading"></div></div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        Don't worry, you won't be billed until the day of service and you will receive an email receipt instantly. We no longer accept cash or checks.
                    </div>
                </div>

                <br/><br/>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-dark btn-xlarge">BOOK APPOINTMENT</button>
                    </div>
                </div>
                {{ Form::close() }}

                </div>
            </div>
            <div class="col-sm-2">
                <div class="row text-center">
                    <div class="crp-ft">
                        <i class="text-color fa fa-check fa-3x"></i>
                        <h4>Insured Services</h4>
                        <p>You're in good company when you choose Maids in Black. Rest assured that we are fully insured.</p>
                    </div>
                    <div class="crp-ft">
                        <i class="text-color fa fa-smile-o fa-3x"></i>
                        <h4>Friendly Service</h4>
                        <p>Fast and friendly customer service folks. Our average response time for emails is now 14 minutes.</p>
                    </div>
                    <div class="crp-ft">
                        <i class="text-color fa fa-leaf fa-3x"></i>
                        <h4>We Provide Supplies</h4>
                        <p>We got this! Our team partners bring their own supplies and vacuum and honor special requests.</p>
                    </div>
                    <div class="crp-ft">
                        <i class="text-color fa fa-rocket fa-3x"></i>
                        <h4>Speedy Confirmation</h4>
                        <p>Book and receive a confirmation within 30 minutes during normal booking hours from 8:30am to midnight!</p>
                    </div>
                    <div class="crp-ft">
                        <i class="text-color fa fa-shopping-cart fa-3x"></i>
                        <h4>Safe Shopping Guarantee</h4>
                        <p>You'll pay nothing if unauthorized charges are made to your credit card as a result of booking with us.</p>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

@section('footer')
@parent
{{ HTML::script('assets/bootstrap/js/moment.js') }}
{{ HTML::script('assets/bootstrap/js/bootstrap-datetimepicker.js') }}
{{ HTML::script('assets/bootstrap-validator/js/bootstrapValidator.min.js') }}
<script>
    $(document).ready(function() {
        $('#book-form').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                first_name: {
                    message: 'First name is not valid',
                    validators: {
                        notEmpty: {
                            message: 'First name is required and cannot be empty'
                        },
                        stringLength: {
                            min: 2,
                            max: 30,
                            message: 'First name must be more than 2 and less than 30 characters long'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_]+$/,
                            message: 'Last name can only consist of alphabetical, number and underscore'
                        }
                    }
                },
                last_name: {
                    message: 'Last name is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Last name is required and cannot be empty'
                        },
                        stringLength: {
                            min: 2,
                            max: 30,
                            message: 'Last name must be more than 2 and less than 30 characters long'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_]+$/,
                            message: 'Last name can only consist of alphabetical, number and underscore'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'The email is required and cannot be empty'
                        },
                        emailAddress: {
                            message: 'The input is not a valid email address'
                        }
                    }
                },
                phone: {
                    validators: {
                        notEmpty: {
                            message: 'Phone is required and cannot be empty'
                        },
                        phone: {
                            country: 'US',
                            message: 'The input is not a valid phone'
                        }
                    }
                },
                zipcode: {
                    validators: {
                        notEmpty: {
                            message: 'The zip code is required and cannot be empty'
                        },
                        zipCode: {
                            country: 'US',
                            message: 'The input is not a valid zip code'
                        }
                    }
                }
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datetimepicker1').datetimepicker();

        $('.required')              .closest(".form-group").find("label").append("<i class='glyphicon-asterisk'></i>");
        $('[required="required"]')  .closest(".form-group").find("label").append("<i class='glyphicon-asterisk'></i>");


        $('#service_type').change(function(){
            calTotalAmount();
        })

        $('input:checkbox[name="extras"]').click(function(){
            calTotalAmount();
        });

        calTotalAmount();
    });

    function calTotalAmount()
    {
        var totalAmount = 0;

        var serviceType = $('#service_type').val();
        var serviceValues = serviceType.split(':');
        totalAmount = parseInt(serviceValues[1]);

        $('input:checkbox[name="extras"]:checked').each(function(){
            totalAmount += parseInt($(this).val());
        })

        $('#total-amount').text('$'+totalAmount);
    }


</script>
@stop

@stop