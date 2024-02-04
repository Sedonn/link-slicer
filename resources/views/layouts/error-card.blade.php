@if ($errors->any())
    <div class="container-fluid"><br>
        <div class="w-50">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-danger">
                    <h6 class="m-0 font-weight-bold text-white">Error</h6>
                </div>
                <div class="card-body">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif