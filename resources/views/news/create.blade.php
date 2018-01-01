@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="form">
                    {!! Form::open([
                        'route'  => 'news.store',
                        'method' => 'POST',
                        'files'  => true
                        ]) !!}

                        <div class="form-group">
                            {!! Form::label('title', 'Title') !!}
                            {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Description') !!}
                            {!! Form::textarea('description', old('description'), ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('images', 'Images') !!}
                            {!! Form::file('images[]', ['class' => 'form-control', 'multiple' => true]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('submit', ['class' => 'form-control btn btn-primary']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
