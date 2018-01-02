@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <div class="form">
            {!! Form::open([
                'route'  => ['search.title'],
                'method' => 'GET',
                ]) !!}

                <div class="form-group">
                    {!! Form::label('title', 'Search using titles') !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Search', ['class' => 'form-control btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}

            {!! Form::open([
                'route'  => ['search.date'],
                'method' => 'GET',
                ]) !!}

                <div class="row">

                    <div class="form-group  col-md-6">
                        {!! Form::label('from', 'from') !!}
                        {!! Form::date('from', old('from'), [
                            'class' => 'form-control',
                            ]) !!}
                    </div>

                    <div class="form-group  col-md-6">
                        {!! Form::label('to', 'to') !!}
                        {!! Form::date('to', old('to'), [
                            'class' => 'form-control',
                            ]) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::submit('Search', ['class' => 'form-control btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
