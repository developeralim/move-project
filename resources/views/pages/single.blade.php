@extends('pages.layouts.main')
@section('title')
    Daag | Movie
@endsection
@section('main')

    @if ($movie)
        <!-- details -->
        <section class="section details">
            <!-- details background -->
            <div class="details__bg" data-bg="{{ asset('assets/img/home/home__bg.jpg') }}"></div>
            <!-- end details background -->
            <!-- details content -->
            <div class="container">
                <div class="row">
                    <!-- title -->
                    <div class="col-12">
                        <h1 class="details__title">
                            {{ $movie->name }}
                        </h1>
                    </div>
                    <!-- end title -->

                    @section('movie_desc')
                        <div class="card card--details card--series" style="margin-top: 0">
                            <!-- card content -->
                            <div class="card__content">
                                <div class="card__wrap">
                                    <span class="card__rate">
                                        {{ $movie->movie_review ?? '' }}
                                    </span>
                                    <ul class="card__list">
                                        @if ($movie->movie_meta)
                                            @foreach (explode(',', $movie->movie_meta) as $meta)
                                                <li>{{ $meta }}</li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <ul class="card__meta">
                                    <li>
                                        <span>Genre:</span>
                                        @foreach ($category as $_category)
                                            <a
                                                href="{{ route('archive', [$_category->id, $_category->slug]) }}">{{ $_category->name }}</a>
                                        @endforeach
                                    </li>
                                    <li>
                                        <span>Release year:</span>
                                        {{ $movie->relese_year }}
                                    </li>
                                    <li>
                                        <span>Running time:</span>
                                        {{ $movie->running_time_minute }} min
                                    </li>
                                    <li>
                                        <span>Country:</span>
                                        <a>{{ $movie->country }}</a>
                                    </li>
                                </ul>
                                <div class="card__description card__description--details">
                                    {{ $movie->description }}
                                </div>
                            </div>
                            <!-- end card content -->
                        </div>
                    @endsection
                    <!-- content -->
                    @if ($seasions)
                        <div class="col-12 col-xl-11">
                            @yield('movie_desc')
                        </div>
                    @endif
                    <!-- end content -->
                    <!-- player -->
                    <div class="col-12 col-lg-6" class="lock-bg">
                        @if ($logged_in)
                            {{-- provider iframe here --}}
                            <div class="rwd-media"
                                style="padding-bottom:56.25%; position:relative; display:block; width: 100%">
                                <iframe width="100%" height="100%" frameborder="0" allowfullscreen=""
                                    style="position:absolute; top:0; left: 0" frameborder="0" webkitAllowFullScreen
                                    mozallowfullscreen allowFullScreen
                                    src="https://drive.google.com/file/d/{{$movie->drive_id}}/preview"
                                    allowFullScreen scrolling="no" seamless="" sandbox="allow-same-origin allow-scripts">
                                </iframe>
                            </div>
                        @else
                            <a href="#" class="premium-video">
                                <video controls crossorigin playsinline poster="{{ asset($movie->poster_image) }}"
                                    id="player" width="640" height="400">
                                    <!-- Video files -->
                                    <source src="#" type="video/mp4">
                                    <!-- Caption files -->
                                    <track kind="captions" label="English" srclang="en" src="#" default>
                                    <track kind="captions" label="Français" srclang="fr" src="#">
                                    <!-- Fallback for browsers that don't support the <video> element -->
                                </video>
                            </a>
                            {{-- quality model --}}
                            <div id="pricing" class="modal">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <span>Byu a package to unlock the video</span>
                                        <span class="close" onClick="closeModel('pricing')">&times;</span>
                                    </div>
                                    <div class="packages">
                                        {{-- loop three package --}}
                                        @if ($packages)
                                            @foreach ($packages as $key => $package)
                                                <div class="package">
                                                    <h2>{{ $key }}/<span
                                                            style="font-size:12px">{{ $package['price'] }}</span></h2>
                                                    <ul>
                                                        @foreach ($package['features'] as $feature)
                                                            <li>{{ $feature }}</li>
                                                        @endforeach
                                                    </ul>
                                                    <a href="{{ route('checkout', [$key, $package['price']]) }}"
                                                        class="btn-sm btn-primary btn">Buy Now</a>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- end player -->
                    @if ($seasions)
                        <!-- accordion -->
                        <div class="col-12 col-lg-6">
                            {{-- loop over seasions --}}
                            <div class="accordion" id="accordion">
                                @foreach ($seasions as $key => $_seasions)
                                    <div class="accordion__card">
                                        <div class="card-header" id="headingOne">
                                            <button type="button" data-toggle="collapse"
                                                data-target="#{{ str_replace(' ', '_', $key) }}" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <span>{{ $key }}</span>
                                                <span>
                                                    {{ $_seasions['episodes_count'] }}
                                                    episodes from
                                                    {{ date('M Y', strtotime($_seasions['seasions']->created_at)) }},
                                                    until May,
                                                    {{ date('Y') }}
                                                </span>
                                            </button>
                                        </div>

                                        <div id="{{ str_replace(' ', '_', $key) }}" class="collapse"
                                            aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                                <table class="accordion__list">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Title</th>
                                                            <th>Air Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($_seasions['episodes'] as $episod)
                                                            <tr>
                                                                <th>1</th>
                                                                <td>
                                                                    <a
                                                                        href="{{ route('single', [$episod->id, $episod->drive_id]) }}">{{ $episod->name }}

                                                                    </a>
                                                                </td>
                                                                <td>{{ date('M d, Y', strtotime($episod->relese_date)) }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- end accordion -->
                    @else
                        <div class="col-12 col-xl-6">
                            @yield('movie_desc')
                        </div>
                    @endif
                </div>
            </div>
            <!-- end details content -->
        </section>
        <!-- end details -->
        @if ($logged_in)
            <!-- content -->
            <section class="content">
                <div class="container">
                    <div class="content__head">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <!-- content title -->
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h2 class="content__title">Discover</h2>
                                        <div class="actions">
                                            @if (!$is_expired)
                                                {{-- quality model --}}
                                                <div id="quality" class="modal">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <span class="close"
                                                                onClick="closeModel('quality')">&times;</span>
                                                            <span>Select Video Quality</span>
                                                        </div>
                                                        <select class="form-control" id="qualities"
                                                            onchange="onStartDownload()">
                                                            <option value="">Select Quality</option>
                                                            @if ($qualities)
                                                                @foreach ($qualities as $res => $id)
                                                                    <option value="{{ $id }}">
                                                                        {{ $res }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                {{-- all available downloads --}}
                                                @if ($download_links)
                                                    @foreach ($download_links as $key => $link)
                                                        <a href="{{ $link }}" id="{{ $key }}"></a>
                                                    @endforeach
                                                @endif
                                                {{-- all available downloads end --}}
                                                <button onclick="showQualityModel()" class="form__btn">Download</button>
                                            @else
                                                <a href="#" class="form__btn">Renew Package</a>
                                            @endif
                                            <div class="comments__rate" style="position: inherit">
                                                <button type='button'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'>
                                                        <path
                                                            d='M21.3,10.08A3,3,0,0,0,19,9H14.44L15,7.57A4.13,4.13,0,0,0,11.11,2a1,1,0,0,0-.91.59L7.35,9H5a3,3,0,0,0-3,3v7a3,3,0,0,0,3,3H17.73a3,3,0,0,0,2.95-2.46l1.27-7A3,3,0,0,0,21.3,10.08ZM7,20H5a1,1,0,0,1-1-1V12a1,1,0,0,1,1-1H7Zm13-7.82-1.27,7a1,1,0,0,1-1,.82H9V10.21l2.72-6.12A2.11,2.11,0,0,1,13.1,6.87L12.57,8.3A2,2,0,0,0,14.44,11H19a1,1,0,0,1,.77.36A1,1,0,0,1,20,12.18Z' />
                                                    </svg>12</button>
                                                <button type='button'>7
                                                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'>
                                                        <path
                                                            d='M19,2H6.27A3,3,0,0,0,3.32,4.46l-1.27,7A3,3,0,0,0,5,15H9.56L9,16.43A4.13,4.13,0,0,0,12.89,22a1,1,0,0,0,.91-.59L16.65,15H19a3,3,0,0,0,3-3V5A3,3,0,0,0,19,2ZM15,13.79l-2.72,6.12a2.13,2.13,0,0,1-1.38-2.78l.53-1.43A2,2,0,0,0,9.56,13H5a1,1,0,0,1-.77-.36A1,1,0,0,1,4,11.82l1.27-7a1,1,0,0,1,1-.82H15ZM20,12a1,1,0,0,1-1,1H17V4h2a1,1,0,0,1,1,1Z' />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end content title -->

                                    <!-- content tabs nav -->
                                    <ul class="nav nav-tabs content__tabs" id="content__tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" data-toggle="tab" href="#tab-1" role="tab"
                                                aria-controls="tab-1" aria-selected="true">Comments</a>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" data-toggle="tab" href="#tab-2" role="tab"
                                                aria-controls="tab-2" aria-selected="false">Reviews</a>
                                        </li>
                                    </ul>
                                    <!-- end content tabs nav -->

                                    <!-- content mobile tabs nav -->
                                    <div class="content__mobile-tabs" id="content__mobile-tabs">
                                        <div class="content__mobile-tabs-btn dropdown-toggle" role="navigation"
                                            id="mobile-tabs" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <input type="button" value="Comments">
                                            <span></span>
                                        </div>

                                        <div class="content__mobile-tabs-menu dropdown-menu"
                                            aria-labelledby="mobile-tabs">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item"><a class="nav-link active" id="1-tab"
                                                        data-toggle="tab" href="#tab-1" role="tab"
                                                        aria-controls="tab-1" aria-selected="true">Comments</a></li>

                                                <li class="nav-item"><a class="nav-link" id="2-tab"
                                                        data-toggle="tab" href="#tab-2" role="tab"
                                                        aria-controls="tab-2" aria-selected="false">Reviews</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- end content mobile tabs nav -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-8 col-xl-8">
                            <!-- content tabs -->
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="tab-1" role="tabpanel"
                                    aria-labelledby="1-tab">
                                    <div class="row">
                                        <!-- comments -->
                                        <div class="col-12">
                                            <div class="comments">
                                                {{-- comments --}}
                                                {!! $comments !!}
                                                {{-- comments end --}}
                                            </div>
                                        </div>
                                        <!-- end comments -->
                                        <div class="col-12">
                                            <form action="{{ route('comment') }}" method="POST" class="form"
                                                id="comment-form">
                                                @csrf
                                                @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <p class="error">{{ $error }}</p>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                @if (!$logged_in)
                                                    <input type="name" name="comment_author"
                                                        value="{{ old('comment_author') }}" class="form__input"
                                                        placeholder="Name">
                                                    <input type="email" name="comment_author_email"
                                                        value="{{ old('comment_author_email') }}" class="form__input"
                                                        placeholder="Email">
                                                    <input type="url" name="comment_author_url"
                                                        value="{{ old('comment_author_url') }}" class="form__input"
                                                        placeholder="Website">
                                                @else
                                                    <input type="hidden" name="comment_author_id"
                                                        value="{{ $logged_in_user['id'] }}" class="form__input">
                                                @endif
                                                <input type="hidden" name="comment_parent" value="0">
                                                <input type="hidden" name="comment_author_ip" value="">
                                                <input type="hidden" name="comment_movie_id"
                                                    value="{{ $movie->id }}">
                                                <textarea id="text" value="{{ old('comment_content') }}" name="comment_content" name="text"
                                                    class="form__textarea" placeholder="Add comment"></textarea>
                                                <button type="submit" class="form__btn">Send</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="2-tab">
                                    <div class="row">
                                        <!-- reviews -->
                                        <div class="col-12">
                                            <div class="reviews">
                                                <ul class="reviews__list">
                                                    @foreach ($reviews as $review)
                                                        <li class="reviews__item">
                                                            <div class="reviews__autor">
                                                                <img class="reviews__avatar"
                                                                    src="{{ asset('assets/img/user.svg') }}"
                                                                    alt="">
                                                                <span
                                                                    class="reviews__name">{{ $review['review_title'] }}</span>
                                                                <span
                                                                    class="reviews__time">{{ $review['review_date'] }}</span>
                                                                <span class="reviews__rating">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        enable-background="new 0 0 24 24"
                                                                        viewBox="0 0 24 24">
                                                                        <path
                                                                            d="M22,10.1c0.1-0.5-0.3-1.1-0.8-1.1l-5.7-0.8L12.9,3c-0.1-0.2-0.2-0.3-0.4-0.4C12,2.3,11.4,2.5,11.1,3L8.6,8.2L2.9,9C2.6,9,2.4,9.1,2.3,9.3c-0.4,0.4-0.4,1,0,1.4l4.1,4l-1,5.7c0,0.2,0,0.4,0.1,0.6c0.3,0.5,0.9,0.7,1.4,0.4l5.1-2.7l5.1,2.7c0.1,0.1,0.3,0.1,0.5,0.1v0c0.1,0,0.1,0,0.2,0c0.5-0.1,0.9-0.6,0.8-1.2l-1-5.7l4.1-4C21.9,10.5,22,10.3,22,10.1z">
                                                                        </path>
                                                                    </svg>
                                                                    {{ $review['review_rate'] }}
                                                                </span>
                                                            </div>
                                                            <p class="reviews__text">
                                                                {{ $review['review_txt'] }}
                                                            </p>
                                                        </li>
                                                    @endforeach
                                                </ul>

                                                @if ($logged_in)
                                                    <form action="{{ route('review') }}" method="POST" class="form"
                                                        onsubmit="update_review_rate()">
                                                        @if ($errors->any())
                                                            <div class="alert alert-danger">
                                                                <ul>
                                                                    @foreach ($errors->all() as $error)
                                                                        <p class="error">{{ $error }}</p>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endif
                                                        @csrf
                                                        <input type="hidden" name="review_author_id"
                                                            value="{{ $logged_in_user['id'] }}" class="form__input">
                                                        <input type="text" class="form__input"
                                                            value="{{ old('review_title') }}" name="review_title"
                                                            placeholder="Title">
                                                        <textarea class="form__textarea" value="{{ old('review_text') }}" placeholder="Review" name="review_text"></textarea>
                                                        <div class="form__slider">
                                                            <div class="form__slider-rating" id="slider__rating"></div>
                                                            <div class="form__slider-value" id="form__slider-value"></div>
                                                        </div>
                                                        <input type="hidden" name="review_rate"
                                                            value="{{ old('review_rate') }}">
                                                        <input type="hidden" value="{{ $movie->id }}"
                                                            name="review_movie_id">
                                                        <button type="submit" class="form__btn">Send</button>
                                                    </form>
                                                @else
                                                    <a href="{{ route('login') }}" class="form__btn"
                                                        style="width:40%;">Login to give a review</a>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- end reviews -->
                                    </div>
                                </div>
                            </div>
                            <!-- end content tabs -->
                        </div>
                        <!-- sidebar -->
                        <div class="col-12 col-lg-12 col-xl-12">
                            <div class="row row--grid">
                                <!-- section title -->
                                @if (!empty($recomended))
                                    <div class="col-12">
                                        <h2 class="section__title section__title--sidebar">Recomended for you</h2>
                                    </div>
                                @endif
                                <!-- end section title -->

                                @foreach ($recomended as $_recomended)
                                    <!-- card -->
                                    <div class="col-6 col-sm-4 col-lg-6">
                                        <div class="card rec-card">
                                            <a href="{{ route('single', [$_recomended['id'], $_recomended['drive_id']]) }}"
                                                class="card__cover">

                                                <img src="{{ asset($_recomended['cover_photo']) }}"
                                                    alt="{{ $_recomended['name'] }}">
                                                <span class="card__play">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path
                                                            d="M18.54,9,8.88,3.46a3.42,3.42,0,0,0-5.13,3V17.58A3.42,3.42,0,0,0,7.17,21a3.43,3.43,0,0,0,1.71-.46L18.54,15a3.42,3.42,0,0,0,0-5.92Zm-1,4.19L7.88,18.81a1.44,1.44,0,0,1-1.42,0,1.42,1.42,0,0,1-.71-1.23V6.42a1.42,1.42,0,0,1,.71-1.23A1.51,1.51,0,0,1,7.17,5a1.54,1.54,0,0,1,.71.19l9.66,5.58a1.42,1.42,0,0,1,0,2.46Z" />
                                                    </svg>
                                                </span>

                                            </a>
                                            <div class="card__content">
                                                <h3 class="card__title">
                                                    <a href="#">
                                                        {{ $_recomended['name'] }}
                                                    </a>
                                                </h3>
                                                <span class="card__category">
                                                    @foreach ($_recomended['category'] as $_category)
                                                        <a
                                                            href="{{ route('archive', [$_category->id, $_category->name]) }}">
                                                            {{ $_category->name }}
                                                        </a>
                                                    @endforeach
                                                </span>
                                                <span class="card__rate">{{ $_recomended['movie_review'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card -->
                                @endforeach

                            </div>
                        </div>
                        <!-- end sidebar -->
                    </div>
                </div>
            </section>
            <!-- end content -->
        @else
            <div class="become-member">
                <a href="{{ route('pricing') }}" style="width:220px" class="form__btn">Become A Member</a>
            </div>
        @endif
    @endif

    <script>
        function replay(id) {

            const comment_form = document.querySelector("#comment-form").getBoundingClientRect().height;
            const input = document.querySelector('input[name="comment_parent"]');

            input.value = id;

        }

        function update_review_rate() {
            window.event.preventDefault();

            const review_input = document.querySelector('input[name="review_rate"]');

            const rating = document.querySelector('.form__slider-value').innerHTML;

            review_input.value = rating;

            window.event.target.submit();
        }


        // close quality model
        window.onclick = function(event) {
            const model = document.getElementById("quality");
            if (event.target == model) {
                model.style.display = "none";
            }
        }

        // close pricing model
        window.onclick = function(event) {
            const model = document.getElementById("pricing");
            if (event.target == model) {
                model.style.display = "none";
            }
        }

        // close model
        const closeModel = (id) => {
            document.getElementById(`${id}`).style.display = "none";
        }

        // show quality selection model
        const showQualityOption = (e) => {
            document.getElementById("quality").style.display = "block";

        }

        function onStartDownload() {
            const e = window.event;
            const downloadLink = document.getElementById(`${e.target.value}`);
            downloadLink.click();
            closeModel('quality');
        }

        // show pricing model
        function showQualityModel() {
            const e = window.event;
            e.preventDefault();
            document.getElementById(`quality`).style.display = "block";
        }
        document.querySelector('.premium-video').onclick = (e) => {
            e.preventDefault();
            // show pricing model
            document.getElementById(`pricing`).style.display = "block";

        }
    </script>
@endsection
