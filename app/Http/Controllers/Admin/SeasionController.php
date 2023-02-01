<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Seasion;
use App\Models\Sesion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class SeasionController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data =Seasion::latest()->get();
            return DataTables::of($data)

            ->editColumn('seasion_name', function ($data) {
                return $data->seasion_name;
            })
            ->editColumn('slug', function ($data) {
                return $data->slug;
            })

                ->editColumn('status', function ($data) {
                    $button = 'btn-success';
                    if ($data->status == 0) {
                        $button = 'btn-danger';
                    }
                    $html = '<select class="btn-sm btn btn-rounded ' . $button . ' status-change" data-name="status" data-url="' . route('seasion.status', $data->id) . '">
                  <option value="1" ' . ($data->status == 1 ? "selected" : "") . '>Active</option>
                  <option value="0"' . ($data->status == 0 ? "selected" : "") . '>Inactive</option>
                </select>';
                    return  $html;
                })

                ->addColumn('action', function ($data) {
                    $edit = '<button  class="btn btn-sm btn-primary show-modal" data-url="' . route('seasion.edit', $data->id) . '" >Edit</button>
                    <button  class="btn btn-danger btn-sm show-modal" data-url ="' . route('seasion.delete', $data->id) . '">Delete</button>';
                    return $edit;
                })
                ->addColumn('checkbox',function($data){
                    $checkbox=  '<input type="checkbox" name="checkbox" class"checkbox" data-id="'.$data['id'].'" >';
                    return $checkbox;
                  })
                ->rawColumns([ 'seasion_name', 'slug','status','action','checkbox'])
                ->toJson();
        }

        return view('backend.pages.seasion.index');
    }


    public function create()
    {
        return view('backend.pages.seasion.create');
    }


    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'seasion_name' => 'required|unique:seasions,seasion_name',

        ]);
        if ($validation->fails()) {
            return response()->json(['msg' => 'Something went to wrong']);
        } else {

            Seasion::create([
                'seasion_name' => $request->seasion_name,
                'slug' => Str::slug($request->seasion_name),
                'seasion_desc'=> $request->seasion_desc,
                'created_at' => Carbon::now(),
            ]);
            return response()->json(['success' => true, 'msg' => Str::title($request->seasion_name) . ' ' . 'created successfully']);
        }
    }


    public function status(Request $request, $id)
    {
        Seasion::find($id)->update($request->all());
        return response()->json(['success' => true, 'msg' =>'Seasion Status changes Successfully']);
    }


    public function edit(Seasion $seasion)
    {
        return view('backend.pages.seasion.edit', compact('seasion'));
    }


    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'seasion_name' => 'required|unique:seasions,seasion_name,'.$id,
        ]);
        if ($validation->fails()) {
            return response()->json(['error' => false, 'msg' => 'Something went to wrong']);
        } else {
            $seasion=Seasion::findOrFail($id);
            $seasion->update([
                'seasion_name' => $request->seasion_name,
                'slug' => Str::slug($request->seasion_name),
                'seasion_desc' => $request->seasion_desc,
                'updated_at' => Carbon::now()

            ]);
            return response()->json(['success' => true, 'msg' => Str::title($request->seasion_name) . ' ' . 'updated successfully']);
        }
    }

    public function delete($id)
    {
        return view('backend.pages.seasion.delete', compact('id'));
    }
    public function destroy(Seasion $seasion)
    {
        $seasion->delete();
        return response()->json(['success' => true, 'msg' =>  'Seasion Deleted Successfully']);
    }

    public function delete_all(Request $request)
    {
        $ids = $request->input('checked_id');
        return view('backend.pages.seasion.delete-all', compact('ids'));
    }

    public function destroy_all(Request $request)
    {
        $id_array = $request->input('ids');
        foreach($id_array as $id){
           $seasion = Seasion::find($id);
          $seasion->delete();
        }
        return response()->json(['success' => true, 'msg' =>  'Seasion Deleted Successfully']);
    }
}
