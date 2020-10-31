<form @if (empty($action) === false) action="{{ $action }}" @endif  @if (empty($method) === false) method="{{ $method }}" @endif @if (empty($autocomplete) === false) autocomplete="{{ $autocomplete }}" @endif>

    @if (is_array($row) && count($row) > 0)
        @foreach ($row as $cols)
            <div class="row">
                @foreach ($cols as $col)
                    <div class="col">
                        {!! $col !!}
                    </div>
                @endforeach
            </div>
            <hr>
        @endforeach
    @endif

</form>