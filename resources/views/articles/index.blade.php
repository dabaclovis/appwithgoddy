@extends('layouts.app')

@section('content')
  <div class="container">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        {{ $message }}
    </div>
@endif

    <a href="/articles/create" class="pull-right btn btn-primary">Add</a>
<br>
@if (count($articles) > 0)
    @foreach ($articles as $article)
        @if ($article->image == 'noimage.jpg')
            <div class="card">
              <div class="card-body">
                <blockquote class="blockquote">
                    <h4>{{ $article->title }}</h4>
                    <p>{{ $article->body }} <a href="/articles/{{ $article->id }}"> ... details</a></p>
                  <footer class="card-blockquote">
                      <small>posted by{{ $article->user->fname }}</small><br>
                      <small>{{ $article->created_at }}</small>
                </footer>
                </blockquote>
              </div>
            </div>
        @else
        <div class="card">
            <div class="card-body">
              <blockquote class="blockquote">
                  <h4>{{ $article->title }}</h4>
                <p>{{ $article->body }} <a href="/articles/{{ $article->id }}"> ... details</a></p>
                <footer class="card-blockquote">
                    <small>posted by{{ $article->user->fname }}</small><br>
                    <small>{{ $article->created_at }}</small>
              </footer>
              </blockquote>
            </div>
          </div>
        @endif
    @endforeach
    {{ $articles->links() }}
@endif
  </div>
@endsection
