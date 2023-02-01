<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Seasion;
use App\Models\Sesion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class EpisodeController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data =Episode::latest()->get();
            return DataTables::of($data)
            ->addColumn('cover_photo', function ($data) {
                if ($data->cover_photo == null) {
                 return '<span class="badge rounded-pill text-bg-secondary">N/A</span>';
                } else {
                    return '<img src="' . asset($data->cover_photo) . '" width="100px" height="50px" alt="">';
                }
            })

            ->editColumn('name', function ($data) {
                return $data->name;
            })
            ->editColumn('release_year', function ($data) {
                return $data->release_year;
            })
            ->editColumn('relese_date', function ($data) {
                return $data->relese_date;
            })
            ->editColumn('drive_id', function ($data) {
                return $data->drive_id;
            })
            ->editColumn('api_key', function ($data) {
                return $data->api_key;
            })
            ->editColumn('quality', function ($data) {
                return json_decode($data->quality);
            })
            ->editColumn('seasion_id', function ($data) {
                return $data->seasion->seasion_name;
            })



                ->editColumn('status', function ($data) {
                    $button = 'btn-success';
                    if ($data->status == 0) {
                        $button = 'btn-danger';
                    }
                    $html = '<select class="btn-sm btn btn-rounded ' . $button . ' status-change" data-name="status" data-url="' . route('episode.status', $data->id) . '">
                  <option value="1" ' . ($data->status == 1 ? "selected" : "") . '>Active</option>
                  <option value="0"' . ($data->status == 0 ? "selected" : "") . '>Inactive</option>
                </select>';
                    return  $html;
                })

                ->addColumn('action', function ($data) {
                    $edit = '<button  class="btn btn-sm btn-primary show-modal" data-url="' . route('episode.edit', $data->id) . '" >Edit</button>
                    <button  class="btn btn-danger btn-sm show-modal" data-url ="' . route('episode.delete', $data->id) . '">Delete</button>';
                    return $edit;
                })
                ->addColumn('checkbox',function($data){
                    $checkbox=  '<input type="checkbox" name="checkbox" class"checkbox" data-id="'.$data['id'].'" >';
                    return $checkbox;
                  })
                ->rawColumns([ 'cover_photo','seasion_id','name', 'release_year','relese_date','api_key','status','quality', 'action','checkbox'])
                ->toJson();
        }

        return view('backend.pages.episode.index');
    }


    public function create()
    {
        return view('backend.pages.episode.create',[
            'seasions'=>Seasion::all(),
        ]);
    }


    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:episodes,name',
            'cover_photo' => 'required|image',
            'release_year' => 'required',
            'relese_date' => 'required',
            'seasion_id' => 'required',
            'quality' => 'required',
            'drive_id' => 'required',
        ]);
        if ($validation->fails()) {
            return response()->json(['msg' => 'Something went to wrong']);
        } else {
            $image = null;
            if($request->hasFile('cover_photo')) {
                $image = $request->file('cover_photo');
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(270,400)->save('frontend/assets/image/episode/' . $name_gen);
                $image = 'frontend/assets/image/episode/' . $name_gen;
            }
                Episode::create([
                'seasion_id' => $request->seasion_id,
                'name' => Str::title($request->name),
                'slug' => Str::slug($request->name),
                'relese_date' => $request->relese_date,
                'drive_id' => $request->drive_id,
                'release_year' => $request->release_year,
                'api_key' => $request->api_key,
                'description' => $request->description,
                'quality' => json_encode($request->quality),
                'cover_photo' => $image,
                'created_at' => Carbon::now(),
            ]);
            return response()->json(['success' => true, 'msg' => Str::title($request->name) . ' ' . 'created successfully']);
        }
    }


    public function status(Request $request, $id)
    {
        Episode::find($id)->update($request->all());
        return response()->json(['success' => true, 'msg' =>'Episode Status changes Successfully']);
    }


    public function edit(Episode $episode)
    {
        return view('backend.pages.episode.edit',
        [
            'seasions'=>Seasion::all(),
        ], compact('episode'));
    }


    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:episodes,name,'.$id,
        ]);
        if ($validation->fails()) {
            return response()->json(['error' => false, 'msg' => 'Something went to wrong']);
        } else {
            $episodes=Episode::findOrFail($id);
            $image=$episodes->cover_photo;
            if($request->hasFile('cover_photo')) {
                $image = $request->file('cover_photo');
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(270,400)->save('frontend/assets/image/episode/' . $name_gen);
                $image = 'frontend/assets/image/episode/' . $name_gen;
                if ($episodes->cover_photo != null) {
                    unlink($episodes->cover_photo);
                }
            }
            $episodes->update([
                'seasion_id' => $request->seasion_id,
                'name' => Str::title($request->name),
                'slug' => Str::slug($request->name),
                'relese_date' => $request->relese_date,
                'drive_id' => $request->drive_id,
                'release_year' => $request->release_year,
                'api_key' => $request->api_key,
                'description' => $request->description,
                'quality' => json_encode($request->quality),
                'cover_photo' => $image,
                'updated_at' => Carbon::now()

            ]);
            return response()->json(['success' => true, 'msg' => Str::title($request->name) . ' ' . 'updated successfully']);
        }
    }

    public function delete($id)
    {
        return view('backend.pages.episode.delete', compact('id'));
    }
    public function destroy(Episode $episode)
    {
        if ($episode->cover_photo) {
            unlink($episode->cover_photo);
          }
        $episode->delete();
        return response()->json(['success' => true, 'msg' =>  'Episode Deleted Successfully']);
    }

    public function delete_all(Request $request)
    {
        $ids = $request->input('checked_id');
        return view('backend.pages.episode.delete-all', compact('ids'));
    }

    public function destroy_all(Request $request)
    {
        $id_array = $request->input('ids');
        foreach($id_array as $id){
           $episode = Episode::find($id);
           if ($episode->cover_photo) {
            unlink($episode->cover_photo);
          }
          $episode->delete();
        }
        return response()->json(['success' => true, 'msg' =>  'Episode Deleted Successfully']);
    }
}
