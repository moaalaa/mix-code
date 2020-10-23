<!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-6 col-md-6 footer-info">
            <h3>MiX-CODE</h3>
            <p> is a team of professional web designers, web developers, web promoters , App developers and graphic designers, who have a thorough knowledge and expertise primarily in website design, development, mobile app ,promotion, hosting, SEO, graphics design, and many other sectors in the web.</p>
          </div>
 

          <div class="col-lg-6 col-md-6 footer-contact">
            <h4>Follow Us</h4>
 @php
   $settings = getSettings();
 @endphp
    
                    
            <div class="social-links">
               <a href="{{$settings->twitter}}" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="{{$settings->youtube}}" class="youtube"><i class="fa fa-youtube"></i></a>
              <a href="{{$settings->email}}" class="google-plus"><i class="fa fa-google-plus"></i></a>
              <a href="{{$settings->linkedin}}" class="linkedin"><i class="fa fa-linkedin"></i></a>
            </div>

          </div>
 
        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; {{ date('Y') }} {{ config('app.name') }}. All Rights Reserved.

        Powerd By -  <a href="http://www.mix-code.com" target="_blank"> MixCode  </a>
      </div>
     
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>