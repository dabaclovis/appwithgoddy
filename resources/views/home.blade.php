@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (count( $articles) > 0)
                        <div class="card-header">
                            <h4>Your created Article</h4>
                        </div>
                        @foreach ($articles as $article)
                            <div class="form-group">

                                <a href="/articles/{{ $article->id }}" class="form-control" style="font-size: large;">{{ $article->title }}
                                      <i class="fa fa-check pull-right text-primary" aria-hidden="true"> {{ $article->user->fname }}</i>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
