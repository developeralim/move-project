@if ($loading)
    <!-- slider -->
      <div class="preloader">
            <div class="preloader-after"></div>
            <div class="preloader-before"></div>
            <div class="preloader-block">
            <div class="title">{{$loading_txt}}</div>
            <div class="percent">0</div>
                  <div class="loading">loading...</div>
            </div>
            <div class="preloader-bar">
                  <div class="preloader-progress"></div>
            </div>
      </div>
@endif