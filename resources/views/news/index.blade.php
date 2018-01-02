@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        @if (count($items))
            @foreach ($items as $item)
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            <h1>
                                {{$item->title}}
                            </h1>
                            <a href="{{route('news.show', $item->id)}}">
                                <small>
                                    created at:
                                     {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->diffForHumans()}}
                                 </small>
                             </a>
                        </div>
                        <div class="panel-body">
                            @if (count($item->images))
                                <div class="thumbnail">
                                    <a href="{{route('news.show', $item->id)}}">
                                        <img src="{{ asset('images/'. $item->images[0]['path']) }}" class="image-responsive">
                                    </a>
                                </div>
                            @endif

                            <p>
                                {{substr($item->description, 0,99)}}
                                <a href="{{route('news.show', $item->id)}}">
                                    read more...
                                </a>
                            </p>
                        </div>
                    </div>
            @endforeach
        @else
            <h1 class="text-center">No Data :(</h1>
        @endif

        @include('partials.pagination')
    </div>
@endsection
