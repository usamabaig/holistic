@extends('layouts.admin')
@section('content')



<div style="width:100%; overflow-x: auto; ">

<table class="table table-bordered table-striped table-hover datatable datatable-Facility dataTable no-footer">
    <thead>
        <tr>
            <th>Address</th>
            <th>Timing</th>
            <th>Email</th>
            <th>Phone no.</th>
            <th>Fax</th>
            <th>Facebook</th>
            <th>Twitter</th>
            <th>Instagram</th>
            <th>Youtube</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($headerfooter as $header)

        <tr>
            <td>{{$header->address}}</td>
            <td>{{$header->timing}}</td>
            <td>{{$header->email}}</td>
            <td>{{$header->phone_no}}</td>
            <td>{{$header->fax}}</td>
            <td>{{$header->facebook}}</td>
            <td>{{$header->twitter}}</td>
            <td>{{$header->insta}}</td>
            <td>{{$header->youtube}}</td>
            <td>
                <a name="" id="" class="btn btn-warning"
                href="{{url('admin/header/edit',$header->id)}}"
                role="button">Edit</a>


            </td>
        </tr>

        @endforeach

    </tbody>
</table>

</div>


@endsection
