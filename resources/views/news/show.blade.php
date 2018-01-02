@extends('layouts.app')

@section('content')
    @isset($item)
        <div class="col-md-8">
            <div class="row">

                <div class="col-md-6">
                    <h4>author: {{$item->author}}</h4>
                </div>
                @if (Auth::user()->role->name == 'admin')
                    <div class="col-md-6">

                        <div class="pull-right">
                            <a href="{{route('news.edit', $item->id)}}" class="btn btn-sm btn-primary">Edit</a>

                            {!! Form::open([
                                'route'  =>['news.destroy', $item->id],
                                'method' => 'DELETE',
                                'style' => 'display:inline'
                                ]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}

                        </div>
                    </div>
                    @endif
            </div>

            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <div class="text-center">
                        <h1>
                            {{$item->title}}
                        </h1>
                        <small>
                            created at:
                            {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->diffForHumans()}}
                        </small>
                        <small>Views: {{$item->view_count}}</small>
                    </div>
                </div>

                <div class="panel-body">
                    @if (count($images))
                        <div class="thumbnail">
                            <a href="{{asset('images/'. $images[0]['path'])}}" target="_blank">
                                <img src="{{ asset('images/'. $images[0]['path']) }}" class="image-responsive">
                            </a>
                        </div>
                    @endif

                    <p>{{$item->description}}</p>

                    @if (count($images))
                        <div class="row text-center">
                            <h4>images</h4>
                            @foreach ($images as $image)
                                <div class="col-xs-6 col-md-3">
                                    <a href="{{asset('images/'. $image['path'])}}" target="_blank" class="thumbnail">
                                        <img src="{{ asset('images/'. $image['path']) }}">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endisset
@endsection
