<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Optionsetting;
use App\Models\Payment;
use Illuminate\Http\Request;

class OptionsettingController extends Controller
{
    public function option_setting()
    {
        $option = Option::get();
        $option_modify = [];
        foreach($option as $_option){
            $option_modify[ $_option->name ] = $_option->value;
        }

        return view('backend.pages.option-setting.option',compact('option_modify'));
    }
    public function option_setting_post(Request $request)
    {

        $data = $request->all();
        unset($data['_token']);
        foreach ($data as $key => $value) {
            $this->option_add($key, $value);
        }
        return back()->with('success', 'Option setting details updated successfully');
    }


    protected function option_add($key, $value)
    {
        $option = Option::where('name', $key)->get();
        $option = $option[0] ?? null;
        if ($option) {
            $id =   $option->id;
            $exists_value = $option->value;
            if ($exists_value != $value) {
                $this->option_update($id, $value);
            }
        } else {
            Option::create(['name' => $key, 'value' => $value]);
        }
    }

    protected function option_update($id, $value)
    {
        Option::where('id', $id)->update([
            'value' => $value
        ]);
    }

    protected function option_delete($id)

    {
    }
}
