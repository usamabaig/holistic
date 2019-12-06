@extends('layouts.admin')
@section('content')



<div class="card">

    <div class="card-header">
        <h4>Edit Youtube Link</h4>
    </div>

    @if(session('success'))
    <div class="alert alert-success" role="alert">
    <strong>{{session('success')}}</strong>

    </div>
    @endif


    <div class="card-body">

        <form action="{{url('admin/testimonials/update',$video->id)}}" method="post">
            @csrf


            <div class="form-group ">
                <label for="name">Youtube link*</label>
                <input type="text" name="youtube_link" class="form-control" value="{{$video->youtube_link}}">
            </div>

            <button name="" id="" class="btn btn-primary" type="submit" role="button">Update</button>

        </form>


    </div>

</div>







@endsection
