<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use DB;

class ApiController extends Controller
{
  public $successStatus = 200;
  public $notFoundStatus = 404;
    function getUser(){
    	$users = DB::table('users')->get();
        return response()->json($users, $this->successStatus);
    }
    
}