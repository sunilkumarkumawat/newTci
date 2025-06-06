@php
    $name = $name ?? 'default_name';
    $label = $label ?? ucfirst(str_replace('_', ' ', $name));
    $selectedValue = old($name, $selected ?? '');
    $isRequired = $required ?? false;
    $options = \App\Helpers\helper::getModalData($modal ?? '');
    $labelBoolean = $labelBoolean ?? true;
    $emptyOption = $emptyOption ?? true;
    $attributes = $attributes ?? [];
@endphp

<div class="form-group">
    @if (!empty($label) && $labelBoolean != false)
        <label for="{{ $name }}">
            {{ $label }}
            @if($isRequired)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    <select
        class="form-control"
        id="{{ $name }}"
        name="{{ $name }}"
        {{ $isRequired ? 'required' : '' }}
        data-required="{{ $isRequired ? 'true' : 'false' }}"
        @foreach($attributes as $attr => $val)
            {{ $attr }}="{{ $val }}"
        @endforeach
    >
    @if ($emptyOption)
        <option value="">Select {{ $label }}</option>
        @endif
        @foreach ($options as $key => $value)
            <option value="{{ $key }}" {{ $selectedValue == $key ? 'selected' : '' }}>
                {{ $value }}
            </option>
        @endforeach
    </select>
</div>
