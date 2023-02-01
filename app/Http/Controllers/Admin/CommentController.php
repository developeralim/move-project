<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CommentController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = Comment::latest()->get();
            return DataTables::of($data)

                ->editColumn('comment_movie_id', function ($data) {
                    return $data->movie->name;
                })
                ->editColumn('comment_author', function ($data) {
                    if ($data->comment_author) {
                        return $data->comment_author;
                    } else {
                        return '<span class="badge badge-warning">Null</span>';
                    }

                })
                ->editColumn('comment_author_url', function ($data) {
                    if ($data->comment_author_url) {
                        return $data->comment_author_url;
                    } else {
                        return '<span class="badge badge-warning">Null</span>';
                    }

                })
                ->editColumn('comment_author_email', function ($data) {
                    if ($data->comment_author_email) {
                        return $data->member->email;
                    } else {
                        return '<span class="badge badge-warning">Null</span>';
                    }

                })
                ->editColumn('comment_author_ip', function ($data) {
                    if ($data->comment_author_ip) {
                        return $data->comment_author_ip;
                    } else {
                        return '<span class="badge badge-warning">Null</span>';
                    }

                })


                ->editColumn('comment_author_url', function ($data) {
                    return $data->comment_author_url;
                })
                ->editColumn('author_email', function ($data) {
                    return $data->author_email;
                })
                ->editColumn('comment', function ($data) {
                    return Str::limit($data->comment,50,'.......');
                })

                ->editColumn('status', function ($data) {
                    $button = 'btn-success';
                    if ($data->status == 0) {
                        $button = 'btn-danger';
                    }
                    $html = '<select class="btn-sm btn ' . $button . ' status-change" data-name="status" data-url="' . route('comment.status', $data->id) . '">
                  <option value="1" ' . ($data->status == 1 ? "selected" : "") . '>Active</option>
                  <option value="0"' . ($data->status == 0 ? "selected" : "") . '>Inactive</option>
                </select>';
                    return  $html;
                })

                ->addColumn('action', function ($data) {
                    $button = 'btn-success';
                    if ($data->comment_approve == 0) {
                        $button = 'btn-outline-danger';
                        return '<a  class="btn ' . $button . ' btn-sm"  href="' . route('comment.comment_approve', $data->id) . '">Approval</a>
                       <button  class="btn btn-danger btn-sm show-modal" data-url ="' . route('comment.delete', $data->id) . '">Delete</button>';
                    }else{
                        return '<button disabled  class="btn  btn-outline-success  btn-sm"">Approved</button>
                        <button  class="btn btn-danger btn-sm show-modal" data-url ="' . route('comment.delete', $data->id) . '">Delete</button>';
                    }


                })
                ->addColumn('checkbox', function ($data) {
                    $checkbox =  '<input type="checkbox" name="checkbox" class"checkbox" data-id="' . $data['id'] . '" >';
                    return $checkbox;
                })
                ->rawColumns(['member_id', 'movie_id', 'author_name', 'author_url','comment', 'status', 'action', 'checkbox'])
                ->toJson();
        }

        return view('backend.pages.comment.index');
    }




    public function status(Request $request, $id)
    {
        Comment::find($id)->update($request->all());
        return response()->json(['success' => true, 'msg' => 'Comment Status changes Successfully']);
    }
    public function comment_approve($id)
    {
        Comment::find($id)->update([
            'comment_approve'=>1,
        ]);
        return back();
    }




    public function delete($id)
    {
        return view('backend.pages.comment.delete', compact('id'));
    }
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json(['success' => true, 'msg' =>  'Comment Deleted Successfully']);
    }

    public function delete_all(Request $request)
    {
        $ids = $request->input('checked_id');
        return view('backend.pages.comment.delete-all', compact('ids'));
    }

    public function destroy_all(Request $request)
    {
        $id_array = $request->input('ids');
        foreach ($id_array as $id) {
            $comment = Comment::find($id);
            $comment->delete();
        }
        return response()->json(['success' => true, 'msg' =>  'Comment Deleted Successfully']);
    }
}
