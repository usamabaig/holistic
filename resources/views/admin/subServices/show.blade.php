@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.subService.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.subService.fields.id') }}
                        </th>
                        <td>
                            {{ $subService->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subService.fields.name') }}
                        </th>
                        <td>
                            {{ $subService->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subService.fields.charges') }}
                        </th>
                        <td>
                            {{ $subService->charges }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subService.fields.description') }}
                        </th>
                        <td>
                            {!! $subService->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Service
                        </th>
                        <td>
                            @foreach($subService->services as $id => $service)
                                <span class="label label-info label-many">{{ $service->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subService.fields.picture') }}
                        </th>
                        <td>
                            @foreach($subService->picture as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    <img src="{{ $media->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>


    </div>
</div>
@endsection