@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.serviceCategory.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.serviceCategory.fields.id') }}
                        </th>
                        <td>
                            {{ $serviceCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Service Name
                        </th>
                        <td>
                            {{ $serviceCategory->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Service Picture
                        </th>
                        <td>
                            @if($serviceCategory->picture)
                                <a href="{{ $serviceCategory->picture->getUrl() }}" target="_blank">
                                    <img src="{{ $serviceCategory->picture->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>


                    <tr>
                        <th>
                        How it Work Picture
                        </th>
                        <td>
                            @if($serviceCategory->how_it_work_picture)
                                <a href="{{ $serviceCategory->how_it_work_picture->getUrl() }}" target="_blank">
                                    <img src="{{ $serviceCategory->how_it_work_picture->getUrl('thumb') }}" width="50px" height="50px"> 
                                </a>
                            @endif
                        </td>
                    </tr>


                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <nav class="mb-3">
            <div class="nav nav-tabs">

            </div>
        </nav>
        <div class="tab-content">

        </div>
    </div>
</div>
@endsection