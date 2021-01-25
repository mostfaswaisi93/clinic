@if(session('message'))
<div class="alert alert-{{ session('alert-type') }} alert-dismissible" role="alert" id="session-alert">
    {{ session('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session()->has('welcome_msg'))
<div class="alert alert-primary alert-dismissible fade show" role="alert">
    <div class="alert-body">
        {!! session('welcome_msg') !!} {{ auth()->user()->full_name }}
    </div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif