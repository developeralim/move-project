@if (!empty($movie))
    <!-- home -->
    <section class="home home--bg">
        <div class="container">
            @foreach ($movie as $category => $_movie)
                <div class="row mt-5">
                    <div class="col-12">
                        <h1 class="home__title">
                            <u>{{ $category }}</u>
                        </h1>
                        <button class="home__nav home__nav--prev" aria-label="prev card" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M17,11H9.41l3.3-3.29a1,1,0,1,0-1.42-1.42l-5,5a1,1,0,0,0-.21.33,1,1,0,0,0,0,.76,1,1,0,0,0,.21.33l5,5a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42L9.41,13H17a1,1,0,0,0,0-2Z" />
                            </svg>
                        </button>
                        <button class="home__nav home__nav--next" aria-label="next card" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M17.92,11.62a1,1,0,0,0-.21-.33l-5-5a1,1,0,0,0-1.42,1.42L14.59,11H7a1,1,0,0,0,0,2h7.59l-3.3,3.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0l5-5a1,1,0,0,0,.21-.33A1,1,0,0,0,17.92,11.62Z" />
                            </svg>
                        </button>
                    </div>
                    <div class="col-12">
                        <div class="owl-carousel {{ $_movie['class'] }}">
                            @foreach ($_movie['movies'] as $single_movie)
                                <!-- card -->
                                <div class="card card--big">
                                    <a href="{{ route('single', [$single_movie->id, $single_movie->drive_id]) }}"
                                        class="card__cover">
                                        <img src="{{ $single_movie->cover_photo ?? '' }}"
                                            alt="{{ $single_movie->name ?? '' }}">
                                        <span class="card__play">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path
                                                    d="M18.54,9,8.88,3.46a3.42,3.42,0,0,0-5.13,3V17.58A3.42,3.42,0,0,0,7.17,21a3.43,3.43,0,0,0,1.71-.46L18.54,15a3.42,3.42,0,0,0,0-5.92Zm-1,4.19L7.88,18.81a1.44,1.44,0,0,1-1.42,0,1.42,1.42,0,0,1-.71-1.23V6.42a1.42,1.42,0,0,1,.71-1.23A1.51,1.51,0,0,1,7.17,5a1.54,1.54,0,0,1,.71.19l9.66,5.58a1.42,1.42,0,0,1,0,2.46Z" />
                                            </svg>
                                        </span>
                                    </a>
                                    <div class="card__content">
                                        <h3 class="card__title">
                                            <a href="{{ route('single', [$single_movie->id, $single_movie->drive_id]) }}">
                                                {{ $single_movie->name ?? '' }}
                                            </a>
                                        </h3>
                                        <span class="card__category">
                                            {{-- get all categories under this post id --}}
                                            @php
                                                $categories = App\Http\Controllers\HomeController::get_category_by_movie_id($single_movie->id);
                                            @endphp

                                            @foreach ($categories as $_categories)
                                                <a href="{{ route('archive', [$_categories->id, $_categories->slug]) }}">
                                                    {{ $_categories->name }}
                                                </a>
                                            @endforeach
                                        </span>
                                        <span class="card__rate">{{ $single_movie->movie_review ?? '' }}</span>
                                    </div>
                                </div>
                                <!-- end card -->
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- end home -->

@endif
