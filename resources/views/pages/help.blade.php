@extends('pages.layouts.main')
@section('title')
   Daag | Help
@endsection
@section('main')
      <!-- page title -->
      <section class="section section--first section--bg" data-bg="{{asset('assets/img/section/section.jpg')}}">
            <div class="container">
            <div class="row">
                  <div class="col-12">
                        <div class="section__wrap">
                        <!-- section title -->
                        <h1 class="section__title">Help >> FQA</h1>
                        <!-- end section title -->
                        <!-- breadcrumb -->
                        <ul class="breadcrumb">
                              <li class="breadcrumb__item">
                                    <a href="index.html">Home</a>
                              </li>
                              <li class="breadcrumb__item breadcrumb__item--active">FAQ</li>
                        </ul>
                        <!-- end breadcrumb -->
                        </div>
                  </div>
            </div>
            </div>
      </section>
      <!-- end page title -->
       <!-- faq -->
       <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="faq">
                            <div class="accordion" id="accordion">
                                <div class="accordion__card">
                                    <div class="card-header" id="headingOne">
                                        <button
                                            type="button"
                                            data-toggle="collapse"
                                            data-target="#collapseOne"
                                            aria-expanded="true"
                                            aria-controls="collapseOne"
                                        >
                                            <h3 class="faq__title">Why is a Video is not loading?</h3>
                                        </button>
                                    </div>
                                    <div
                                        id="collapseOne"
                                        class="collapse"
                                        aria-labelledby="headingOne"
                                        data-parent="#accordion"
                                    >
                                        <div class="card-body">
                                            <p class="faq__text">All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.</p>
                                            <p class="faq__text">Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end faq -->
@endsection