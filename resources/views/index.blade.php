@extends('layouts.app')


@section('content')

<!-- ======= Intro Section ======= -->
@include('layouts.includes._intro')
<!-- ======= Intro Section ======= -->
<main id="main">

  <!-- ======= About Section ======= -->
  @include('layouts.includes._about')
  <!-- End About Section -->

  <!-- ======= Services Section ======= -->
  @include('layouts.includes._services')
  <!-- End Services Section -->

  <!-- ======= Why Us Section ======= -->
  @include('layouts.includes._why_us')
  <!-- End Why Us Section -->

  <!-- ======= Portfolio Section ======= -->
  @include('layouts.includes._portfolio')  
  <!-- End Portfolio Section -->

  <!-- ======= Testimonials Section ======= -->
  <!-- <section id="testimonials" class="section-bg">
      <div class="container" data-aso="zoom-in">

        <header class="section-header">
          <h3>Testimonials</h3>
        </header>

        <div class="row justify-content-center">
          <div class="col-lg-8">

            <div class="owl-carousel testimonials-carousel">

              <div class="testimonial-item">
                <img src="{{ asset('/assets/img/testimonial-1.jpg') }} " class="testimonial-img" alt="">
                <h3>Saul Goodman</h3>
                <h4>Ceo &amp; Founder</h4>
                <p>
                  Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                </p>
              </div>

              <div class="testimonial-item">
                <img src="{{ asset('/assets/img/testimonial-2.jpg') }} " class="testimonial-img" alt="">
                <h3>Sara Wilsson</h3>
                <h4>Designer</h4>
                <p>
                  Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                </p>
              </div>

              <div class="testimonial-item">
                <img src="{{ asset('/assets/img/testimonial-3.jpg') }} " class="testimonial-img" alt="">
                <h3>Jena Karlis</h3>
                <h4>Store Owner</h4>
                <p>
                  Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                </p>
              </div>

              <div class="testimonial-item">
                <img src="{{ asset('/assets/img/testimonial-4.jpg') }} " class="testimonial-img" alt="">
                <h3>Matt Brandon</h3>
                <h4>Freelancer</h4>
                <p>
                  Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
                </p>
              </div>

              <div class="testimonial-item">
                <img src="{{ asset('/assets/img/testimonial-5.jpg') }} " class="testimonial-img" alt="">
                <h3>John Larson</h3>
                <h4>Entrepreneur</h4>
                <p>
                  Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
                </p>
              </div>

            </div>

          </div>
        </div>

      </div>
    </section> -->
  <!-- End Testimonials Section -->

  <!-- ======= Team Section ======= -->
  <section id="team">
    <div class="container" data-aos="fade-up">
      <div class="section-header">
        <h3>@lang('site.team_leaders')</h3>
      </div>

      <div class="row">

        <div class="col-lg-6 col-md-6" data-aos="zoom-out" data-aos-delay="100">
          <div class="member">
            <img src="{{ asset('/assets/img/hamza-1.jpg') }} " class="img-fluid team-image" alt="">
            <div class="member-info">
              <div class="member-info-content">
                <h4>Hamza Omar</h4>
                <span>Team Leader and business consultant</span>
                <div class="social">
                  <a href=""><i class="fa fa-twitter"></i></a>
                  <a href=""><i class="fa fa-facebook"></i></a>
                  <a href=""><i class="fa fa-google-plus"></i></a>
                  <a href=""><i class="fa fa-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-6" data-aos="zoom-out" data-aos-delay="200">
          <div class="member">
            <img src="{{ asset('/assets/img/alaa-1.jpg') }} " class="img-fluid  team-image" alt="">
            <div class="member-info">
              <div class="member-info-content">
                <h4>Mohammed Alaa Eldin</h4>
                <span>Projects Manager And Technical Head</span>
                <div class="social">
                  <a href=""><i class="fa fa-twitter"></i></a>
                  <a href=""><i class="fa fa-facebook"></i></a>
                  <a href=""><i class="fa fa-google-plus"></i></a>
                  <a href=""><i class="fa fa-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
  
      </div>

    </div>
  </section><!-- End Team Section -->

  <!-- ======= Clients Section ======= -->
    @include('layouts.includes._clients')
  <!-- End Clients Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact">
    <div class="container-fluid" data-aos="fade-up">

      <div class="section-header">
        <h3>@lang('site.contact_us')</h3>
      </div>

      <div class="row">


        <div class="col-lg-12">
          <div class="row">

            <div class="col-md-6 info">
              <i class="ion-ios-email-outline"></i>
              <p>info@mix-code.com</p>
            </div>
            <div class="col-md-6 info">
              <i class="ion-ios-telephone-outline"></i>
              <p>+201092462941</p>
            </div>
          </div>

          <div class="form">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="form-row">
                <div class="form-group col-lg-6">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                    data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                <div class="form-group col-lg-6">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email"
                    data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject"
                  data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required"
                  data-msg="Please write something for us" placeholder="Message"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit" title="Send Message">Send Message</button></div>
            </form>
          </div>
        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->

</main><!-- End #main -->

@endsection