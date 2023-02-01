<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create movie in this modal form</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('movie.store') }}" method="post" enctype="multipart/form-data"
                class="form form-submit">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Movie name</label>
                            <input id="my-input" class="form-control" type="text" name="name"
                                placeholder="Movie name here.....">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Select categories </label><br>
                            <select class="select2 form-control" name="category_id[]" multiple="multiple">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach


                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Select Seasions </label><br>
                            <select class="select2 form-control" name="seasion_id[]" multiple="multiple">
                                @foreach ($seasions as $seasion)
                                    <option value="{{ $seasion->id }}">{{ $seasion->seasion_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Movie Cover photo</label>
                            <input id="my-input" class="form-control" type="file" name="cover_photo">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Movie release year</label>
                            <input id="my-input" class="form-control" type="number" name="relese_year"
                                placeholder=" Movie relese year.....">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Movie API key</label>
                            <input id="my-input" class="form-control" type="text" name="api_key"
                                placeholder="Movie API key.....">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Movie running time & minute</label>
                            <input id="my-input" class="form-control" type="text" name="running_time_minute"
                                placeholder=" Movie running time minute.....">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Movie country</label>
                            <input id="my-input" class="form-control" type="text" name="country"
                                placeholder="Movie country name.....">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Movie age</label>
                            <input id="my-input" class="form-control" type="text" name="age"
                                placeholder="Movie age.....">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Movie review</label>
                            <input id="my-input" class="form-control" type="number" name="movie_review"
                                placeholder="Movie review.....">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Movie drive ID </label>
                            <input id="my-input" class="form-control" type="text" name="drive_id"
                                placeholder="Movie drive id.....">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Movie quality </label><br>
                            <textarea name="quality" class="form-control" id="" cols="4" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="my-input">Movie description</label>
                            <textarea name="description" class="form-control" id="" cols="4" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-secondary btn-md float-right">Create & Save</button>
            </form>
        </div>

    </div>
</div>

<script>
    $(".select2").select2({
        tags: true
    });
</script>
