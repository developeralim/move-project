@extends('backend.layouts.app')
@section('title')
    Dashboard
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endpush
@section('page_name')
Comments Managments List
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">

                    </div>

                    <div class="card-body">
                        <table id="example" class="table table-bordered table-responsive">
                            <thead>

                                <tr>
                                    <th style="width: 2%"><input type="checkbox" class="main_checkbox" name="main_checkbox">
                                    </th>
                                    <th style="width: 10%">Movie</th>
                                    <th >Member name</th>
                                    <th >Author name</th>
                                    <th >Author url</th>
                                    <th >Author email</th>
                                    <th >Author email</th>
                                    <th >Author ip</th>
                                    <th >Author url</th>
                                    <th style="width:20%">Comments</th>
                                    <th style="width:9%">status </th>
                                    <th>Action
                                        <button type="button" class="btn btn-sm btn-danger d-none deleteAllbtn">Delete All</button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
@endpush
@push('scripts')
    <script>
        let datatable = $('#example').DataTable({
            "autoWidth": false,
            processing: true,
            serverSide: true,
            ajax: @json(route('comment.index')),
            columns: [{
                    data: 'checkbox',
                    name: 'checkbox',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'comment_movie_id',
                    name: 'comment_movie_id'
                },
                {
                    data: 'comment_author',
                    name: 'comment_author'
                },
                {
                    data: 'author_email',
                    name: 'author_email'
                },
                {
                    data: 'comment_author_email',
                    name: 'comment_author_email'
                },
                {
                    data: 'comment_author_url',
                    name: 'comment_author_url'
                },
                {
                    data: 'comment_author_ip',
                    name: 'comment_author_ip'
                },
                {
                    data: 'comment',
                    name: 'comment'
                },


                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });



        $(document).on('click', '.deleteAllbtn', function() {
            var checked_id = [];
            $('input[name="checkbox"]:checked').each(function() {
                checked_id.push($(this).data('id'));
            });
            $.ajax({
                type: "get",
                url: @json(route('comment.delete_all')),
                data: {
                    checked_id: checked_id
                },
                dataType: "html",
                success: function(response) {
                    console.log(response);
                    $('.view-modal').html(response).modal('show');
                }
            });
        });
    </script>
@endpush
