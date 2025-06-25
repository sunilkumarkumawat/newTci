@if (!empty($data))
    @foreach ($data as $cabin)
        <div class="col-md-2 col-sm-3 col-3 pb-2">
            <div class="item-box available cabin" data-type="cabin">
                {{ $cabin->cabin_name }}</div>
        </div>
    @endforeach
@endif
