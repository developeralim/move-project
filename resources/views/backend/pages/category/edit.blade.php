<div class="modal-dialog " role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update category in this modal form</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('category.update', $category->id) }}" method="post" enctype="multipart/form-data"
                class="form form-submit">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="my-input">Category name</label>
                            <input id="my-input" class="form-control" type="text" name="name"
                                value="{{ $category->name }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="my-parent">Category Parent</label>
                            <select name="parent" class="form-control">
                                <option value="0">Select Category Parent</option>
                                {!! $select !!}
                            </select>
                        </div>
                    </div>
                    <div class="col-6 my-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="hide_on_menu" type="checkbox" id="menu_hide"
                                value="1" {{ $category->hide_on_menu == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="menu_hide">Hide On Menu</label>
                        </div>
                    </div>
                    <div class="col-6 my-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="show_frontpage" type="checkbox" id="show_front"
                                value="1" checked {{ $category->show_frontpage == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="show_front">Show in front page</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="my-text">Category Descirption</label>
                            <textarea id="my-text" class="form-control" type="text" name="description" placeholder="Category description....."></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-success btn-sm float-right">update & Save</button>
            </form>
        </div>

    </div>
</div>
