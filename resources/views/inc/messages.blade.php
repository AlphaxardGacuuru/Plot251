@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <center>
            <div class="alert alert-danger rounded-0 mt-4 w-75">
                {{ $error }}
            </div>
        </center>
    @endforeach
@endif

@if(session('success'))
    <center>
        <div class="alert alert-success rounded-0 mt-4 w-75">
            {{ session('success') }}
        </div>
    </center>
@endif

@if(session('error'))
    <center>
        <div class="alert alert-danger rounded-0 mt-4 w-75">
            {{ session('error') }}
        </div>
    </center>
@endif
