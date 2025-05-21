@if (!empty($data))
    @foreach ($data as $locker)
    <div class="col-md-3 col-sm-4 col-3  ">
                                            <div class="item-box available locker" data-type="locker">   {{ $locker->locker_name }}</div>
                                        </div>
        
    @endforeach
@endif
