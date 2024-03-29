@if (count($errors) > 0)
    <div class="alert alert-danger mt-5">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            
        </ul>
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger mt-5">
        <button type="button" class="close over" data-dismiss="alert">×</button>
        {{ Session::get('error') }}
    </div>
@endif

@if(Session::has('flash_failure'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ Session::get('flash_failure') }}
    </div>
@endif


@if(Session::has('flash_success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ Session::get('flash_success') }}
    </div>
@endif