@props([
    'name',
    'label'    => '',
    'options'  => [],
    'selected' => [],
    'required' => false,
])

<div class="">
    @if($label)
        <label for="{{ $name }}">{{ $label }}</label>
        @if($required) <span class="text-danger">*</span> @endif
    @endif

    <select
        name="{{ $name }}[]"
        id="{{ $name }}"
        multiple
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'form-control']) }}
    >
        @foreach($options as $value => $display)
            <option
                value="{{ $value }}"
                {{ in_array($value, (array) $selected) ? 'selected' : '' }}
            >
                {{ $display }}
            </option>
        @endforeach
    </select>
</div>
