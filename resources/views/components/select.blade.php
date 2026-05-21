@props([
    'label'    => '',
    'name'     => '',
    'options'  => [],
    'selected' => '',
    'required' => false,
])

<div class="">
    @if($label)
        <label for="{{ $name }}">{{ $label }}</label>
        @if($required) <span class="text-danger">*</span> @endif
    @endif

    <select
        id="{{ $name }}"
        name="{{ $name }}"
        {{ $attributes->merge(['class' => 'form-control',$errors->has($name) ? 'is-invalid' : '']) }}
    >
        <option value="">-- Select --</option>
        @foreach($options as $val => $text)
            <option value="{{ $val }}" {{ old($name, $selected) == $val ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach
    </select>

    @error($name)
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
