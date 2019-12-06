@extends('layouts.user')
@section('content')


<section>


    <div class="container">

        <div style="padding:50px">
            <h1 class="center-text"> Order History </h1>
        </div>

        <div class="row text-center">

            <table class="table">
                <thead>

                    <tr>
                        {{-- <th scope="col">#</th> --}}
                        <th scope="col">Contact Name</th>
                        <!--<th scope="col">Order Person</th>-->
                        <th scope="col">Order Date</th>
                        <th scope="col">Order Time</th>
                        <th scope="col">Address</th>
                        <th scope="col">Service Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>



                        </th>

                    </tr>
                </thead>
                <tbody>

                        @foreach ($orders as $order)
                    <tr>

                        <td>{{$order->name}}</td>
                          <!--<td>{{$order->order_person_name}}</td>-->
                          <td>{{$order->date}}</td>
                          <td>{{$order->time}}</td>
                            <td>{{$order->address}}</td>
                            <td>{{$order->service_name}}</td>
                            <td>{{$order->charges}}</td>

                            <td>
                                @if($order->status == 0)
                                <b>Pending</b>
                                @elseif($order->status == 1)
                               <b>Complete</b>
                                @else
                               <b>Reject </b>
                                @endif

                            </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>




        </div>

    </div>

</section>


@endsection
