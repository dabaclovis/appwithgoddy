@extends('layouts.app')

@section('content')
<a href="/articles" class="btn btn-primary"> <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i></a>
    <div class="container">
        @if ($article->image == 'noimage.jpg')
        <div class="card">
            <div class="card-body">
              <blockquote class="blockquote">
                  <h4>{{ $article->title }}</h4>
                <p>{{ $article->body }}</p>
                <small><i class="fa fa-user text-primary" aria-hidden="true"></i> {{ $article->user->fname }}</small><hr class="py-2">
                <footer class="card-blockquote">
                   @if (!Auth::guest())
                        @if (Auth::user()->id === $article->user->id)
                        <a href="/articles/{{ $article->id }}/edit" class="btn btn-secondary"><i class="fa fa-edit text-primary"></i></a>
                        {!! Form::open(['action' => ['App\Http\Controllers\ArticlesController@destroy',$article->id],
                          'method' => 'POST','enctype' =>'multipart/form-data','class' => 'pull-right']) !!}
                          @method('DELETE')
                          {!! Form::submit('DELETE', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                        @endif
                   @endif
                  </footer>
              </blockquote>
            </div>
          </div>
        @else
        <div class="card">
            <img src="{{ asset('storage/articles/'.$article->image) }}" style="width: 100%; height:508px;" alt="">
            <div class="card-body">

              <blockquote class="blockquote">
                  <h4>{{ $article->title }}</h4>
                <p>{{ $article->body }}</p>
                <small><i class="fa fa-user text-primary" aria-hidden="true"></i> {{ $article->user->fname }}</small><hr class="py-2">
                <footer class="card-blockquote">
                   @if (!Auth::guest())
                        @if (Auth::user()->id === $article->user->id)
                        <a href="/articles/{{ $article->id }}/edit" class="btn btn-secondary"><i class="fa fa-edit text-primary"></i></a>
                        {!! Form::open(['action' => ['App\Http\Controllers\ArticlesController@destroy',$article->id],
                          'method' => 'POST','enctype' =>'multipart/form-data','class' => 'pull-right']) !!}
                          @method('DELETE')
                          {!! Form::submit('DELETE', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                        @endif
                   @endif
                  </footer>
              </blockquote>
            </div>
          </div>
        @endif
    </div>
@endsection
