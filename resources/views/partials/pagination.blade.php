@isset($count)
    @php
        $x = ceil($count/3);
    @endphp
    <nav aria-label="Page navigation">
      <ul class="pagination">
        <li>
          <a href="?p=0{{isset($_GET['title'])?'&title='.$_GET['title']:''}}{{isset($_GET['from'])?'&from='.$_GET['from']:''}}{{isset($_GET['to'])?'&to='.$_GET['to']:''}}" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
            @for ($i=0; $i < $x; $i++)
                <li>
                    <a href="?p={{$i}}{{isset($_GET['title'])?'&title='.$_GET['title']:''}}{{isset($_GET['from'])?'&from='.$_GET['from']:''}}{{isset($_GET['to'])?'&to='.$_GET['to']:''}}">{{$i+1}}</a>
                </li>
            @endfor
        <li>
          <a href="?p={{$i-1}}{{isset($_GET['title'])?'&title='.$_GET['title']:''}}{{isset($_GET['from'])?'&from='.$_GET['from']:''}}{{isset($_GET['to'])?'&to='.$_GET['to']:''}}" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
@endisset
