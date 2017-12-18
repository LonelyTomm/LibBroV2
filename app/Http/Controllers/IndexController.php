<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

use Auth;

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
    	}else{
    		return view('error',['error'=>"No book with such id!"]);
    	}
    }

    public function logOut(){
    	Auth::logout();
    	return redirect('/index');
    }

    public function getGenre($genre,$page=1){
    	switch($genre){
    		case 'history':
    			$books=DB::table('books')->where('genre','like','%history;%')->get();
    			break;

    		case 'thriller':
    			$books=DB::table('books')->where('genre','like','%thriller;%')->get();
    			break;

    		case 'romance&erotica':
    			$books=DB::table('books')->where('genre','like','%romance/erotica;%')->get();
    			break;

    		case 'satire':
    			$books=DB::table('books')->where('genre','like','%satire;%')->get();
    			break;

    		case 'horror':
    			$books=DB::table('books')->where('genre','like','%horror;%')->get();
    			break;

    		case 'religious&inspirational':
    			$books=DB::table('books')->where('genre','like','%religious/inspirational;%')->get();
    			break;

    		case 'health&medicine':
    			$books=DB::table('books')->where('genre','like','%health/medicine;%')->get();
    			break;

    		case 'childrens':
    			$books=DB::table('books')->where('genre','like','%childrens;%')->get();
    			break;

    		case 'dictionary':
    			$books=DB::table('books')->where('genre','like','%dictionary;%')->get();
    			break;

    		default:
    			return view('error',['error'=>'No such genre!']);
    			break;

    	}

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
    	if(($page<=$pages)&&($count>0)){
    		return view('home',['books'=>$books,'count'=>$count,'pages'=>$pages,'page'=>$page,'firstBook'=>$firstBook,'lastBook'=>$lastBook]);
    	}elseif($page>$pages){
    		return view('error',['error'=>"Page Doesn't exist!"]);
    	}else{
    		return view('error',['error'=>"No books found!"]);
    	}
    }

    public function find(Request $request,$page=1){
    	$data=$request->validate([
    		'searchQuery'=>'required',
    	]);

    	$query=$request->input('searchQuery');

    	$books=DB::table('books')->whereRaw("lower(title) like '%".strtolower($query)."%'")->orWhereRaw("lower(author) like '%".strtolower($query)."%'")->get();

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
    	if(($page<=$pages)&&($count>0)){
    		return view('home',['books'=>$books,'count'=>$count,'pages'=>$pages,'page'=>$page,'firstBook'=>$firstBook,'lastBook'=>$lastBook]);
    	}elseif($page>$pages){
    		return view('error',['error'=>"Page Doesn't exist!"]);
    	}else{
    		return view('error',['error'=>"No books found!"]);
    	}
    }
}
