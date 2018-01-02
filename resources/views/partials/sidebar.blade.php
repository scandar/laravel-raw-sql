<div class="col-md-2" id="sidebar">
    @if (Auth::check())
        <ul>
            <li>
                <a href="{{route('news.index')}}">
                    Home
                </a>
            </li>

            <li>
                <a href="{{route('news.create')}}">
                    Add Item
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
