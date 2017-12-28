@extends('layouts.app')

@section('content')
<main role="main" class="content-body">
	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Title</th>
	      <th scope="col">Author</th>
	      <th scope="col">User's name</th>
	      <th scope="col">User's login</th>
	      <th scope="col">Borrow date</th>
	      <th scope="col">Return status</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@php
			$num=0;
	  	@endphp
	  	@foreach($borrInfo as $book)
	  		@php
				$num=$num+1;
	  		@endphp
			<tr>
		      <th scope="row">{{$num}}</th>
		      <td>{{$book[0]}}</td>
		      <td>{{$book[1]}}</td>
		      <td>{{$book[2]}}</td>
		      <td>{{$book[3]}}</td>
		      <td>{{$book[4]}}</td>
		      <td>{{$book[5]}}</td>
		    </tr>
	  	@endforeach
	  </tbody>
	</table>
</main>
@endsection