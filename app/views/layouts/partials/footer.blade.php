@section('footer')
<div class="footer-wrapper"> <!-- footer wrapper -->
    <div class="container">
        <footer class="footer-main">
            <ul class="list-inline pull-left">
                <li><a href="{{url('pricing')}}">About Us</a></li>
                <li><a href="{{url('privacy-policy')}}">Privacy Policy</a></li>
                <li><a href="{{url('terms')}}">Terms and Conditions</a></li>
                <li><a href="{{url('contact-us')}}">Contact Us</a></li>
            </ul>
            <span class="pull-right-xs text-muted">&copy; 2014 MaidSavvy</span>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-sm-12">
                    <h3>Cities We Serve</h3>
                    <p>Charlotte, NC; Fort Mill, SC; Concord, NC; Indian Trail, NC; Huntersville, NC; Mount Holly, NC; Matthews, NC;
                        Cornelius, NC; Davidson, NC; Gastonia, NC; Kannapolis, NC </p>
                    <p>Uptown; Myers Park; Ballantyne; South End; Dilworth; NoDa; Plaza-Midwood; Sherwood Forest; Eastland; Marvin, Stonecrest, Blakeney, and Waxhaw,
                    </p>
                </div>
            </div>
        </footer>
    </div> <!-- /container -->
</div> <!-- / footer wrapper -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
{{ HTML::script('assets/bootstrap/js/jquery.min.js') }}
{{ HTML::script('assets/bootstrap/js/bootstrap.min.js') }}
{{ HTML::script('js/custom.js') }}
{{ HTML::script('js/scrolltopcontrol.js') }}
@show