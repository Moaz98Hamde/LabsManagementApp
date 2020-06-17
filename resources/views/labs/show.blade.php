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
                                <h3 class="mb-0">{{ __('Lab ') . $lab->name }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('lab.device.create', $lab->id) }}" class="btn btn-sm btn-success">
                                    {{ __('Add new device') }}
                                </a>
                                <a href="{{ route('lab.index') }}" class="btn btn-sm btn-primary">
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
                                    <th scope="col">{{ __('Device id') }}</th>
                                    <th scope="col">{{ __('description') }}</th>
                                    <th scope="col">{{ __('Issues') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($devices as $device)
                                    <tr>
                                        <td>{{ $device->id }}</td>
                                        <td>{{ $device->description }}</td>
                                        <td>
                                            @if($device->issues)
                                            <a class="text-danger" href="{{route('lab.device.show', [$lab, $device])}}">
                                                has
                                                {{$device->issues()->where('resolved', 0)->count()}}
                                               unresolved issues
                                           </a>
                                           @else
                                           No issues
                                           @endif
                                       </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $devices->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
