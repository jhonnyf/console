<form class="form-horizontal">
    <div class="row">
        <div class="col">
            @foreach ($formFields as $item)

                @php
                    $value = isset($formValues[$item['name']]) ? $formValues[$item['name']] : '';                    
                @endphp

                @switch($item['type'])
                    @case('hidden')
                        <input type="hidden" name="{{$item['name']}}" value="{{$value}}">
                        @break
                    @case('text')
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="{{$item['name']}}">{{$item['name']}}</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="{{$item['name']}}" value="{{$value}}">
                            </div>
                        </div>
                        @break
                    @default
                        
                @endswitch
                
            @endforeach   
            
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </div>
</form>

