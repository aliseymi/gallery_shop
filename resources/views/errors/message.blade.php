@if (session('failed'))
<div class="alert alert-danger alert-dismissible fade show">
    {{ session('failed') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show">
    <h4 class="alert-heading">توجه!</h4>
    
    @if (isset($closable) && $closable == 'closable')
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    @endif

    <ul>
        @foreach ($errors->all() as $error)
            <li class="mr-3">{{ $error }}</li>
        @endforeach
    </ul>

</div>
@endif