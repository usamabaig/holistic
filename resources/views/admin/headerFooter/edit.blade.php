@extends('layouts.admin')
@section('content')



<div class="card">

    <div class="card-header">
        <h4>Edit Header/footer</h4>
    </div>


    @if(session('success'))
    <div class="alert alert-success" role="alert">
    <strong>{{session('success')}}</strong>

    </div>
    @endif

    <div class="card-body">

        <form action="{{url('admin/header/update',$header->id)}}" method="post">
            @csrf
            <div class="form-group ">
                <label for="name">Address*</label>
                <input type="text" name="address" class="form-control" value="{{$header->address}}">
            </div>

            <div class="form-group ">
                <label for="name">Timing*</label>
                <input type="text" name="timing" class="form-control" value="{{$header->timing}}">
            </div>


            <div class="form-group ">
                <label for="name">Email*</label>
                <input type="text" name="email" class="form-control" value="{{$header->email}}">

            </div>


            <div class="form-group ">
                <label for="name">Phone No*</label>
                <input type="text" name="phone_no" class="form-control" value="{{$header->phone_no}}">
            </div>


            <div class="form-group ">
                <label for="name">Fax*</label>
                <input type="text" name="fax" class="form-control" value="{{$header->fax}}">
            </div>


            <div class="form-group ">
                <label for="name">Facebook*</label>
                <input type="text" name="facebook" class="form-control" value="{{$header->facebook}}">
            </div>


            <div class="form-group ">
                <label for="name">Twitter*</label>
                <input type="text" name="twitter" class="form-control" value="{{$header->twitter}}">
            </div>

            <div class="form-group ">
                <label for="name">Instagram*</label>
                <input type="text" name="insta" class="form-control" value="{{$header->insta}}">
            </div>

            <div class="form-group ">
                <label for="name">Address*</label>
                <input type="text" name="youtube" class="form-control" value="{{$header->youtube}}">
            </div>


            <button name="" id="" class="btn btn-primary" type="submit" role="button">Update</button>

        </form>


    </div>

</div>







@endsection
