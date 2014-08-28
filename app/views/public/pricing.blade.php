@extends('layouts.public')

@section('content')

<div class="wrapper"> <!-- wrapper -->
<div class="container">
<div class="row">
    <div class="col-sm-8">
        <br>
        <h4>What We Clean</h4>
        <hr>
        <div class="row">
            <div class="col-sm-6">
                <h3>Kitchen</h3>
                <ul>
                    <li>Dust and wipe all surfaces</li>
                    <li>Clean the sink and wash the dishes</li>
                    <li>Clean the microwave and all appliances</li>
                    <li>Vacuum and/or mop floors</li>
                    <li>Removal of trash from bins and replace bin liners</li>
                    <li>Wipe kitchen surfaces, oven tops and knobs.</li>
                    <li>Clean outside of the fridge and oven</li>
                </ul>
            </div>
            <div class="col-sm-6">
                <h3>Bathrooms</h3>
                <ul>
                    <li>Dust and wipe surfaces</li>
                    <li>Clean the toilets</li>
                    <li>Clean showers and baths inside and out</li>
                    <li>Wipe inside of sinks to shining finish</li>
                    <li>Clean all mirrors and fixtures</li>
                    <li>Vacuum or mop floors</li>
                    <li>Removal of trash from bins and replace bin liners</li>
                    <li>Towels neatly hung</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <h3>Bedrooms and General Areas</h3>
                <ul>
                    <li>Dust and wipe surfaces</li>
                    <li>Clean mirrors and fixtures</li>
                    <li>Vacuum or mop floors</li>
                    <li>Removal of trash</li>
                    <li>Make the bed and change the sheets</li>
                    <li>Neatly fold any lose clothes</li>
                    <li>Wiping chairs and tables</li>
                </ul>
            </div>
            <div class="col-sm-6">
                <h3>What we can't do*</h3>
                <ul>
                    <li>Cleaning of exterior windows</li>
                    <li>Changing/wiping lightbulbs</li>
                    <li>Carpet cleaning</li>
                    <li>Animal waste removal</li>
                    <li>Gardening and garden shed cleaning</li>
                    <li>Patio cleaning</li>
                    <li>Mold removal</li>
                    <li>Industrial cleaning</li>
                    <li>The lifting of heavy furniture</li>
                    <li>Cleaning surfaces above arms reach</li>
                    <li>Inside oven or fridge unless explicitly requested</li>
                </ul>
                <p>*due to safety, insurance and other reasons.</p>
            </div>
        </div>
    </div>
    <!-- FAQ Categories -->
    <div class="col-sm-4">
        <br>
        <h4>About Us</h4>
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <p>MaidSavvy is NOT your typical Charlotte home cleaning company.
                    MaidSavvy is bringing cleaning services into the 21st century by building a company we
                    would want to do business with. We provide online booking, amazing
                    customer service, and awesome cleaning. We want to WOW you with outstanding treatment
                    and support every time we clean your home!</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 well">
                <h3>Check Your Zip Code</h3>
                <hr>
                <form class="form-inline" role="form" action="check_zip.php" method="post">
                    <div class="col-sm-12">
                        <div class="form-group" style="width:100%;">
                            <label class="sr-only" for="zipcode">Zip Code</label>
                            <input type="text" class="form-control" id="zipcode" name='zip' placeholder="Zip Code" maxlength="5" style="font-size:26px; height:52px;width:100%;">
                        </div>
                        <br>
                        <button class="btn btn-success btn-large" style="font-size:26px; width:100%; height:52px; margin-top:15px;" type="submit">Check!</button>
                        <hr>
                        <p>
                            View our available cleaning times, and even <b>schedule yourself entirely online!</b>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <!-- Contact Us form -->
    <div class="col-sm-12">
        <h2 class="text-center">Plans &amp; Pricing</h2>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="well">
            <div class="row">
                <div class="col-sm-4">
                    <i class="text-color fa fa-check-circle fa-3x pull-right" style="margin-top:5px;"></i>
                </div>
                <div class="col-sm-8">
                    <p>Monthly Service<br>
                        <span style="font-size:18px; font-weight:bold;">10% Discount</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="well">
            <div class="row">
                <div class="col-sm-4">
                    <i class="text-color fa fa-check-circle fa-3x pull-right" style="margin-top:5px;"></i>
                </div>
                <div class="col-sm-8">
                    <p>Bi-weekly Service<br>
                        <span style="font-size:18px; font-weight:bold;">15% Discount</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="well">
            <div class="row">
                <div class="col-sm-4">
                    <i class="text-color fa fa-check-circle fa-3x pull-right" style="margin-top:5px;"></i>
                </div>
                <div class="col-sm-8">
                    <p>Weekly Service<br>
                        <span style="font-size:18px; font-weight:bold;">15% Discount</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="pricing animated fadeInDown">
            <h3 class="text-center">Six Bedroom Home</h3>
            <div class="price">
                249
            </div>
            <div class="pricing-text text-muted">
                <div><i class="text-color fa fa-check"></i> Teams of 2 Members</div>
                <div><i class="text-color fa fa-check"></i> All supplies and green products</div>
                <div><i class="text-color fa fa-check"></i> Insurance against accidents</div>
                <div><i class="text-color fa fa-check"></i> 200% Satisfaction Guaranteed</div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="pricing animated fadeInDown delay1">
            <h3 class="text-center">Five Bedroom Home</h3>
            <div class="price">
                219
            </div>
            <div class="pricing-text text-muted">
                <div><i class="text-color fa fa-check"></i> Teams of 2 Members</div>
                <div><i class="text-color fa fa-check"></i> All supplies and green products</div>
                <div><i class="text-color fa fa-check"></i> Insurance against accidents</div>
                <div><i class="text-color fa fa-check"></i> 200% Satisfaction Guaranteed</div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="pricing animated fadeInDown delay2">
            <h3 class="text-center">Four Bedroom Home</h3>
            <div class="price">
                189
            </div>
            <div class="pricing-text text-muted">
                <div><i class="text-color fa fa-check"></i> Teams of 2 Members</div>
                <div><i class="text-color fa fa-check"></i> All supplies and green products</div>
                <div><i class="text-color fa fa-check"></i> Insurance against accidents</div>
                <div><i class="text-color fa fa-check"></i> 200% Satisfaction Guaranteed</div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 text-center">
        <h2>Book a house cleaning in 60 seconds</h2>
    </div>
    <form class="form-inline" role="form" action="check_zip.php" method="post">
        <div class="col-sm-3 col-sm-offset-3">
            <div class="form-group" style="width:100%;">
                <label class="sr-only" for="zipcode">Zip Code</label>
                <input type="text" class="form-control" id="zipcode" name='zip' placeholder="Zip Code" maxlength="5" style="font-size:32px; height:60px;width: 100%;">
            </div>
        </div>
        <div class="col-sm-3">
            <button class="btn btn-success btn-large" style="font-size:32px; width:100%; height:60px;" type="submit">Check!</button>
        </div>
    </form>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="pricing animated fadeInDown delay3">
            <h3 class="text-center">Three Bedroom Apt.</h3>
            <div class="price">
                159
            </div>
            <div class="pricing-text text-muted">
                <div><i class="text-color fa fa-check"></i> Teams of 2 Members</div>
                <div><i class="text-color fa fa-check"></i> All supplies and green products</div>
                <div><i class="text-color fa fa-check"></i> Insurance against accidents</div>
                <div><i class="text-color fa fa-check"></i> 200% Satisfaction Guaranteed</div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="pricing animated fadeInDown delay4">
            <h3 class="text-center">Two Bedroom Apt.</h3>
            <div class="price">
                139
            </div>
            <div class="pricing-text text-muted">
                <div><i class="text-color fa fa-check"></i> Teams of 2 Members</div>
                <div><i class="text-color fa fa-check"></i> All supplies and green products</div>
                <div><i class="text-color fa fa-check"></i> Insurance against accidents</div>
                <div><i class="text-color fa fa-check"></i> 200% Satisfaction Guaranteed</div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="pricing animated fadeInDown delay5">
            <h3 class="text-center">One Bedroom/Studio</h3>
            <div class="price">
                119
            </div>
            <div class="pricing-text text-muted">
                <div><i class="text-color fa fa-check"></i> Teams of 2 Members</div>
                <div><i class="text-color fa fa-check"></i> All supplies and green products</div>
                <div><i class="text-color fa fa-check"></i> Insurance against accidents</div>
                <div><i class="text-color fa fa-check"></i> 200% Satisfaction Guaranteed</div>
            </div>
        </div>
    </div>
</div>
<br>
</div>
</div> <!-- / wrapper -->


@stop