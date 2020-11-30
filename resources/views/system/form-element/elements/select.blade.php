<label class="col-lg-2 col-form-label" for="{{ $name }}">{{ empty($label) === false ? $label : $name }}</label>
<div class="col-lg-10">    
    <select name="{{ $name }}" id="{{ $name }}" class="form-control">
        <option value="">Selecione uma opção</option>
        @if (count($options) > 0)
            @foreach ($options as $key => $item)
                <option value="{{ $key }}" {{ $value == $key ? "selected" : "" }} >{{ $item }}</option>
            @endforeach
        @endif
    </select>
</div>