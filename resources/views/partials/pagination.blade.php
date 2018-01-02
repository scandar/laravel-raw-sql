@isset($count)
    @php
        $x = round($count/3);
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
          <a href="?p={{floor($count/3)}}" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
@endisset
