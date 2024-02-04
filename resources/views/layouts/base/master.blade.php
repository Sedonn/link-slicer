<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        @yield('content')
                        @include('layouts.error-card')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.scripts')
</body>

</html>
