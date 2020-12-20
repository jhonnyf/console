<form @if (empty($action) === false) action="{{ $action }}" @endif  @if (empty($method) === false) method="{{ $method }}" @endif @if (empty($autocomplete) === false) autocomplete="{{ $autocomplete }}" @endif @if (empty($class) === false) class="{{ implode(' ', $class) }}" @endif>
    @csrf

    @if (isset($extraData) && count($extraData) > 0)
        @foreach ($extraData as $key => $item)
            <input type="hidden" name="{{ $key }}" value="{{ $item }}">
        @endforeach
    @endif

    @if ($errors->any())       
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{$error}}</div>
        @endforeach
    @endif

    @if (is_array($row) && count($row) > 0)
        @foreach ($row as $cols)

            @foreach ($cols as $col)
                <div class="form-group row">
                    {!! $col !!}
                </div>
            @endforeach
                        
        @endforeach
    @endif

    @php
        $routeParams = [];
        $button_back = true;

        if (isset($extraData) && count($extraData) > 0) {
            $routeParams = $extraData;
        }

        if (isset($btn_back)) {
            $button_back = $btn_back;
        }
    @endphp

    <div class="text-right">        
        @if ($button_back)
            <a href="{{ route("{$route}.index", $routeParams) }}" class="btn btn-primary">Voltar</a>
        @endif
        <button type="submit" class="btn btn-dark">Salvar</button>
    </div>

</form>