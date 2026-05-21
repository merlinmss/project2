@props([
    'label'       => '',
    'name'        => '',
    'type'        => 'text',
    'placeholder' => '',
    'value'       => '',
    'required'    => false,
])

<div class="">
    @if($label)
        <label for="{{ $name }}">
            {{ $label }}
            @if($required) <span class="text-danger">*</span> @endif
        </label>
    @endif

    <input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'form-control', $errors->has($name) ? 'is-invalid' : '']) }}
    >

    @error($name)
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
