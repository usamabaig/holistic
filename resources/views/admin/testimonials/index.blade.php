@extends('layouts.admin')
@section('content')


<section>


    <div class="container">

        <div style="padding:50px">
            <h1 class="center-text"> Youtube Video </h1>
        </div>

        <div class="row text-center">

            <table class="table">
                <thead>

                    <tr>
                        <th scope="col">Youtube Link</th>
                        <th>Action</th>


                    </tr>
                </thead>
                <tbody>

                    @foreach ($videos as $video)
                    <tr>

                        <td>{{$video->youtube_link}}</td>
                        <td>
                            <a name="" id="" class="btn btn-warning"
                            href="{{url('admin/testimonials/edit',$video->id)}}"
                            role="button">Edit</a>
                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>




        </div>

    </div>

</section>

@endsection
