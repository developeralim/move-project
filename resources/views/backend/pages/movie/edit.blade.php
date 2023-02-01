<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update movie in this modal form</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('movie.update', $movie->id) }}" method="post" enctype="multipart/form-data"
                class="form form-submit">
                @csrf @method('put')
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Movie name</label>
                            <input id="my-input" class="form-control" type="text"
                                name="name"value="{{ $movie->name }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Select categories </label><br>
                            <select class="select2 form-control" name="category_id[]" multiple="multiple">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @if (in_array($category->id, $movie->categories->pluck('id')->toArray())) selected @endif>{{ $category->name }}</option>
                                @endforeach


                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Select Seasions </label><br>
                            <select class="select2 form-control" name="seasion_id[]" multiple="multiple">
                                @foreach ($seasions as $seasion)
                                    <option value="{{ $seasion->id }}"
                                        @if (in_array($seasion->id, $movie->seasions->pluck('id')->toArray())) selected @endif>{{ $seasion->seasion_name }}
                                    </option>
                                @endforeach


                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Movie release year</label>
                            <input id="my-input" class="form-control" type="number" name="relese_year"
                                value="{{ $movie->relese_year }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Movie API key</label>
                            <input id="my-input" class="form-control" type="text" name="api_key"
                                value="{{ $movie->api_key }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Movie running time minute</label>
                            <input id="my-input" class="form-control" type="text" name="running_time_minute"
                                value="{{ $movie->running_time_minute }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Movie country</label>
                            <input id="my-input" class="form-control" type="text" name="country"
                                value="{{ $movie->country }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Movie age</label>
                            <input id="my-input" class="form-control" type="text" name="age"
                                value="{{ $movie->age }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Movie drive ID </label>
                            <input id="my-input" class="form-control" type="text" name="drive_id"
                                value="{{ $movie->drive_id }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Movie review</label>
                            <input id="my-input" class="form-control" type="number" name="movie_review"
                                value="{{ $movie->movie_review }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Movie quality </label><br>
                            <textarea name="quality" class="form-control" id="" cols="4" rows="4">{{ $movie->quality }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Movie Cover photo</label>
                            <input id="my-input" class="form-control" type="file" name="cover_photo">
                        </div>
                        <img src="{{ asset($movie->cover_photo) }}" width="200px" height="100px" alt="">
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="my-input">Movie description</label>
                            <textarea name="description" class="form-control" id="" cols="4" rows="4">{{ $movie->description }}</textarea>
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
