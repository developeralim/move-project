<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Movie;
use App\Models\Seasion;
use App\Models\Sesion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class MovieController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data =Movie::latest()->get();
            return DataTables::of($data)
            ->addColumn('cover_photo', function ($data) {
                if ($data->cover_photo == null) {
                } else {
                    return '<img src="' . asset($data->cover_photo) . '" width="100px" height="50px" alt="">';
                }
            })

            ->editColumn('name', function ($data) {
                return $data->name;
            })
            ->editColumn('relese_year', function ($data) {
                return $data->relese_year;
            })
            ->editColumn('running_time_minute', function ($data) {
                return $data->running_time_minute;
            })
            ->editColumn('quality', function ($data) {
                return json_decode($data->quality);
            })
                ->editColumn('status', function ($data) {
                    $button = 'btn-success';
                    if ($data->status == 0) {
                        $button = 'btn-danger';
                    }
                    $html = '<select class="btn-sm btn btn-rounded ' . $button . ' status-change" data-name="status" data-url="' . route('movie.status', $data->id) . '">
                  <option value="1" ' . ($data->status == 1 ? "selected" : "") . '>Active</option>
                  <option value="0"' . ($data->status == 0 ? "selected" : "") . '>Inactive</option>
                </select>';
                    return  $html;
                })

                ->addColumn('action', function ($data) {
                    $edit = '<button  class="btn btn-sm btn-primary show-modal" data-url="' . route('movie.edit', $data->id) . '" >Edit</button>
                    <button  class="btn btn-danger btn-sm show-modal" data-url ="' . route('movie.delete', $data->id) . '">Delete</button>';
                    return $edit;
                })
                ->addColumn('checkbox',function($data){
                    $checkbox=  '<input type="checkbox" name="checkbox" class"checkbox" data-id="'.$data['id'].'" >';
                    return $checkbox;
                  })
                ->rawColumns([ 'cover_photo','name', 'relese_year','running_time_minute','status','quality', 'action','checkbox'])
                ->toJson();
        }

        return view('backend.pages.movie.index');
    }


    public function create()
    {
        return view('backend.pages.movie.create',[
            'categories'=>Category::all(),
            'seasions'=>Seasion::all(),
        ]);
    }


    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:movies,name',
            'cover_photo' => 'required|image',
            'quality' => 'required',
        ]);
        if ($validation->fails()) {
            return response()->json(['msg' => 'Something went to wrong']);
        } else {
            
            $poster_image   = null;
            $image          = null;

            if($request->hasFile('cover_photo')) {
                $image = $request->file('cover_photo');

                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $poster_image_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

                Image::make($image)->resize(500,464)->save('frontend/assets/image/cover_photo/' . $name_gen);
                Image::make($image)->resize(640,400)->save('frontend/assets/image/cover_photo/' . $poster_image_gen);

                $image = 'frontend/assets/image/cover_photo/' . $name_gen;
                $poster_image =  'frontend/assets/image/cover_photo/' . $poster_image_gen;
            }

           $movie= Movie::create([
                'admin_id' => Auth::id(),
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'running_time_minute' => $request->running_time_minute,
                'country' => $request->country,
                'age' => $request->age,
                'drive_id' => $request->drive_id,
                'relese_year' => $request->relese_year,
                'api_key' => $request->api_key,
                'movie_review' => $request->movie_review,
                'description' => $request->description,
                'quality' => $request->quality,
                'cover_photo' => $image,
                'poster_image' => $poster_image,
                'created_at' => Carbon::now(),
            ]);
            $movie->categories()->attach($request->category_id);
            $movie->seasions()->attach($request->seasion_id);
            return response()->json(['success' => true, 'msg' => Str::title($request->name) . ' ' . 'created successfully']);
        }
    }


    public function status(Request $request, $id)
    {
        Movie::find($id)->update($request->all());
        return response()->json(['success' => true, 'msg' =>'Movie Status changes Successfully']);
    }


    public function edit(Movie $movie)
    {
        return view('backend.pages.movie.edit',
        [
            'categories'=>Category::all(),
            'seasions'=>Seasion::all(),
        ], compact('movie'));
    }


    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:movies,name,'.$id,
        ]);
        if ($validation->fails()) {
            return response()->json(['error' => false, 'msg' => 'Something went to wrong']);
        } else {
            $movie          = Movie::findOrFail($id);
            $poster_image   = $movie->poster_image;
            $image          = $movie->cover_photo;

            if($request->hasFile('cover_photo')) {

                $image = $request->file('cover_photo');


                $name_gen           = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $poster_image_gen   = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

                Image::make($image)->resize(500,464)->save('frontend/assets/image/cover_photo/' . $name_gen);
                Image::make($image)->resize(640,400)->save('frontend/assets/image/cover_photo/' . $poster_image_gen);


                $image        = 'frontend/assets/image/cover_photo/' . $name_gen;
                $poster_image = 'frontend/assets/image/cover_photo/' . $$poster_image_gen;


@unlink($movie->cover_photo);
@unlink($movie->poster_image);

            }
            $movie->update([
                'admin_id' => Auth::id(),
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'running_time_minute' => $request->running_time_minute,
                'country' => $request->country,
                'age' => $request->age,
                'drive_id' => $request->drive_id,
                'relese_year' => $request->relese_year,
                'api_key' => $request->api_key,
                'movie_review' => $request->movie_review,
                'description' => $request->description,
                'quality' => $request->quality,
                'cover_photo' => $image,
                'updated_at' => Carbon::now()

            ]);
            $movie->categories()->sync($request->category_id);
            $movie->seasions()->sync($request->seasion_id);
            return response()->json(['success' => true, 'msg' => Str::title($request->title) . ' ' . 'updated successfully']);
        }
    }

    public function delete($id)
    {
        return view('backend.pages.movie.delete', compact('id'));
    }
    public function destroy(Movie $movie)
    {
        if ($movie->cover_photo) {
            unlink($movie->cover_photo);
          }
        $movie->categories()->detach();
        $movie->seasions()->detach();
        $movie->delete();
        return response()->json(['success' => true, 'msg' =>  'Movie Deleted Successfully']);
    }

    public function delete_all(Request $request)
    {
        $ids = $request->input('checked_id');
        return view('backend.pages.movie.delete-all', compact('ids'));
    }

    public function destroy_all(Request $request)
    {
        $id_array = $request->input('ids');
        foreach($id_array as $id){
           $movie = Movie::find($id);
           if ($movie->cover_photo) {
            unlink($movie->cover_photo);
          }
          $movie->categories()->detach();
          $movie->seasions()->detach();
          $movie->delete();
        }
        return response()->json(['success' => true, 'msg' =>  'Movie Deleted Successfully']);
    }
}