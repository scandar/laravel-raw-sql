<div class="col-md-2" id="sidebar">
    @if (Auth::check())
        <ul>
            <li>
                <a href="{{route('news.index')}}">
                    Latest News
                </a>
            </li>

            <li>
                <a href="{{route('news.create')}}">
                    Add a News Item
                </a>
            </li>

            <li>
                <a href="{{route('search.index')}}">
                    Search
                </a>
            </li>
        </ul>
    @endif
</div>
