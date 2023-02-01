<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('title') </title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <link href="{{ asset('backend') }}/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="{{ asset('backend') }}/assets/js/loader.js"></script>
    @stack('css')
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('backend') }}/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend') }}/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    @stack('style')
    <style>
        .layout-px-spacing {
            min-height: calc(100vh - 166px) !important;
        }
    </style>

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

</head>

<body>
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <div class="header-container fixed-top">
        @include('backend.includes.navber')
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN NAVBAR  -->
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-menu">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg></a>
            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">
                        <div class="page-title">
                            <h3>@yield('page_name')</h3>
                        </div>
                    </div>
                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">

            @include('backend.includes.sidebar')

        </div>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">

                    @yield('content')



                </div>

            </div>
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright ©  2022 <a target="_blank"
                            href="">Daag</a>, All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Hello Friends<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                            <path
                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                            </path>
                        </svg></p>
                </div>
            </div>
        </div>
        <!--  END CONTENT PART  -->

    </div>
    <!-- END MAIN CONTAINER -->
    <div class="modal rotateInDownLeft view-modal" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
    </div>
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('backend') }}/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="{{ asset('backend') }}/bootstrap/js/popper.min.js"></script>
    <script src="{{ asset('backend') }}/bootstrap/js/bootstrap.min.js"></script>
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('backend') }}/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="https://malsup.github.io/jquery.form.js"></script>
    <script src="{{ asset('backend') }}/assets/js/app.js"></script>
    <script>

        $(document).ready(function() {
            App.init();
        });
    </script>
    @stack('js')
    @stack('scripts')
    <script src="{{ asset('backend') }}/assets/js/custom.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });


        $(document).on('click', '.show-modal', function() {
            let url = $(this).data('url');
            let self = $(this);
            let old_text = self.text()
            self.text('loading...');
            $.ajax({
                url: url,
                dataType: 'html',
                success: function(response) {
                    $('.view-modal').html(response).modal('show');
                    self.text(old_text)
                }
            });
        });

        $(document).on('submit', 'form.form-submit', function(e) {
            e.preventDefault();
            let url = $(this).attr('action');
            let data = $(this).fieldSerialize();
            let form = $(this);
            $('.submit-button').attr('disabled', true);
            $('.save-button').addClass('d-none');
            $('.loading-button').removeClass('d-none');

            let options = {
                url: url,
                data: data,
                dataType: 'json',
                success: function(response) {
                    datatable.ajax.reload();
                    get_alert(response);
                }
            };

            $(this).ajaxSubmit(options);

            // !!! Important !!!
            // always return false to prevent standard browser submit and page navigation
            $(this).resetForm();
            return false;
        });

        // pre-submit callback
        function showRequest(formData, jqForm, options) {
            // formData is an array; here we use $.param to convert it to a string to display it
            // but the form plugin does this for you automatically when it submits the data
            //var queryString = $.param(formData);
            var queryString = $.param(formData);

            // jqForm is a jQuery object encapsulating the form element.  To access the
            // DOM element for the form do this:
            // var formElement = jqForm[0];


            // here we could return false to prevent the form from being submitted;
            // returning anything other than false will allow the form submit to continue
            return true;
        }

        $(document).on('change', '.status-change', function() {
            let name = $(this).data('name');
            let value = $(this).val();
            let url = $(this).data('url');
            let data = {};
            data[name] = value

            $.ajax({
                url: url,
                method: 'GET',
                data: data,
                dataType: 'JSON',
                success: function(response) {
                    datatable.ajax.reload();
                    get_alert(response);
                },
                error: function(error) {
                    console.log(error)
                }
            })
        });


        // $(document).on('change','.is_paid',function(){
        //     let is_default = $(this).val();
        //     let url = $(this).data('url');
        //     $.ajax({
        //         url: url,
        //         method: 'GET',
        //         data: {is_paid: is_paid},
        //         dataType: 'json',
        //         success:function(response){
        //             get_alert(response);
        //         },
        //         error: function(error){
        //             console.log(error)
        //         }
        //     })
        // });

        function get_alert(response) {
            if (response.success == true) {
                Toast.fire({
                    icon: 'success',
                    title: response.msg
                })
                $('.view-modal').modal('hide');
                if (typeof datatable !== 'undefined') {
                    datatable.ajax.reload();
                }
            } else {
                Toast.fire({
                    icon: 'error',
                    title: response.msg
                })

            }

            $('.submit-button').removeAttr('disabled');
            $('.save-button').removeClass('d-none');
            $('.loading-button').addClass('d-none');
        }


        // ALl Delete checkbox

        $(document).on('click', 'input[name="main_checkbox"]', function() {
            if (this.checked) {
                $('input[name="checkbox"]').each(function() {
                    this.checked = true;
                });
            } else {
                $('input[name="checkbox"]').each(function() {
                    this.checked = false;
                });
            }
            toggledeleteAllbtn();
        });

        $(document).on('change', 'input[name="checkbox"]', function() {
            if ($('input[name="checkbox"]').length == $('input[name="checkbox"]:checked').length) {
                $('input[name="main_checkbox"]').prop('checked', true);
            } else {
                $('input[name="main_checkbox"]').prop('checked', false);
            }
            toggledeleteAllbtn();
        });

        function toggledeleteAllbtn() {
            if ($('input[name="checkbox"]:checked').length > 0) {
                $('button.deleteAllbtn').text('Mark Delete (' + $('input[name="checkbox"]:checked').length + ')')
                    .removeClass(
                        'd-none');
            } else {
                $('button.deleteAllbtn').addClass('d-none');
            }
        }

    </script>
</body>

</html>
