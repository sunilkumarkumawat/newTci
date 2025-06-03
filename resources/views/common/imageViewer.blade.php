@php
    use Illuminate\Support\Str;

    // Resolve image dynamically from model if not passed
    if (!isset($image) && isset($modal) && isset($id) && isset($field)) {
        $fullModal = '\\App\\Models\\' . $modal;
        if (class_exists($fullModal)) {
            $record = $fullModal::find($id);
            $image = $record?->$field ?? null;
        }
    }

    // Use default image provided, otherwise fallback to generic
    $defaultImagePath = $defaultImage ?? 'defaultImages/imageError.png';
    $imageUrl = $image ? asset($image) : asset($defaultImagePath);
    $isDefault = Str::contains($imageUrl, $defaultImagePath);
    $imageId = 'imageModal_' . uniqid();
@endphp

<div class="position-relative d-inline-block">
    <div data-bs-toggle="modal" data-bs-target="#{{ $imageId }}"  title="View Image" style="cursor: pointer">
    <img src="{{ $imageUrl }}" class="profileImg rounded {{ $class ?? '' }}" alt="{{ $alt ?? 'Image' }}"
        style="{{ $style ?? 'max-height: 150px;' }}"
        onerror="this.onerror=null; this.src='{{ asset($defaultImagePath) }}';" />
    </div>
    <!-- @if (!$isDefault)
        {{-- View Icon --}}
        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#{{ $imageId }}" class="position-absolute"
            style=" right: -50%; top: 7%" title="View Image">
            <i class="fa fa-eye" style="font-size: 15px; color: #002C54;"></i>
        </a>

        {{-- Download Icon --}}
        <a href="{{ $imageUrl }}" download class="position-absolute" style="top: 55%; right: -50%"
            title="Download Image">
            <i class="fa fa-download" style="font-size: 15px; color: #002C54;"></i>
        </a>
    @endif -->
</div>

<!-- {{-- Modal --}}
@if (!$isDefault)
    <div class="modal fade" id="{{ $imageId }}" tabindex="-1" aria-labelledby="{{ $imageId }}Label"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Image Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ $imageUrl }}" class="img-fluid rounded" alt="Preview" style="max-height: 50vh;">
                </div>
            </div>
        </div>
    </div>
@endif -->
