@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Popular Links</h2>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
    <table class="table table-bordered table-sm">
        <thead>
        <tr>
            <th>ID</th>
            <th>Short Link</th>
            <th>Link</th>
            <th>Title</th>
            <th>Visit Count</th>
        </tr>
        </thead>
        <tbody>
        @foreach($popularLinks as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td><a href="{{ route('shorten.link', $row->code) }}" target="_blank">{{ route('shorten.link', $row->code) }}</a></td>
                <td>{{ $row->link }}</td>
                <td>{{ $row->title }}</td>
                <td>{{ $row->visit_count }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
        </div>
        {!! $popularLinks->links() !!}
        <br>
    </div>
@endsection
