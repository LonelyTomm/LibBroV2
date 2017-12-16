<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function indexFunc($page=1){
    	$books=DB::table('books')->get();
    	$count=$books->count();
    	if($count>((intval($count/16))*16)){
    		$pages=(intval($count/16))+1;
    	}else{
    		$pages=intval($count/16);
    	}
    	$firstBook=(16*($page-1));
    	if($page=$pages){
    		$lastBook=$count-1;
    	}else{
    		$lastBook=$firstBook+14;
    	}
    	if($page<=$pages){
    		return view('home',['books'=>$books,'count'=>$count,'pages'=>$pages,'page'=>$page,'firstBook'=>$firstBook,'lastBook'=>$lastBook]);
    	}else{
    		return view('error',['error'=>"Page Doesn't exist!"]);
    	}
    	
    }

    public function getDescription($id){
    	$books=DB::table('books')->where('id','=',$id)->get();
    	if($books[0]->id!=null){
    		$book=$books[0];
    		return view('description',['book'=>$book]);
    	}els{
    		return view('error',['error'=>"No book with such id!"]);
    	}
    }
}
