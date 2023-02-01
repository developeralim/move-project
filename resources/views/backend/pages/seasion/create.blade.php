
  <div class="modal-dialog " role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create seasion in this modal form</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
              <form action="{{ route('seasion.store') }}" method="post" enctype="multipart/form-data" class="form form-submit">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="my-input">Seasion name</label>
                            <input id="my-input" class="form-control" type="text" name="seasion_name" placeholder="seasion name">
                         </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="my-input">Description</label>
                            <textarea name="seasion_desc" id=""  class="form-control" cols="2" rows="2"></textarea>
                         </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-outline-success btn-sm float-right">create & Save</button>
              </form>
        </div>

    </div>
</div>


