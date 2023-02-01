@if (isset($slider) && !empty($slider))
    <style>
        .carsoule-item {
            height: 65vh !important;
        }

        @media screen and (max-width:768px) {
            .owl-carousel.home-slider {
                margin-top: 65px;
            }
        }

        .carsoule-item img {
            max-width: 100%;
            min-width: 100%;
            max-height: 100%;
            min-height: 100%;
            height: 100%;
            border: 3px solid #fff;
            border-radius: 3px;
        }

        .owl-carousel.home-slider {
            margin-top: 80px;
        }

        .owl-carousel.home-slider .owl-nav,.owl-carousel.home-slider .owl-dots {
            display: block !important;
            pointer-events: inherit;
        }
        .owl-carousel.home-slider .owl-dots {
        	position: absolute;
        	top: ;
        	bottom: 10px;
        	left: 10px;
        }
        .owl-carousel.home-slider .owl-dots button {
        	width: 10px;
        	height: 10px;
        	background: #fff;
        	border-radius: 50%;
        }
        .owl-carousel.home-slider .owl-prev,
        .owl-carousel.home-slider .owl-next {
            position: absolute;
            color: red;
            top: 46%;
            transform: translateY(-50%);
            width: 40px;
            height: 35px;
            left: 0px;
            background: #fff !important;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .owl-carousel.home-slider .owl-next {
            left: auto;
            right: 0px;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            border-top-right-radius: 0px;
            border-bottom-right-radius: 0px;
        }

        .owl-carousel.home-slider .owl-prev span,
        .owl-carousel.home-slider .owl-next span {
            display: none;
        }

        .owl-carousel.home-slider .owl-prev::before,
        .owl-carousel.home-slider .owl-next::before {
            content: "\f060";
            font-family: 'Font Awesome 6 Free';
            font-size: 100%;
            color: #ff55a5;
            font-weight: bold;
            font-size: 20px;
        }

        .owl-carousel.home-slider .owl-next::before {
            content: "\f061";
        }

       .home_c_title {
        	position: absolute;
        	color: #fff !important;
        	left: 25px;
        	bottom: 22px;
        	font-size: 40px;
        	font-size: 26px;
        }
        .owl-carousel.home-slider .owl-dots .owl-dot.active {
        	background: #ff55a5;
        }
    </style>
    <div class="owl-carousel home-slider">
        @foreach ($slider as $_slider)
            <div class="carsoule-item">
                <div class="thumb">
                    <a href="{{ $_slider['single_link'] ?? '' }}">
                        <img src="{{ asset($_slider['cover_photo']) }}" alt="{{ $_slider['title'] }}">
                    </a>
                </div>
                <a href="{{ $_slider['single_link'] ?? '' }}"><h1 class="home_c_title">{{ $_slider['title'] }}</h1></a>
            </div>
        @endforeach
    </div>
@endif
