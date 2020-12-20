<label class="col-lg-2 col-form-label" for="{{ $name }}">{{ empty($label) === false ? $label : $name }}</label>
<div class="col-lg-10">    
    <textarea name="{{ $name }}" id="{{ $name }}" class="form-control" cols="30" rows="10">{{ $value }}</textarea>
</div>