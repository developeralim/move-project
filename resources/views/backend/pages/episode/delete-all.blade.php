<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Confirmation Delete</h5>

        </div>
            <form action="{{ route('episode.destroy_all') }}" method="post" class="form-submit">
                @csrf
                @foreach ($ids as $id)
                <input type="hidden" name="ids[]" value="{{ $id }}" />
                @endforeach

                <div class="modal-body text-center">
                    <h3>Are you sure?</h3>
                    <h4 align="center" style="margin:10px 20px;">You won't be able to revert this!?</h4>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary text-center">Yes,Delete It</button>
        </form>
            <button type="button" class="btn btn-danger text-center" data-dismiss="modal">Cancle</button>
          </div>
        </div>
        </div>
    </div>
</div>
