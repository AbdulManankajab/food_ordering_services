<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categories;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    // Categories Section
	public function getCategories(){
		$category = Categories::join('items', 'items.id', '=', 'Categories.item_id')->select('Categories.*', 'items.item_name', 'items.image', 'items.menu_id')->get();
    	return response()->json($category, 200);
	}

	public function storeCategories(Request $request){
		$rules = [
			'cat_name' => 'required|string|min:3|max:255',
			'prices' => 'required',
			'location' => 'required|string|min:3|max:255',
			'condation' => 'required|string|min:3|max:255',
			'brand' => 'required|string|min:3|max:255',
			'description' => 'required|string|min:3|max:255',
			'item_id' => 'required',
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return response()->json($validator, 404);
		}
		else{
            $data = $request->input();
			try{
				$category = new Categories;
                $category->cat_name = $data['cat_name'];
                $category->prices = $data['prices'];
                $category->location = $data['location'];
                $category->condation = $data['condation'];
                $category->brand = $data['brand'];
                $category->description = $data['description'];
                $category->item_id = $data['item_id'];
				$category->save();
				return response()->json("Insert successfully", 200);
			}
			catch(Exception $e){
				return response()->json("operation failed", 404);
			}
		}
    }

    public function updateCategories(Request $request){
    	$rules = [
			'cat_name' => 'required|string|min:3|max:255',
			'prices' => 'required',
			'location' => 'required|string|min:3|max:255',
			'condation' => 'required|string|min:3|max:255',
			'brand' => 'required|string|min:3|max:255',
			'description' => 'required|string|min:3|max:255',
			'item_id' => 'required',
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return response()->json($validator, 404);
		}
		else{
            $data = $request->input();
			try{
				$category = Categories::find($data['id']);
                $category->cat_name = $data['cat_name'];
                $category->prices = $data['prices'];
                $category->location = $data['location'];
                $category->condation = $data['condation'];
                $category->brand = $data['brand'];
                $category->description = $data['description'];
                $category->item_id = $data['item_id'];
				$category->save();
				return response()->json("Updated successfully", 200);
			}
			catch(Exception $e){
				return response()->json("operation failed", 404);
			}
		}
    }

    public function deleteCategories($id){
    	try{
			$category = Categories::find($id);	
			$category->delete();
			return response()->json("Deleted successfully", 200);
		}
		catch(Exception $e){
			return response()->json("operation failed", 404);
		}
    }

    public function getCategory($id){
		$category = Categories::join('items', 'items.id', '=', 'Categories.item_id')->select('Categories.*', 'items.item_name', 'items.image', 'items.menu_id')->where('Categories.id', $id)->first();
    	return response()->json($category, 200);
    }
}
