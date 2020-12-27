@if ($type === 'hidden')
    <input type="{{ $type }}" name="{{ $name }}" class="form-control" id="{{ $name }}" value="{{ $value }}">
@else
    <label class="col-lg-2 col-form-label" for="{{ $name }}">{{ empty($label) === false ? $label : $name }}</label>
    <div class="col-lg-10">
        <input type="{{ $type }}" name="{{ $name }}" class="form-control" id="{{ $name }}" value="{{ $value }}">
    </div>    
@endif
