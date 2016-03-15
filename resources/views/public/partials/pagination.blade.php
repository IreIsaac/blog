@if($model->lastPage() > 1)
<div class="pagination">
  <ul>
    <li class="page-prev"><a href="{{ $model->previousPageUrl() }}">Prev</a></li>
    <li>
      <ul>
        @for ($i=1; $i <= $model->lastPage(); $i++)
          <li><a href="{{ $model->url($i) }}">{{ $i }}</a></li>
        @endfor
      </ul>
    </li>
    <li class="page-next"><a href="{{ $model->nextPageUrl() }}">Next</a></li>
  </ul>
</div>
@endif