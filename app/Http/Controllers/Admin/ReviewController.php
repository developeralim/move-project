<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ReviewController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = Review::latest()->get();
            return DataTables::of($data)

                ->editColumn('review_movie_id', function ($data) {
                    return $data->movie->name;
                })
                ->editColumn('member_id', function ($data) {
                    return $data->member->user_name;
                })

                ->editColumn('review_title', function ($data) {
                    return $data->review_title;
                })
                ->editColumn('review_rate', function ($data) {
                    return $data->review_rate;
                })

                ->editColumn('review_text', function ($data) {
                    return Str::limit($data->review_text, 100, '.....');
                })


                ->editColumn('status', function ($data) {
                    $button = 'btn-success';
                    if ($data->status == 0) {
                        $button = 'btn-danger';
                    }
                    $html = '<select class="btn-sm btn btn-rounded ' . $button . ' status-change" data-name="status" data-url="' . route('review.status', $data->id) . '">
                  <option value="1" ' . ($data->status == 1 ? "selected" : "") . '>Show</option>
                  <option value="0"' . ($data->status == 0 ? "selected" : "") . '>Hide</option>
                </select>';
                    return  $html;
                })

                ->addColumn('action', function ($data) {
                    $edit = '
                    <button  class="btn btn-danger btn-sm show-modal" data-url ="' . route('review.delete', $data->id) . '">Delete</button>';
                    return $edit;
                })
                ->addColumn('checkbox', function ($data) {
                    $checkbox =  '<input type="checkbox" name="checkbox" class"checkbox" data-id="' . $data['id'] . '" >';
                    return $checkbox;
                })
                ->rawColumns(['member_id', 'movie_id', 'review_rate','review_title', 'review_text', 'status', 'action', 'checkbox'])
                ->toJson();
        }

        return view('backend.pages.review.index');
    }









    public function delete($id)
    {
        return view('backend.pages.review.delete', compact('id'));
    }
    public function destroy(Review $review)
    {
        $review->delete();
        return response()->json(['success' => true, 'msg' =>  'Review Deleted Successfully']);
    }

    public function delete_all(Request $request)
    {
        $ids = $request->input('checked_id');
        return view('backend.pages.review.delete-all', compact('ids'));
    }

    public function destroy_all(Request $request)
    {
        $id_array = $request->input('ids');
        foreach ($id_array as $id) {
            $review = Review::find($id);
            $review->delete();
        }
        return response()->json(['success' => true, 'msg' =>  'Review Deleted Successfully']);
    }
}
