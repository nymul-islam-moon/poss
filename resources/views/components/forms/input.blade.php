<div class="form-group col-md-6">
    @if($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <input 
        type="{{ $type }}" 
        class="form-control" 
        id="{{ $name }}" 
        name="{{ $name }}" 
        placeholder="{{ $placeholder }}" 
        {{ $required ? 'required' : '' }}>
</div>
