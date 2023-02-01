<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MemberController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data =Member::latest()->get();
            return DataTables::of($data)
            ->addColumn('user_image', function ($data) {
                if ($data->user_image == null) {
                } else {
                    return '<img src="' . asset($data->user_image) . '" width="100px" height="50px" alt="">';
                }
            })
            ->editColumn('user_name', function ($data) {
                return '<span class="badge badge-light">'.$data->user_name.'</span>';
            })
            ->editColumn('email', function ($data) {
                return '<span class="badge badge-light">'.$data->email.'</span>';
            })
            ->editColumn('mobile_no', function ($data) {
                return $data->mobile_no;
            })

            ->editColumn('status_paid', function ($data) {
                if ($data->status_paid=='Unpaid') {
                   return  '<span class="badge badge-dark">Unpaid</span>';
                } else {
                        return '<span class="badge badge-danger">Paid</span>';
                }

            })
           ->editColumn('status', function ($data) {
                    $button = 'btn-success';
                    if ($data->status == 0) {
                        $button = 'btn-danger';
                    }
                    $html = '<select class="btn-sm btn btn-rounded ' . $button . ' status-change" data-name="status" data-url="' . route('user.status', $data->id) . '">
                  <option value="1" ' . ($data->status == 1 ? "selected" : "") . '>Active</option>
                  <option value="0"' . ($data->status == 0 ? "selected" : "") . '>Inactive</option>
                </select>';
                    return  $html;
                })

                ->addColumn('action', function ($data) {
                    $edit = '<a  class="btn btn-success btn-sm " href ="' . route('user.show',[ $data->id,$data->user_name]) . '">view</a>
                    <button  class="btn btn-danger btn-sm show-modal" data-url ="' . route('user.delete', $data->id) . '">Delete</button>';
                    return $edit;
                })
                ->addColumn('checkbox',function($data){
                    $checkbox=  '<input type="checkbox" name="checkbox" class"checkbox" data-id="'.$data['id'].'" >';
                    return $checkbox;
                  })
                ->rawColumns([ 'user_name','email','mobile_no','status','status_paid', 'action','checkbox'])
                ->toJson();
        }

        return view('backend.pages.user.index');
    }



    public function status(Request $request, $id)
    {
        Member::find($id)->update($request->all());
        return response()->json(['success' => true, 'msg' =>'Member Status changes Successfully']);
    }


    public function delete($id)
    {
        return view('backend.pages.user.delete', compact('id'));
    }

    public function show($id)
    {
        $member=Member::findOrFail($id);
        return view('backend.pages.user.view', compact('member'));
    }
    public function destroy(Member $member)
    {
        if ($member->user_image) {
            unlink($member->user_image);
          }
        $member->delete();
        return response()->json(['success' => true, 'msg' =>  'Member Deleted Successfully']);
    }

    public function delete_all(Request $request)
    {
        $ids = $request->input('checked_id');
        return view('backend.pages.user.delete-all', compact('ids'));
    }

    public function destroy_all(Request $request)
    {
        $id_array = $request->input('ids');
        foreach($id_array as $id){
           $user = Member::find($id);
           if ($user->user_image) {
            unlink($user->user_image);
          }

          $user->delete();
        }
        return response()->json(['success' => true, 'msg' =>  'Member Deleted Successfully']);
    }
}
