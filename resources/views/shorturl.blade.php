@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                {{ __('Short URL List') }}

                            </div>
                            <div class="col-md-6 text-end">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Add URL
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (Session::has('message'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>{{ Session::get('message') }}</strong>.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl NO</th>
                                    <th>Short URL</th>
                                    <th>View Short URL</th>
                                    <th>Total View</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shortUrls as $key => $urls)
                                    <tr>
                                        <th>{{ $key + $shortUrls->firstItem() }}</th>
                                        <td>
                                            <a target="__blank"
                                                href="{{ route('url.redirect', ['shortUrl' => $urls->short_url]) }}"
                                                class="btn btn-sm btn-info">
                                                Open URL
                                            </a>
                                        </td>
                                        <td>
                                            {{ route('url.redirect', ['shortUrl' => $urls->short_url]) }}
                                        </td>
                                        <td>
                                            {{ $urls->total_view }}
                                        </td>
                                        <td>
                                            <a href="{{ route('shortUrl.delete', $urls->id) }}" class="btn btn-danger">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $shortUrls->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('shortUrl.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <labe class="form-label">
                                    Long URL
                                    <span class="text-danger">*</span>
                                </labe>
                                <textarea name="long_url" class="form-control" cols="30" rows="10" placeholder="Long URL"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
