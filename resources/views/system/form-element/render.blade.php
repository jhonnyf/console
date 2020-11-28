<form @if (empty($action) === false) action="{{ $action }}" @endif  @if (empty($method) === false) method="{{ $method }}" @endif @if (empty($autocomplete) === false) autocomplete="{{ $autocomplete }}" @endif>
    @csrf

    @if (count($extraData) > 0)
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

    <div class="text-right">
        <a href="{{ route("{$route}.index", $extraData) }}" class="btn btn-primary">Voltar</a>
        <button type="submit" class="btn btn-dark">Salvar</button>
    </div>

</form>