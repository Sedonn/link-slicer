@extends('layouts.service.master')

@section('title', 'Create link')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Create link</h1>
        <form action="{{ route('createLink') }}" method="POST">
            @csrf
            <fieldset>
                <input required type="url" name="link" placeholder="Write your link" class="form-control form-control-user"> <br>
                <button class="btn btn-primary btn-user btn-block">Slice Link</button>
            </fieldset>
        </form>
    </div>
    <!-- /.container-fluid -->

@endsection
