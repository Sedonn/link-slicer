@extends('layouts.service.master')

@section('title', 'Delete link')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Delete link</h1>
        <form action="{{ route('deleteLink') }}" method="POST">
            @method('DELETE')
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
                                    <td width="10px"><input type="checkbox" name="links[]" value="{{ $link->url }}">
                                    </td>
                                    <td><a href="{{ $link->url }}">{{ $link->url }}</a></td>
                                    <td><a href="http://linkslicer.home/{{ $link->key }}">{{ $link->key }}</a></td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <button class="btn btn-primary btn-user btn-block" type="sumbit">Delete link</button>
            </fieldset>
        </form>
    </div>
    <!-- End of Main Content -->
@endsection
