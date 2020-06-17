@extends('layouts.app', ['title' => __('Lab Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('device ') . $device->id }}</h3>
                            </div>
                            <div class="col-4 text-right">
                            <a href="{{route('device.issue.create', $device->id)}}" class="btn btn-sm btn-success">
                                {{ __('Add new issue') }}
                            </a>
                            <a href="{{route('lab.show', $device->lab)}}" class="btn btn-sm btn-primary">
                                {{ __('Back to list') }}
                            </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Issue id') }}</th>
                                    <th scope="col">{{ __('title') }}</th>
                                    <th scope="col">{{ __('description') }}</th>
                                    <th class="text-center" scope="col">{{ __('status') }}</th>
                                    <th class="text-center" scope="col">{{ __('') }}</th>
                                    <th class="text-center" scope="col">{{ __('') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($issues as $issue)
                                    <tr>
                                        <td>{{ $issue->id }}</td>
                                        <td>{{ $issue->title }}</td>
                                        <td>{{ $issue->description }}</td>
                                        @if($issue->resolved)
                                        <td class="text-lg text-center">
                                            <span class="display-4 text-success text-uppercase">Resolved</span>
                                        </td>
                                        <td>
                                            <a href="{{route('retreat', $issue)}}" class="btn btn-danger">Retreat</a>
                                        </td>
                                           @else
                                           <td class="text-lg text-center">
                                           <span class="display-4 text-danger text-uppercase">Issued!</span>
                                         </td>
                                         <td>
                                         <a href="{{route('resolve', $issue)}}" class="btn btn-success">Resolve</a>
                                         </td>
                                           @endif
                                        <td>
                                            <form  onsubmit="return confirm('are you sure?')"
                                            action="{{route('device.issue.destroy', [$device, $issue])}}"
                                            method="POST">
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit" class="btn btn-primary">Delete Issue</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $issues->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
