<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function list(Request $request)
    {  
        $skills = Skill::orderBy('created_at', 'desc')->get();
        return view('admin.skill.list', compact('skills'));
    }
    public function edit($id)
    {  
        $skills = Skill::find($id);
        return view('admin.skill.create',compact('skills'));
    }
    public function store(Request $request)
    {  
        $rules = [
            'name' => 'required',
        ];  
        $messages = [
            'name.required' => 'Category name is required!',
        ];  
        $validator = Validator::make($request->all(), $rules,$messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();    
        }
        $skill= new Skill;
        $skill->name = $request->name;
        $skill->save();
        return redirect()->route('skill.list')->with('success', 'Skill added successfully.');
    }
    public function update(Request $request,$id)
    {  
        $rules = [
            'name' => 'required',
        ];  
        $messages = [
            'name.required' => 'Category name is required!',
        ];  
        $validator = Validator::make($request->all(), $rules,$messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();    
        }
        $skill = Skill::find($id);
        $skill->name = $request->name;
        $skill->save();
        return redirect()->route('skill.list')->with('success', 'Skill updated successfully.');

    }
    public function destroy($id)
    {
     $skill = Skill::findOrFail($id);
     $skill->delete();
     return redirect()->back()->with('success', 'Skill deleted successfully.');
    }
    public function status_update(Request $request)
    {
        Skill::where(['id' => $request['skillId']])->update([
            'status' => $request['isChecked']
        ]);

        $response = array(
            'message' => 'Skill status updated successfully.',
            'alert-type' => 'success'
        );
        return response()->json($response);
    }
    public function view($id)
    {
     $skills = Skill::findOrFail($id);
     return view('admin.skill.view', compact('skills'));
    }
}
