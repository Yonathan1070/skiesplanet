@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="alert-text">
            @foreach ($errors->all() as $error)
                {{$error}}
            @endforeach
        </div>
    </div>
@endif