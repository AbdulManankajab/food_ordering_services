<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{
    // Item Section
	public function getItems(){
		$item = Item::join('menus', 'menus.id', '=', 'items.menu_id')->select('items.*', 'menus.menu_name')->get();
    	return response()->json($item, 200);
	}

	public function storeItem(Request $request){
		$rules = [
			'item_name' => 'required|string|min:3|max:255',
			'image' => 'required|image|mimes:jpeg,png,jpg,|max:2048',
			'menu_id' => 'required',
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return response()->json($validator, 404);
		}
		else{
			$imageName = time().'.'.$request->image->extension();  
        	$request->image->move(public_path('images'), $imageName);

            $data = $request->input();
			try{
				$item = new Item;
                $item->item_name = $data['item_name'];
                $item->image = $imageName;
                $item->menu_id = $data['menu_id'];
				$item->save();
				return response()->json("Insert successfully", 200);
			}
			catch(Exception $e){
				return response()->json("operation failed", 404);
			}
		}
    }

    public function updateItem(Request $request){
    	$rules = [
			'item_name' => 'required|string|min:3|max:255',
			// 'image' => 'required|string|min:3|max:255',
			'menu_id' => 'required',
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return response()->json($validator, 404);
		}
		else{
            $data = $request->input();
			try{
				$item = Item::find($data['id']);
                $item->item_name = $data['item_name'];
                $item->menu_id = $data['menu_id'];
				$item->save();
				return response()->json("Updated successfully", 200);
			}
			catch(Exception $e){
				return response()->json("operation failed", 404);
			}
		}
    }

    public function deleteItem($id){
    	try{
			$item = Item::find($id);	
			$item->delete();
			return response()->json("Deleted successfully", 200);
		}
		catch(Exception $e){
			return response()->json("operation failed", 404);
		}
    }

    public function getItem($id){
    	$item = Item::join('menus', 'menus.id', '=', 'items.menu_id')->select('items.*', 'menus.menu_name')->where('items.id', $id)->first();
    	return response()->json($item, 200);
    }

    public function getNumOfCatForEachItem($id){
		$menu = Item::join('categories as c', 'c.item_id', '=', 'items.id')->where('items.id', $id)->count();
    	return response()->json($menu, 200);
    }
}
