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

    public function modifyBook($id){
    	if(Auth::check()&&(Auth::user()->type=='M')){
    		$book=DB::table('books')->where('id','=',$id)->get();
    		if($book[0]->id!=null){
    			return view('modify',['book'=>$book[0]]);
    		}else{
    			return view('error',['error'=>"No book with such id!"]);
    		}
    	}else{
    		return view('error',['error'=>"You don't have rights to modify books!"]);
    	}
    }

    public function modifyBookPost($id,Request $request){
    	if(Auth::check()&&(Auth::user()->type=='M')){
    		$data=$request->validate([
    			"imgpath"=>"required|image",
    			"author"=>"required|string",
    			"publisher"=>"required|string",
    			"title"=>"required|string",
    			"quantity"=>"required|integer|min:0",
    			"description"=>"required|string",
    			"genre"=>"required",
    		]);
    		$md5Name = md5_file($request->file('imgpath')->getRealPath());
    		$guessExtension = $request->file('imgpath')->extension();
    		$file = $request->file('imgpath')->storeAs('uploads', $md5Name.'.'.$guessExtension,'public');
    		$author=$request->input('author');
    		$publisher=$request->input('publisher');
    		$title=$request->input('title');
    		$quantity=$request->input('quantity');
    		$description=$request->input('description');
    		$genre=implode(";", $request->genre).";";
    		DB::table('books')->where('id','=',$id)->update(
    			["imgpath"=>$md5Name.'.'.$guessExtension,"author"=>$author,"publisher"=>$publisher,
    			"title"=>$title,"quantity"=>$quantity,"description"=>$description,"genre"=>$genre]
    		);
    		return view('success',['success'=>"Book was modified successfully!"]);
    	}else{
    		return view('error',['error'=>"You are not allowed to modify books!"]);
    	}
    }

    public function showBorrowLog(){
    	if(Auth::check()&&(Auth::user()->type=='M')){
    		$books=DB::table('userbooks')->get();
    		if($books[0]->ubid!=null){
    			$borrInfo=array();
    			foreach ($books as $borrbook) {
    				$book=DB::table('books')->where('id','=',$borrbook->bid)->get();
    				$user=DB::table('users')->where('id','=',$borrbook->uid)->get();
    				if($borrbook->return_date!=null){
    					array_push($borrInfo,array($book[0]->title,$book[0]->author,$user[0]->name,$user[0]->login,$borrbook->borrow_date,$borrbook->return_date));
    				}else{
    					array_push($borrInfo,array($book[0]->title,$book[0]->author,$user[0]->name,$user[0]->login,$borrbook->borrow_date,'-'));
    				}
    			}
    			return view('borrowlog',['borrInfo'=>$borrInfo]);
    		}else{
    			return view('error',['error'=>"No books was borrowed yet!"]);
    		}
    	}else{
    		return view('error',['error'=>"You are not allowed to see borrow log!"]);
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

    public function returnBook($id){
    	if(Auth::check()&&(Auth::user()->type=='S')){
    		$borrBook=DB::table('userbooks')->where('ubid','=',$id)->where('uid','=',Auth::user()->id)->get();
    		if($borrBook[0]->ubid!=null){
    			DB::table('userbooks')->where('ubid','=',$id)->update(['return_date'=>date('Y-m-d H:i:s')]);
    			return view('success',['success'=>'Book returned successfully!']);
    		}else{
    			return view('error',['error'=>"There's no such borrow id or you are not the one who borrowed that book!"]);
    		}
    	}else{
    		return view('error',['error'=>"You don't have rights to return books"]);
    	}
    }

    public function returnBooksTable(){
    	if(Auth::check()&&(Auth::user()->type=='S')){
    		$borrowedBooks=DB::table('userbooks')->where('uid','=',Auth::user()->id)->where('return_date','=',null)->get();
    		if($borrowedBooks[0]->ubid!=null){
    			$borrInfo=array();
    			foreach ($borrowedBooks as $borrbook) {
    				$book=DB::table('books')->where('id','=',$borrbook->bid)->get();
    				array_push($borrInfo,array($book[0]->title,$book[0]->author,$borrbook->borrow_date,$borrbook->ubid));
    			}
    			return view('return',['borrInfo'=>$borrInfo]);
    		}else{
    			return view('error',['error'=>"You didn't borrow any books"]);
    		}
    		
    	}else{
    		return view('error',['error'=>"You don't have rights to return books!"]);
    	}
    }

    public function borrowBook($id){
    	if(Auth::check()&&(Auth::user()->type=='S')){
    		$user=Auth::user();
    		$books=DB::table('books')->where('id','=',$id)->get();
    		if($books[0]->id!=null){
    			$book=$books[0];
    			if($book->quantity>0){
    				DB::table('books')->where('id','=',$id)->update(['quantity'=>$book->quantity-1]);
    				DB::table('userbooks')->insert(
    					['bid'=>$book->id,'uid'=>$user->id,'borrow_date'=>date('Y-m-d H:i:s')]
    				);
    				return view('success',['success'=>"Book was borrowed successfully!"]);
    			}else{
    				return view('error',['error'=>"No books left! Try another one!"]);
    			}
    			return view('borrow',['book'=>$book]);
    		}else{
    			return view('error',['error'=>"No book with such id!"]);
    		}
    	}else{
    		return view('error',['error'=>"You don't have rights to borrow book!"]);
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

    public function addBook(){
    	if(Auth::check()&&(Auth::user()->type=='M')){
    		return view('addbook');
    	}else{
    		return view('error',['error'=>"You don't have rights to add book!"]);
    	}
    }

    public function addBookPost(Request $request){
    	if(Auth::check()&&(Auth::user()->type=='M')){
    		$data=$request->validate([
    			"imgpath"=>"required|image",
    			"author"=>"required|string",
    			"publisher"=>"required|string",
    			"title"=>"required|string",
    			"quantity"=>"required|integer|min:0",
    			"description"=>"required|string",
    			"genre"=>"required",
    		]);
    		$md5Name = md5_file($request->file('imgpath')->getRealPath());
    		$guessExtension = $request->file('imgpath')->extension();
    		$file = $request->file('imgpath')->storeAs('uploads', $md5Name.'.'.$guessExtension,'public');
    		$author=$request->input('author');
    		$publisher=$request->input('publisher');
    		$title=$request->input('title');
    		$quantity=$request->input('quantity');
    		$description=$request->input('description');
    		$genre=implode(";", $request->genre).";";
    		DB::table('books')->insert(
    			["imgpath"=>$md5Name.'.'.$guessExtension,"author"=>$author,"publisher"=>$publisher,
    			"title"=>$title,"quantity"=>$quantity,"description"=>$description,"genre"=>$genre]
    		);
    		return redirect('/index');
    	}else{
    		return view('error',['error'=>"You don't have rights to add book!"]);
    	}
    }
}
