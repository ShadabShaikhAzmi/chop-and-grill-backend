<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use RespondsWithHttpStatus;

    public function add(Request $request){

        $validator = Validator::make($request->all(), [
            'categories_name' => 'required',
            'image' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->failure($validator->errors()->first());       
        }

        $isExists = Category::where('categories_name', $request->categories_name)->first();
        if($isExists !== null){
            return $this->failure($request->categories_name .' Category already exists');
        }
        $category = new Category();
        $category->categories_name = $request->categories_name;
        $category->parent_id = $request->parent_category;
        if($category->save()){
            if($request->hasFile('image') && $request->file('image')->isValid()){
                $category->addMediaFromRequest('image')->toMediaCollection('category_image');
            }
            return $this->success('Saved Successfully.', ["name" => $category->categories_name]);
        }else{
            return $this->failure('Error occured!');
        }
    }

    public function update(Request $request, $id){
        
        $validator = Validator::make($request->all(), [
            'categories_name' => 'required',
            'image' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->failure($validator->errors()->first());       
        }

        $category =  Category::find($id);
        if($category === null){
            return $this->failure('Category not exists');
        }
        
        $category->categories_name = $request->categories_name;
        $category->parent_id = $request->parent_category;
        if($category->update()){
            if($request->hasFile('image') && $request->file('image')->isValid()){
                $category->addMediaFromRequest('image')->toMediaCollection('category_image');
            }
            return $this->success('Updated Successfully.', ["name" => $category->categories_name]);
        }else{
            return $this->failure('Error occured!');
        }
    }

    public function delete($id){
        $category =  Category::find($id);
        if($category === null){
            return $this->failure('Category not exists');
        }
        if($category->delete()){
            return $this->success('Deleted Successfully.', ["name" => $category->categories_name]);
        }else{
            return $this->failure('Error occured!');
        }
    }

    public function index($parent_id = NULL){
        $mainArray = [];
        $categories = Category::where('parent_id', $parent_id)->with('media')->get(['id', 'categories_name', 'parent_id']);
        foreach($categories as $category){
            $children = $this->index($category->id);
            $category['categories'] = $children;
            array_push($mainArray, $category);
        }
        return $mainArray;
    }

}
