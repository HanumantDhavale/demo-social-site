@if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@elseif(session('danger'))
    <div class="alert alert-danger">
        {{session('danger')}}
    </div>
@endif
