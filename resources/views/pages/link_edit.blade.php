@extends('layouts.service.master')

@section('title', 'Edit link')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Edit link</h1>
        <form action="{{ route('editLink') }}" method="POST">
            @csrf
            <fieldset>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Selected</th>
                            <th>Original link</th>
                            <th>Sliced link</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($links->count() > 0)
                            @foreach ($links as $link)
                                <tr>
                                    <td width="10px"><input type="radio" name="oldLink" value="{{ $link->url }}">
                                    </td>
                                    <td><a href="{{ $link->url }}">{{ $link->url }}</a></td>
                                    <td><a href="http://linkslicer.home/{{ $link->key }}">{{ $link->key }}</a></td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <input type="url" placeholder="Enter new link" name="newLink" class="form-control form-control-user"><br>
                <button class="btn btn-primary btn-user btn-block">Change link</button>
            </fieldset>
        </form>
    </div>
@endsection
