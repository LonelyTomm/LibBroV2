@extends('layouts.app')

@section('content')
<main role="main" class="content-body">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <ul class="list-group sidebar-menu">
            <li class="list-group-item"><a href="{{url('/genre/history')}}">History</a></li>
            <li class="list-group-item"><a href="/genre/thriller">Thriller</a></li>
            <li class="list-group-item"><a href="/genre/romance&erotica">Romance/Erotica</a></li>
            <li class="list-group-item"><a href="/genre/satire">Satire</a></li>
            <li class="list-group-item"><a href="/genre/horror">Horror</a></li>
            <li class="list-group-item"><a href="/genre/religious&inspirational">Religious/Inspirational</a></li>
            <li class="list-group-item"><a href="/genre/health&medicine">Health/Medicine</a></li>
            <li class="list-group-item"><a href="/genre/childrens">Children's books</a></li>
            <li class="list-group-item"><a href="/genre/dictionary">Dictionary</a></li>
          </ul>
        </div>
        <div class="col-md-9">
            @for($i=$firstBook;$i<=$lastBook;$i++)
              @if(($i==$firstBook)||(($i%4)==0))
              <div class="row">
              @endif
              
              <div class="col-md-3 text-center">
                <div class="bookprof">
                  <a href="/desc/{{$books[$i]->id}}">
                    <img src="/uploads/{{$books[$i]->imgpath}}" alt="Book">
                  </a><br>
                  <a href="/desc/{{$books[$i]->id}}" id="title">{{$books[$i]->title}}</a><br>
                  <span>
                    @if(strlen($books[$i]->description)>80)
                    {{substr($books[$i]->description,0,79)}}...
                    @else
                    {{$books[$i]->description}}
                    @endif
                  </span>
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
                      <li class="page-item"><a class="page-link" href="index/{{$page-1}}">Previous</a></li>
                    @endif
                    
                    @for($i=1;$i<=$pages;$i++)
                      @if($i==$page)
                        <li class="page-item active"><a class="page-link" href="index/{{$i}}">{{$i}}</a></li>
                      @endif
                    @endfor

                    @if($page<$pages)
                      <li class="page-item"><a class="page-link" href="index/{{$page+1}}">Next</a></li>
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
