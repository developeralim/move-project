 <!-- footer -->
 <footer class="footer">
     <div class="container">
         <div class="row">
             <!-- footer list -->
             <div class="col-12 col-md-3">
                 <h6 class="footer__title">Download Our App</h6>
                 <ul class="footer__app">
                     <li>
                         <a href="#">
                             <img src="{{ asset('assets/img/google-play-badge.png') }}" alt="">
                         </a>
                     </li>
                     <li>
                         <a href="#">
                             <img src="{{ asset('assets/img/Download_on_the_App_Store_Badge.svg') }}" alt="">
                         </a>
                     </li>
                 </ul>
             </div>
             <!-- end footer list -->
             <!-- footer list -->
             <div class="col-6 col-sm-4 col-md-3">
                 <h6 class="footer__title">Resources</h6>
                 <ul class="footer__list">
                     <li>
                         <a href="{{ route('about') }}">About Us</a>
                     </li>
                     <li>
                         <a href="{{ route('pricing') }}">Pricing Plan</a>
                     </li>
                     <li>
                         <a href="{{ route('help') }}">Help</a>
                     </li>
                 </ul>
             </div>
             <!-- end footer list -->
             <!-- footer list -->
             <div class="col-6 col-sm-4 col-md-3">
                 <h6 class="footer__title">Legal</h6>
                 <ul class="footer__list">
                     <li>
                         <a href="{{ route('terms') }}">Terms of Use</a>
                     </li>
                     <li>
                         <a href="{{ route('privecy') }}">Privacy Policy</a>
                     </li>
                     <li>
                         <a href="{{ route('contact') }}">Contact Us</a>
                     </li>
                 </ul>
             </div>
             <!-- end footer list -->
             <!-- footer list -->
             <div class="col-12 col-sm-4 col-md-3">
                 <h6 class="footer__title">Contact</h6>
                 <ul class="footer__list">
                     <li>
                         <a href="tel:{{ $admin_contact }}">{{ $admin_contact }}</a>
                     </li>
                     <li>
                         <a href="mailto:{{ $admin_email }}">{{ $admin_email }}</a>
                     </li>
                 </ul>

                 <ul class="footer__social">
                     @if ($social_links && !empty($social_links))
                         @foreach ($social_links as $link)
                             <li class="{{ $link['name'] }}">
                                 <a href="{{ $link['link'] }}">
                                     {!! $link['icon'] !!}
                                 </a>
                             </li>
                         @endforeach
                     @endif
                 </ul>
             </div>
             <!-- end footer list -->
             <!-- footer copyright -->
             <div class="col-12">
                 <div class="footer__copyright">
                     <small>
                         ©
                         <a href="{{ route('home') }}" style="color: #ff55a5;">Daag</a>
                         All right reserved.
                     </small>
                     <ul>
                         <li>
                             <a href="{{ route('privecy') }}">Privacy Policy</a>
                         </li>
                         <li>
                             <a href="{{ route('terms') }}">Terms & Condition</a>
                         </li>
                     </ul>
                 </div>
             </div>
             <!-- end footer copyright -->
         </div>
     </div>
 </footer>
 <!-- end footer -->
 <!-- JS -->
 <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
 <!-- slider js end -->
 <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
 <script src="{{ asset('assets/js/jquery.mousewheel.min.js') }}"></script>
 <script src="{{ asset('assets/js/jquery.mCustomScrollbar.min.js') }}"></script>
 <script src="{{ asset('assets/js/wNumb.js') }}"></script>
 <script src="{{ asset('assets/js/nouislider.min.js') }}"></script>
 <script src="{{ asset('assets/js/plyr.min.js') }}"></script>
 <script src="{{ asset('assets/js/jquery.morelines.min.js') }}"></script>
 <script src="{{ asset('assets/js/photoswipe.min.js') }}"></script>
 <script src="{{ asset('assets/js/photoswipe-ui-default.min.js') }}"></script>
 <script src="{{ asset('assets/js/main.js') }}"></script>
 {{-- video player --}}
 <script src="https://vjs.zencdn.net/7.20.3/video.min.js"></script>
 </body>

 </html>
