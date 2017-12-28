@extends('layouts.app')

@section('content')
<main role="main" class="content-body">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Modify Book</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/modify/book/{{$book->id}}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
						    <label for="imgpath">Choose the book image:</label>
						    <input type="file" class="form-control-file" id="imgpath" required name="imgpath">
						</div>

                        <div class="form-group{{ $errors->has('author') ? ' has-error' : '' }}">
                            <label for="author" class="col-md-4 control-label">Author:</label>

                            <div class="col-md-6">
                                <input id="author" type="text" class="form-control" name="author" value="{{ $book->author }}" required autofocus>

                                @if ($errors->has('author'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('author') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('publisher') ? ' has-error' : '' }}">
                            <label for="publisher" class="col-md-4 control-label">Publisher:</label>

                            <div class="col-md-6">
                                <input id="publisher" type="text" class="form-control" name="publisher" value="{{ $book->publisher }}" required autofocus>

                                @if ($errors->has('publisher'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('publisher') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title:</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $book->title }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                            <label for="quantity" class="col-md-4 control-label">Quantity:</label>

                            <div class="col-md-6">
                                <input id="quantity" type="number" class="form-control" name="quantity" value="{{ $book->quantity }}" required autofocus>

                                @if ($errors->has('quantity'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
						    <label for="description">Description:</label>
						    <textarea class="form-control" id="description" rows="3" name="description" >{{$book->description}}</textarea>
					    </div>

					    <div class="form-check form-check-inline">
						  <label class="form-check-label">
						    <input class="form-check-input" type="checkbox" id="genre" name="genre[]" value="history"> History
						  </label>
						

						
						  <label class="form-check-label">
						    <input class="form-check-input" type="checkbox" id="genre" name="genre[]" value="thriller"> Thriller
						  </label>
						
						
						
						  <label class="form-check-label">
						    <input class="form-check-input" type="checkbox" id="genre" name="genre[]" value="romance/erotica"> Romance/Erotica
						  </label>
						

						
						  <label class="form-check-label">
						    <input class="form-check-input" type="checkbox" id="genre" name="genre[]" value="satire"> Satire
						  </label>
						

					
						  <label class="form-check-label">
						    <input class="form-check-input" type="checkbox" id="genre" name="genre[]" value="horror"> Horror
						  </label>
						

						
						  <label class="form-check-label">
						    <input class="form-check-input" type="checkbox" id="genre" name="genre[]" value="religious/inspirational"> Religious/Inspirational
						  </label>
						

						
						  <label class="form-check-label">
						    <input class="form-check-input" type="checkbox" id="genre" name="genre[]" value="health/medicine"> Health/Medicine
						  </label>
					

					
						  <label class="form-check-label">
						    <input class="form-check-input" type="checkbox" id="genre" name="genre[]" value="childrens"> Children's
						  </label>
					

						
						  <label class="form-check-label">
						    <input class="form-check-input" type="checkbox" id="genre" name="genre[]" value="dictionary"> Dictionary
						  </label>
						</div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Modify
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
@endsection