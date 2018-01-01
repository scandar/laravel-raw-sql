@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
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
                                            read more..
                                        </a>
                                    </p>
                                </div>
                            </div>
                    @endforeach
                @endif

                @isset($count)
                    @php
                        $x = 0;
                        if (count($items) != 0) {
                            $x = $count / count($items);
                        }
                    @endphp
                    <nav aria-label="Page navigation">
                      <ul class="pagination">
                        <li>
                          <a href="?p=0" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                          </a>
                        </li>
                            @for ($i=0; $i < $x-1; $i++)
                                <li>
                                    <a href="?p={{$i+1}}">{{$i+1}}</a>
                                </li>
                            @endfor
                        <li>
                          <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                          </a>
                        </li>
                      </ul>
                    </nav>
                @endisset
            </div>
        </div>
    </div>
@endsection
