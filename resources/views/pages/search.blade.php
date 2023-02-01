@extends('pages.layouts.main')
@section('title')
   Daag | Search {{$search}}
@endsection
@section('main')
      @if ( $movies )

            {{-- page title --}}
            <section class="section section--first section--bg" data-bg="assets/img/section/section.jpg">
                  <div class="container">
                        <div class="row">
                              <div class="col-12">
                                    <div class="section__wrap">
                                          {{-- section title --}}
                                          <h1 class="section__title">Search results for '{{$search}}'</h1>
                                          {{-- end section title --}}
                                          {{-- breadcrumb --}}
                                          <ul class="breadcrumb">
                                                <li class="breadcrumb__item">
                                                      <a href="index.html">Home</a>
                                                </li>
                                                <li class="breadcrumb__item breadcrumb__item--active">{{$search}}</li>
                                          </ul>
                                          {{-- end breadcrumb --}}
                                    </div>
                              </div>
                        </div>
                  </div>
            </section>
            {{-- end page title --}}
            {{-- filter --}}
            <div class="filter">
                  <div class="container">
                        <div class="row">
                              <div class="col-12">
                                    <form class="filter__content" method="GET" onsubmit="update_year_filtering()">
                                          <div class="filter__items">
                                                {{-- filter item --}}
                                                <div class="filter__item" id="filter__quality">
                                                      <span class="filter__item-label">QUALITY:</span>
                                                      <div
                                                            class="filter__item-btn dropdown-toggle"
                                                            role="navigation"
                                                            id="filter-quality"
                                                            data-toggle="dropdown"
                                                            aria-haspopup="true"
                                                            aria-expanded="false"
                                                      >
                                                            <input type="button" value="all">
                                                            <input type="hidden" name="quality">
                                                            <span></span>
                                                      </div>
                                                      <ul class="filter__item-menu dropdown-menu scrollbar-dropdown" aria-labelledby="filter-quality">
                                                            <li>all</li>
                                                            <li>1080</li>
                                                            <li>720</li>
                                                            <li>480</li>
                                                            <li>360</li>
                                                            <li>240</li>
                                                      </ul>
                                                </div>
                                                {{-- end filter item --}}
                                                {{-- filter item --}}
                                                <div class="filter__item" id="filter__year">
                                                      <span class="filter__item-label">RELEASE YEAR:</span>
                                                            <div
                                                                  class="filter__item-btn dropdown-toggle"
                                                                  role="button"
                                                                  id="filter-year"
                                                                  data-toggle="dropdown"
                                                                  aria-haspopup="true"
                                                                  aria-expanded="false"
                                                            >
                                                                  <div class="filter__range">
                                                                        <div id="filter__years-start">2000</div>
                                                                        <div id="filter__years-end">{{date('Y')}}</div>
                                                                  </div>
                                                                  <span></span>
                                                            </div>
                                                            <input type="hidden" name="year_filter_start">
                                                            <input type="hidden" name="year_filter_end">
                                                      <div class="filter__item-menu filter__item-menu--range dropdown-menu" aria-labelledby="filter-year">
                                                            <div id="filter__years"></div>
                                                      </div>
                                                </div>
                                                {{-- end filter item --}}
                                          </div>
                                          {{-- hidden search --}}
                                          <input type="hidden" name="search" value="{{$search}}">
                                          {{-- current page --}}
                                          <input type="hidden" name="page" value="{{$current_page}}">
                                          {{-- filter btn --}}
                                          <button class="filter__btn" type="submit">apply filter</button>
                                          {{-- end filter btn --}}
                                    </form>
                              </div>
                        </div>
                  </div>
            </div>
            {{-- end filter --}}
            {{-- catalog --}}
            <div class="catalog">
                  <div class="container">
                        <div class="row row--grid">
                              {{-- card --}}
                              @foreach ($movies as $_movie)
                                    <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                                          <div class="card">
                                                <a href="{{route('single',[$_movie['id'],$_movie['drive_id']])}}" class="card__cover">
                                                      <img src="{{$_movie['cover_photo']}}" alt="{{$_movie['name']}}">
                                                      <span class="card__play">
                                                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                            <path d="M18.54,9,8.88,3.46a3.42,3.42,0,0,0-5.13,3V17.58A3.42,3.42,0,0,0,7.17,21a3.43,3.43,0,0,0,1.71-.46L18.54,15a3.42,3.42,0,0,0,0-5.92Zm-1,4.19L7.88,18.81a1.44,1.44,0,0,1-1.42,0,1.42,1.42,0,0,1-.71-1.23V6.42a1.42,1.42,0,0,1,.71-1.23A1.51,1.51,0,0,1,7.17,5a1.54,1.54,0,0,1,.71.19l9.66,5.58a1.42,1.42,0,0,1,0,2.46Z"/>
                                                      </svg>
                                                      </span>
                                                </a>
                                                <div class="card__content">
                                                      <h3 class="card__title">
                                                      <a href="{{route('single',[$_movie['id'],$_movie['drive_id']])}}">
                                                            {{$_movie['name']}}
                                                      </a>
                                                      </h3>
                                                      <span class="card__category">
                                                            @foreach ($_movie['category'] as $_category)
                                                                  <a href="{{route('archive',[$_category->id,$_category->slug])}}">{{$_category->name}}</a>
                                                            @endforeach
                                                      </span>
                                                      <span class="card__rate">8.4</span>
                                                </div>
                                          </div>
                                    </div>
                              @endforeach
                              {{-- end card --}}
                        </div>
                        
                        <div class="row">
                              @if ($pagination)
                                    <!-- paginator -->
                                    <div class="col-12">
                                          <div class="paginator-wrap">                  
                                                <ul class="paginator">
                  
                                                      <li class="paginator__item paginator__item--prev {{$prev_disable == 'true' ? 'disabled' : ''}}">
                                                            <a href="{{request()->fullUrlWithQuery(['page' => $prev])}}">
                                                                  <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path d="M8.5,12.8l5.7,5.6c0.4,0.4,1,0.4,1.4,0c0,0,0,0,0,0c0.4-0.4,0.4-1,0-1.4l-4.9-5l4.9-5c0.4-0.4,0.4-1,0-1.4c-0.2-0.2-0.4-0.3-0.7-0.3c-0.3,0-0.5,0.1-0.7,0.3l-5.7,5.6C8.1,11.7,8.1,12.3,8.5,12.8C8.5,12.7,8.5,12.7,8.5,12.8z"></path></svg>
                                                            </a>
                                                      </li>
                  
                                                      @if ($prev != 1)
                                                            <li class="paginator__item">
                                                                  <a href="{{request()->fullUrlWithQuery(['page' => $prev])}}">{{$prev}}</a>
                                                            </li>
                                                      @endif
                  
                                                      <li class="paginator__item paginator__item--active">
                                                            <a href="{{request()->fullUrlWithQuery(['page' => $current_page])}}">{{$current_page}}</a>
                                                      </li>
                  
                                                      @if ($last_page != $current_page)
                                                            <li class="paginator__item">
                                                                  <a href="{{request()->fullUrlWithQuery(['page' => $next])}}">{{$next}}</a>
                                                            </li>
                                                      @endif
                                                     
                                                      <li class="paginator__item paginator__item--next {{$next_disable == true ? 'disabled' : ''}}">
                                                            <a href="{{request()->fullUrlWithQuery(['page' => $next])}}">
                                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15.54,11.29,9.88,5.64a1,1,0,0,0-1.42,0,1,1,0,0,0,0,1.41l4.95,5L8.46,17a1,1,0,0,0,0,1.41,1,1,0,0,0,.71.3,1,1,0,0,0,.71-.3l5.66-5.65A1,1,0,0,0,15.54,11.29Z"></path></svg>
                                                            </a>
                                                      </li>
                  
                                                </ul>
                                          </div>
                                    </div>
                                    <!-- end paginator -->
                              @endif
                        </div>
                  </div>
            </div>
            {{-- end catalog --}}

            <script>
                  function update_year_filtering() 
                  {
                        window.event.preventDefault();

                        const year_filter_start = document.querySelector('input[name="year_filter_start"]');
                        const year_filter_end = document.querySelector('input[name="year_filter_end"]');

                        const year_end = document.querySelector('#filter__years-end').innerHTML;
                        const year_start = document.querySelector('#filter__years-start').innerHTML;

                        year_filter_start.value = year_start;
                        year_filter_end.value = year_end;

                        // change quality value
                        const input_to_get_quality = document.querySelector("input[type='button']");
                        const input_to_update_quality = document.querySelector("input[type='hidden']");


                        input_to_get_quality.value = input_to_get_quality.value;


                        window.event.target.submit();
                  }
            </script>
      @else
            <div class="default" style="margin-top: 85px;display: flex;justify-content: center;align-items: center">
                  <h1>No Movies Found</h1>
            </div>
      @endif
@endsection 