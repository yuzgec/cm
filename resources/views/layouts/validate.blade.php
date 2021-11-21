@if ($errors->any())
    <div class="col-md-12">
        <div class="alert alert-danger mb-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    </div>
@endif
