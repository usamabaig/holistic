@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.feedback.title') }}
                </div>
                <div class="panel-body">


                    <div style="width:100%; overflow-x: auto; ">

                        <table
                            class="table table-bordered table-striped table-hover datatable datatable-Facility dataTable no-footer">
                            <thead>

                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Comment</th>
                                    <th scope="col">Package</th>
                                    <th scope="col">Date & Time</th>
                                </tr>

                            </thead>

                            <tbody>

                            
                                @foreach ($comments as $comment)
                                <tr>

                                    <td>{{$comment->id}}</td>
                                    <td>{{$comment->full_name}}</td>
                                    <td>{{$comment->comment}}</td>
                                    <td>{{$comment->name}}</td>
                                    <td>{{$comment->created_at}}</td>



                                </tr>


                                @endforeach

                            </tbody>
                        </table>


                    </div>



                </div>
            </div>

        </div>
    </div>
</div>
@endsection
