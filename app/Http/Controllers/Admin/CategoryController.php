<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data =Category::latest()->get();
            return DataTables::of($data)
            ->editColumn('name', function ($data) {
                return $data->name;
            })
            ->editColumn('slug', function ($data) {
                return $data->slug;
            })


                ->editColumn('status', function ($data) {
                    $button = 'btn-success';
                    if ($data->status == 0) {
                        $button = 'btn-danger';
                    }
                    $html = '<select class="btn-sm btn btn-rounded ' . $button . ' status-change" data-name="status" data-url="' . route('category.status', $data->id) . '">
                  <option value="1" ' . ($data->status == 1 ? "selected" : "") . '>Active</option>
                  <option value="0"' . ($data->status == 0 ? "selected" : "") . '>Inactive</option>
                </select>';
                    return  $html;
                })

                ->addColumn('action', function ($data) {
                    $edit = '<button  class="btn btn-sm btn-primary show-modal" data-url="' . route('category.edit', $data->id) . '" >Edit</button>
                    <button  class="btn btn-danger btn-sm show-modal" data-url ="' . route('category.delete', $data->id) . '">Delete</button>';
                    return $edit;
                })
                ->addColumn('checkbox',function($data){
                    $checkbox=  '<input type="checkbox" name="checkbox" class"checkbox" data-id="'.$data['id'].'" >';
                    return $checkbox;
                  })
                ->rawColumns([ 'name','slug', 'status', 'action','checkbox'])
                ->toJson();
        }

        return view('backend.pages.category.index');
    }


    public function create()
    {

        return view('backend.pages.category.create',[
            'select' => $this->make_selection_markup(
                $this->get_category_hirarchy()
            )
        ]);
    }


    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name',
        ]);
        if ($validation->fails()) {
            return response()->json(['msg' => 'Something went to wrong']);
        } else {
            Category::insert([
                'name' => Str::title($request->name),
                'slug' => Str::slug($request->name),
                'parent' => $request->parent,
                'show_frontpage' => $request->show_frontpage ?? '0',
                'description' => $request->description,
                'hide_on_menu' => $request->hide_on_menu  ?? '0',
                'created_at' => Carbon::now(),
            ]);
            return response()->json(['success' => true, 'msg' => Str::title($request->name) . ' ' . 'created successfully']);
        }
    }


    public function status(Request $request, $id)
    {
        Category::find($id)->update($request->all());
        return response()->json(['success' => true, 'msg' =>'Category Status changes Successfully']);
    }


    public function edit(Category $category)
    {
        return view('backend.pages.category.edit',[
            'category' => $category,
            'select' => $this->make_selection_markup(
                $this->get_category_hirarchy(),$category->parent
            )
        ]);
    }


    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name,'.$id,
        ]);
        if ($validation->fails()) {
            return response()->json(['error' => false, 'msg' => 'Something went to wrong']);
        } else {
            $category=Category::findOrFail($id);

            $category->update([

                'name' => Str::title($request->name),
                'slug' => Str::slug($request->name),
                'parent' => $request->parent == $id ? '0' : $request->parent,
                'show_frontpage' => $request->show_frontpage ?? '0',
                'description' => $request->description,
                'hide_on_menu' => $request->hide_on_menu  ?? '0',
                'updated_at' => Carbon::now(),

            ]);
            return response()->json(['success' => true, 'msg' => Str::title($request->name) . ' ' . 'updated successfully']);
        }
    }

    public function delete($id)
    {
        return view('backend.pages.category.delete', compact('id'));
    }
    public function destroy(Category $category)
    {

        $category->delete();
        return response()->json(['success' => true, 'msg' =>  'Category deleted successfully']);
    }

    public function delete_all(Request $request)
    {
        $ids = $request->input('checked_id');
        return view('backend.pages.category.delete-all', compact('ids'));
    }

    public function destroy_all(Request $request)
    {
        $id_array = $request->input('ids');
        foreach($id_array as $id){
           $category = Category::find($id);

          $category->delete();
        }
        return response()->json(['success' => true, 'msg' =>  'Category seleted successfully']);
    }

    /**
     * Get all category form category table base on its parents
     * Default parent is 0
     * @param $parent refers to category parent
     * @return $crunchify_category an array contains all categoris with its children
     */
    protected function get_category_hirarchy( $parent = 0 ) 
    {
        $categories = Category::where('parent',$parent)->get();

        $crunchify_category = [];

        if ( ! empty($categories) ) {

            foreach ($categories as $category) 
            {
                $crunchify_category[] = [
                    'id'        => $category->id,
                    'name'      => $category->name,
                    'children'  => $this->get_category_hirarchy($category->id),
                ];
            }
            
        }

       return $crunchify_category;

    }

    /**
     * Make select option markup here
     * @param $category referes to all categroy gettin form database
     * @return $options refers to all aoptions
     */
    public function make_selection_markup( $categories,$toSelect = '',$sepeartor = '' ) 
    {
        $options = "";

        foreach ($categories as $category) {

            $toSelected = '';

            if ( $toSelect == $category['id'] ) {
                $toSelected = 'selected';
            } 


            $options .= sprintf("<option %s value='%s'>%s%s</option>",$toSelected,$category['id'],$sepeartor,$category['name']);
            
            if ( ! empty($category['children']) ) {
                $options .= $this->make_selection_markup( $category['children'],$toSelect, $sepeartor . ' — ' );
            }
        }

        return $options;
        
    }
}