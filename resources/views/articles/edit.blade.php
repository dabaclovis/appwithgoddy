@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card-header text-primary">
            <h4 style="text-align: center;">{{ __('Update post') }}</h4>
        </div>
        <br>
            @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                    <ul>
                       <div class="alert alert-danger alert-dismissible fade show" role="alert">
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                               <span class="sr-only">Close</span>
                           </button>
                           <li>{{ $error }}</li>
                       </div>
                    </ul>
                @endforeach
            @endif
        {!! Form::open(['action' => ['App\Http\Controllers\ArticlesController@update',$article->id],'method' => 'POST','enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {!! Form::label('title', 'Article Title') !!}
                {!! Form::text('title', $article->title, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('body', 'Article Content') !!}
                {!! Form::textarea('body', $article->body, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::file('image') !!}
            </div>
            <div class="form-group">
                {!! Form::hidden('_method','PUT') !!}
            </div>
            <div class="form-group">
               {!! Form::submit('Submit', ['class' => 'btn btn-secondary']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection
