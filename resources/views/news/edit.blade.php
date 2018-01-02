@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        @isset($item)
            <div class="form">
                {!! Form::open([
                    'route'  => ['news.update', $item->id],
                    'method' => 'PATCH',
                    'files'  => true
                    ]) !!}

                    <div class="form-group">
                        {!! Form::label('title', 'Title') !!}
                        {!! Form::text('title', isset($item->title)?$item->title:old('title'), ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('description', 'Description') !!}
                        {!! Form::textarea('description', isset($item->title)?$item->title:old('description'), ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('images', 'Images') !!}
                        {!! Form::file('images[]', ['class' => 'form-control', 'multiple' => true]) !!}
                    </div>

                    <div class="form-group">
                        <label>
                            {!! Form::checkbox('remove', null, false) !!}
                             Remove existing images
                        </label>
                    </div>

                    <div class="form-group">
                        {!! Form::submit('submit', ['class' => 'form-control btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
        @endisset
    </div>
@endsection
