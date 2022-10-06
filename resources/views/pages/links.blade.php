@extends('layouts.service.master')

@section('title', 'My links')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">My links</h1>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Original link</th>
                        <th>Sliced link</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($links->count() > 0)
                        @foreach ($links as $link)
                            <tr>
                                <td><a href="{{ $link->url }}">{{ $link->url }}</a></td>
                                <td><a href="http://linkslicer.home/{{ $link->key }}">{{ $link->key }}</a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
