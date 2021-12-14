@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger rounded-0 mt-4">
            {{ $error }}
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success rounded-0 mt-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger rounded-0 mt-4">
        {{ session('error') }}
    </div>
@endif
