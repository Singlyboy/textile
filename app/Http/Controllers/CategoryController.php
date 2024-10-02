<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function category()
    {
        
        $allCategory=Category::paginate(5);
       
       return view('backend.category',compact('allCategory'));   
    }

    public function form()
    {
        return view('backend.category-form');    
    }

    public function store(Request $request)
    {

        $validation=Validator::make($request->all(),
        [
            'cat_name'=>'required|min:2',
        ]);
        
      if($validation->fails())
      {
        notify()->error($validation->getMessageBag());
        return redirect()->back();
      }


        Category::create([
           
            'name'=>$request->cat_name,
            'description'=>$request->cat_description
        ]);

        return redirect()->back();

    }
    public function delete($id)
{

    // category::find($id)->delete();
    $allCategory=Category::find($id);//data entry
    $allCategory->parts()->delete();
    $allCategory->delete();//delete done

    notify()->success('category Deleted successfully.');

    return redirect()->back();

    
}
public function edit($id)
{

    $allCategory=Category::find($id);
   
    return view('backend.page.category-edit',compact('allCategory'));
}

public function update(Request $request,$id)
{
    

    //validation
    $validation=Validator::make($request->all(),
    [
        'cat_name'=>'required|min:2',
    ]);


    //query
    $allCategory=Category::find($id);
    $allCategory->update([
        'name'=>$request->cat_name,
        'description'=>$request->cat_description
    ]);
  
    notify()->success('category updated successfully.');
    return redirect()->route('category.list');


}
}
