<form @if (empty($action) === false) action="{{ $action }}" @endif  @if (empty($method) === false) method="{{ $method }}" @endif @if (empty($autocomplete) === false) autocomplete="{{ $autocomplete }}" @endif>

    @if (is_array($row) && count($row) > 0)
        @foreach ($row as $cols)

            @foreach ($cols as $col)
                <div class="form-group row">
                    {!! $col !!}
                </div>
            @endforeach
                        
        @endforeach
    @endif

</form>