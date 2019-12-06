@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.area.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.areas.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.area.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($area) ? $area->name : '') }}" required>
                @if($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.area.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('lat') ? 'has-error' : '' }}">
                <label for="lat">{{ trans('cruds.area.fields.lat') }}</label>
                <input type="text" id="lat" name="lat" class="form-control" value="{{ old('lat', isset($area) ? $area->lat : '') }}">
                @if($errors->has('lat'))
                    <p class="help-block">
                        {{ $errors->first('lat') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.area.fields.lat_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('lng') ? 'has-error' : '' }}">
                <label for="lng">{{ trans('cruds.area.fields.lng') }}</label>
                <input type="text" id="lng" name="lng" class="form-control" value="{{ old('lng', isset($area) ? $area->lng : '') }}">
                @if($errors->has('lng'))
                    <p class="help-block">
                        {{ $errors->first('lng') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.area.fields.lng_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection