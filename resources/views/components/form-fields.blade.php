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
                        <input type="hidden" name="{{$item['name']}}" value="{{$item['value']}}">
                        @break
                    @case('text')
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="{{$item['name']}}">{{$item['name']}}</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="{{$item['name']}}" id="{{$item['name']}}" value="{{$item['value']}}">
                            </div>
                        </div>
                        @break
                    @default
                        
                @endswitch
                
            @endforeach   
            
            <div class="text-right">
                <a href="{{route("{$route}.index")}}" class="btn btn-primary">Voltar</a>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </div>
</form>

