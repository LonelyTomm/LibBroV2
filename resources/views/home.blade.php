@extends('layouts.app')

@section('content')
<main role="main" class="content-body">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <ul class="list-group sidebar-menu">
            <li class="list-group-item"><a href="#">History</a></li>
            <li class="list-group-item"><a href="#">Thriller</a></li>
            <li class="list-group-item"><a href="#">Romance/Erotica</a></li>
            <li class="list-group-item"><a href="#">Satire</a></li>
            <li class="list-group-item"><a href="#">Horror</a></li>
            <li class="list-group-item"><a href="#">Religious/Inspirational</a></li>
            <li class="list-group-item"><a href="#">Health/Medicine</a></li>
            <li class="list-group-item"><a href="#">Children's books</a></li>
            <li class="list-group-item"><a href="#">Dictionary</a></li>
          </ul>
        </div>
        <div class="col-md-9">
            @for($i=$firstBook;$i<=$lastBook;$i++)
              @if(($i==$firstBook)||(($i%4)==0))
              <div class="row">
              @endif
              
              <div class="col-md-3 text-center">
                <div class="bookprof">
                  <a href="desc/{{$books[$i]->id}}">
                    <img src="uploads/{{$books[$i]->imgpath}}" alt="Book">
                  </a><br>
                  <a href="desc/{{$books[$i]->id}}" id="title">{{$books[$i]->title}}</a><br>
                  <span>{{$books[$i]->description}}</span>
                </div>
              </div>



              @if(($i==$lastBook)||((($i+1)%4)==0))
                </div>
              @endif
            @endfor
            
            <div class="row">
              <div class="container-fluid">
                <nav aria-label="Page navigation" class="col-md-12">
                  <ul class="pagination justify-content-center">
                    @if($page==1)
                      <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    @else
                      <li class="page-item"><a class="page-link" href="/{{$page-1}}">Previous</a></li>
                    @endif
                    
                    @for($i=1;$i<=$pages;$i++)
                      @if($i==$page)
                        <li class="page-item active"><a class="page-link" href="/{{$i}}">{{$i}}</a></li>
                      @endif
                    @endfor

                    @if($page<$pages)
                      <li class="page-item"><a class="page-link" href="/{{$page+1}}">Next</a></li>
                    @else
                      <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                    @endif
                  </ul>
                </nav>
              </div> 
            </div>
          </div>
        </main>
@endsection
