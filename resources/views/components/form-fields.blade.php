@php
    $action = route("{$route}.store");
    if(is_null($id) === false){
        $action = route("{$route}.update", ['id' => $id]);    
    }
@endphp

<form action="{{$action}}" method="POST" class="form-horizontal">
    @csrf
    @if (is_null($id) === false)
        @method('put')
    @endif
    
    @if ($errors->any())       
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{$error}}</div>
        @endforeach
    @endif

    <div class="row">
        <div class="col">
            @foreach ($formFields as $item)

                @switch($item['type'])
                    @case('hidden')
                        <input type="hidden" name="{{$item['name']}}" value="{{ $item['value'] }}">
                        @break
                    @case('select')
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="{{ $item['name'] }}">{{ $item['name'] }}{{ isset($item['required']) ? '*' : '' }}</label>
                            <div class="col-lg-10">                                
                                <select name="{{$item['name']}}" class="form-control custom-select" id="{{ $item['name'] }}">
                                    @if (isset($item['options']))
                                        @foreach ($item['options'] as $opt)
                                            @php
                                                $selected = $opt['id'] == $item['value'] ? 'selected' : '';
                                            @endphp
                                            <option value="{{ $opt['id'] }}" {{ $selected }}>{{ $opt['option'] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        @break
                    @case('number')
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="{{$item['name']}}">{{$item['name']}}{{ isset($item['required']) ? '*' : '' }}</label>
                            <div class="col-lg-10">
                                <input type="number" class="form-control" name="{{$item['name']}}" id="{{$item['name']}}" value="{{ old($item['name']) ? old($item['name']) :  $item['value'] }}" maxlength="{{ $item['max_length'] }}">
                            </div>
                        </div>
                        @break
                    @case('text')
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="{{$item['name']}}">{{$item['name']}}{{ isset($item['required']) ? '*' : '' }}</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="{{$item['name']}}" id="{{$item['name']}}" value="{{ old($item['name']) ? old($item['name']) :  $item['value'] }}" maxlength="{{ $item['max_length'] }}">
                            </div>
                        </div>
                        @break
                    @default
                        
                @endswitch
                
            @endforeach               

            <div class="text-right">
                <a href="{{ route("{$route}.index", ['category_id' => $requestData['category_id'] ]) }}" class="btn btn-primary">Voltar</a>
                <button type="submit" class="btn btn-dark">Salvar</button>
            </div>
        </div>
    </div>
</form>

