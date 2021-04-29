<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Menu;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MenuController extends Controller
{

	// Menu Section
	public function getMenu(){
		$menu = Menu::all();
    	return response()->json($menu, 200);
	}

	public function storeMenu(Request $request){
		$rules = [
			'menu_name' => 'required|string|min:3|max:255',
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return response()->json($validator, 404);
		}
		else{
            $data = $request->input();
			try{
				$menu = new Menu;
                $menu->menu_name = $data['menu_name'];
				$menu->save();
				return response()->json("Insert successfully", 200);
			}
			catch(Exception $e){
				return response()->json("operation failed", 404);
			}
		}
    }

    public function updateMenu(Request $request){
    	$rules = [
			'menu_name' => 'required|string|min:3|max:255',
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return response()->json($validator, 404);
		}
		else{
            $data = $request->input();
			try{
				$menu = Menu::find($data['id']);
                $menu->menu_name = $data['menu_name'];
				$menu->save();
				return response()->json("Updated successfully", 200);
			}
			catch(Exception $e){
				return response()->json("operation failed", 404);
			}
		}
    }

    public function deleteMenu($id){
    	try{
			$menu = Menu::find($id);	
			$menu->delete();
			return response()->json("Deleted successfully", 200);
		}
		catch(Exception $e){
			return response()->json("operation failed", 404);
		}
    }

    public function getNumOfItems($id){
		$menu = Menu::join('items', 'items.menu_id', '=', 'menus.id')->where('menus.id', $id)->count();
    	return response()->json($menu, 200);
    }
}
