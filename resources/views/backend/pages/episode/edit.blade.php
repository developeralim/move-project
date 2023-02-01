

<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">update episode in this modal form</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
              <form action="{{ route('episode.update',$episode->id) }}" method="post" enctype="multipart/form-data" class="form form-submit">
                @csrf @method('put')
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Select episode sesion </label><br>
                            <select class="form-control" name="seasion_id">
                                <option label="Select Sesions sesion">Select episode sesion</option>
                                @foreach ($seasions as $seasion)
                                <option  value="{{$seasion->id  }}" {{$seasion->id==$episode->seasion_id?'selected':''  }}>{{ $seasion->seasion_name }}</option>
                                @endforeach
                              </select>
                         </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Episode name</label>
                            <input id="my-input" class="form-control" type="text" name="name" value="{{$episode->name }}">
                         </div>
                    </div>



                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Episode API key</label>
                            <input id="my-input" class="form-control" type="text" name="api_key" value="{{$episode->api_key }}">
                         </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Episode release year</label>
                            <input id="my-input" class="form-control" type="number" name="release_year" value="{{$episode->release_year }}">
                         </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Episode relese date</label>
                            <input id="my-input" class="form-control" type="text" name="relese_date" value="{{$episode->relese_date }}">
                         </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Episode drive ID </label>
                            <input id="my-input" class="form-control" type="text" name="drive_id" value="{{$episode->drive_id }}">
                         </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Episode quality </label><br>
                            <select class="select2 form-control" name="quality[]" multiple="multiple">
                                <option selected="selected" value="144p">144p</option>
                                <option value="240p">240p</option>
                                <option value="360p">360p</option>
                                <option value="480p">480p</option>
                                <option value="720p">720p</option>
                                <option value="1080p">1080p</option>
                                <option value="1140p">1140p</option>
                                <option value="2160p">2160p</option>
                              </select>
                         </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Episode Cover photo</label>
                            <input id="my-input" class="form-control" type="file" name="cover_photo">
                         </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <img src="{{ asset($episode->cover_photo) }}" width="70px"  alt="">
                         </div>

                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="my-input">Episode description</label>
                            <textarea name="description" class="form-control" id="" cols="4" rows="4">{{ $episode->description }}</textarea>
                         </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-secondary btn-md float-right">Update & Save</button>
              </form>
        </div>

    </div>
</div>

<script>
  $(".select2").select2({
    tags: true
});
</script>














