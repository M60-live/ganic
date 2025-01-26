<!-- Footer -->
<footer class="footer">
    <div class="footer_content">
        <div class="container">
            <div class="row">

              <!-- Footer Contact -->
              <div class="flex-row col-lg-4 footer_col">
                <div class="footer_contact">
                  {{--<div class="footer_title">Stay in Touch</div>
                  <div class="newsletter">
                      <form action="#" id="newsletter_form" class="newsletter_form">
                          <input type="email" class="newsletter_input" placeholder="Subscribe to our Newsletter" required="required">
                          <button class="newsletter_button">+</button>
                      </form>
                  </div>--}}
                  <div class="">
                    <div class="footer_title">Follow us</div>
                    <ul class="footer_social_list d-flex flex-row align-items-start justify-content-start menu-list">
                        <li><a href="https://www.instagram.com/ganic_roots" target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="https://www.facebook.com/ganic.roots" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                        <li><a href="https://www.tiktok.com/@ganicrootssa"><i class="fab fa-tiktok"></i></a></li>
                    </ul>
                  </div>
                </div>
              </div>

              <!-- About -->
              <div class="flex-row col-lg-4 footer_col">
                <div class="footer_menu">
                  <div class="footer_title" style="padding-left: 55px;"><img src="/img/logo2_main_square.png" class="img-responsive" style="max-width: 180px;"/></div>
                  {{--<div class="footer_title">Our Promise</div>--}}
                  <div class="footer_about_text">
                    <p>Proudly South African handmade skin and hair products. Hypoallergenic and made in small batches.</p>
                  </div>
                </div>
              </div>

              <!-- Footer Links -->
              <div class="col-lg-4 footer_col">
                <div class="footer_menu">
                  <div class="footer_title">Support</div>
                  <ul class="footer_list menu-list">
                    {{--<li>
                      <a href="#"><div>Customer Service</div></a>
                    </li>--}}
                    <li>
                      <a href="/contact_form"><i class="fa fa-chevron-right mr-2" style="color: #969696; font-size: 12px;"></i>Contact Us</a>
                    </li>
                    <li>
                      <a href="/faqs"><i class="fa fa-chevron-right mr-2" style="color: #969696; font-size: 12px;"></i>FAQ's</a>
                    </li>
                  </ul>
                </div>
              </div>

            </div>
        </div>
    </div>
    <div class="footer_bar">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="footer_bar_content d-flex flex-md-row flex-column align-items-center justify-content-start">
                        <div class="copyright order-md-1 order-2">
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved - developed by <a href="https://www.alphatobeta.co.za" target="_blank" class="">Alpha to beta Systems</a>
                        </div>
                        <nav class="footer_nav ml-md-auto order-md-2 order-1">
                            <ul class="d-flex flex-row align-items-center justify-content-start menu-list">
                                @foreach($categories as $category)
                                    <li><a href="/products/category/{{ $category->id }}">{{ $category->value }}</a></li>
                                @endforeach
                                <li><a href="/contact_form">Contact Us</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
