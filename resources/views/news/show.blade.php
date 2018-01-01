@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @isset($item)
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            <h1>
                                {{$item->title}}
                            </h1>
                            <small>
                                created at:
                                 {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->diffForHumans()}}
                             </small>
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
                @endisset
            </div>
        </div>
    </div>
@endsection
