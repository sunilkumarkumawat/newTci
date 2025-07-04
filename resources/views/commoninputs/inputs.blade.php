@php
    $name = $name ?? 'default_name';
    $label = $label ?? ucfirst(str_replace('_', ' ', $name));
    $selectedValue = old($name, $selected ?? '');
    $isRequired = $required ?? false;
    $options = \App\Helpers\helper::getModalData($modal ?? '');
    $labelBoolean = $labelBoolean ?? true;
    $emptyOption = $emptyOption ?? true;
    $attributes = $attributes ?? [];
    $useIdAsValue = $useIdAsValue ?? true;
    $nameField = $nameField ?? true;
@endphp

@php
    $options = [];

    if ($modal === 'Role') {
        // Fetch roles except ID 1
        $options = \App\Models\Role::where('id', '!=', 1)->pluck('name', 'id');
    }

@endphp

<div class="form-group mb-0">
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
        @if($nameField)
            name="{{ $name }}"
        @endif
       
        data-required="{{ $isRequired ? 'true' : 'false' }}"
        @foreach($attributes as $attr => $val)
            {{ $attr }}="{{ $val }}"
        @endforeach
    >
    @if ($emptyOption)
        <option value="">Select {{ $label }}</option>
        @endif
        @foreach ($options as $key => $value)
            <option value="{{ $useIdAsValue ? $key : $value }}" {{ $selectedValue == $key ? 'selected' : '' }}>
                {{ $value }}
            </option>
        @endforeach
    </select>
</div>
