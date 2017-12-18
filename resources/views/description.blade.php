@extends('layouts.app')

@section('content')
<main role="main" class="content-body">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<img src="/uploads/{{$book->imgpath}}" alt="Photo" style="height: 350px;width: 233px;">
			</div>
			<div class="col-md-8">
				<strong>Author:</strong>
				<p>{{$book->author}}</p><br>
				<strong>Publisher:</strong>
				<p>{{$book->publisher}}</p><br>
				<strong>Title:</strong>
				<p>{{$book->title}}</p><br>
				<strong>Genre:</strong>
				<p>{{$book->genre}}</p><br>
				<strong>Quantity:</strong>
				<p>{{$book->quantity}}</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				{{$book->description}}
			</div>
		</div>
	</div>
</main>
@endsection
