@extends('layouts.app', ['title' => __('Lab Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Update Lab')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Lab Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('lab.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('lab.update', $lab) }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            {{method_field("PUT")}}
                            <h6 class="heading-small text-muted mb-4">{{ __('Lab information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-lab">{{ __('Lab name') }}</label>
                                    <input type="text" name="name" id="input-lab" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ $lab->name }}"  autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                 <div class="form-group{{ $errors->has('capacity') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-capacity">{{ __('Lab capacity') }}</label>
                                    <input type="number" name="capacity" id="input-capacity" class="form-control form-control-alternative{{ $errors->has('capacity') ? ' is-invalid' : '' }}" placeholder="{{ __('capacity') }}" value="{{ $lab->capacity }}" required autofocus>

                                    @if ($errors->has('capacity'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('capacity') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                 <div class="form-group{{ $errors->has('location') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-location">{{ __('Lab location') }}</label>
                                    <input type="text" name="location" id="input-location" class="form-control form-control-alternative{{ $errors->has('location') ? ' is-invalid' : '' }}" placeholder="{{ __('location') }}" value="{{ $lab->location }}" required autofocus>

                                    @if ($errors->has('location'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('location') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                   <div class="form-group{{ $errors->has('supervisor') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-supervisor">{{ __('Lab supervisor') }}</label>
                                    <input type="text" name="supervisor" id="input-supervisor" class="form-control form-control-alternative{{ $errors->has('supervisor') ? ' is-invalid' : '' }}" placeholder="{{ __('supervisor') }}" value="{{ $lab->supervisor }}" required autofocus>

                                    @if ($errors->has('supervisor'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('supervisor') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="input-group mb-3 {{ $errors->has('program') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">{{ __('Lab program') }}</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input {{ $errors->has('program') ? ' is-invalid' : '' }}" name="program" id="input-program" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>

                                     @if ($errors->has('program'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('program') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Update') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

