@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>{{ trans('cruds.order.title') }}</b>
                </div>
                <div class="panel-body">


                    <div style="width:100%; overflow-x: auto; ">
                        <table
                            class="table table-bordered table-striped table-hover datatable datatable-Facility dataTable no-footer">
                            <thead>

                                <tr>
                                    {{-- <th scope="col">#</th> --}}
                                    <th scope="col">Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Service Name</th>
                                    <th scope="col">Cnic Front</th>
                                    <th scope="col">Cnic Back</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Current Status</th>
                                    <th scope="col">Update Status</th>


                                    </th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($user_orders as $order)
                                <tr>

                                    <td>{{$order->order_person_name}}</td>
                                    <td>{{$order->date}}</td>
                                    <td>{{$order->time}}</td>
                                    <td style="width:200px; height:150px;">{{$order->address}}</td>
                                    <td>{{$order->service_name}}</td>
                                    <!--<td>{{$order->cnic_front}}</td>-->
                                    <!--<td>{{$order->cnic_back}}</td>-->

                                    <td>
                                        @if($order->cnic_front != NULL)

                                        <img src="{{asset($order->cnic_front)}}" height="100px" width="150px" alt="">

                                        @else

                                        <b>Not a Women Service</b>

                                        @endif

                                    </td>
                                    <td>
                                        @if($order->cnic_back != NULL)

                                        <img src="{{asset($order->cnic_back)}}" height="100px" width="150px" alt="">


                                        @else

                                        <b>Not a Women Service</b>

                                        @endif


                                    </td>

                                    <td>{{$order->charges}}</td>
                                   
                                    <td>
                                        @if($order->status == 0)
                                        <b
                                            style="background-color:yellow; padding:5px; border:1px solid:grey;">Pending</b>
                                        @elseif($order->status == 1)
                                        <b
                                            style="background-color:green; color:white; padding:5px; border:1px solid:grey;">Complete</b>
                                        @else
                                        <b
                                            style="background-color:red; color:white; padding:5px; border:1px solid:grey;">Reject
                                        </b>
                                        @endif

                                    </td>
                                    <td>

                                        <select name="order_status" order-id="{{$order->order_id}}" class="order_status"
                                            id="order_status">
                                            <option value="" selected>Change Status</option>
                                            <option value="1">Approved</option>
                                            <option value="0">Pending</option>
                                            <option value="2">Rejected</option>
                                        </select>

                                    </td>

                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{$user_orders->links()}}

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- jQuery Min JS -->
<script src="{{asset('frontendJS/jquery.min.js')}}"></script>
<!-- Popper Min JS -->
<script src="{{asset('frontendJS/popper.min.js')}}"></script>
<!-- Bootstrap Min JS -->
<script src="{{asset('frontendJS/bootstrap.min.js')}}"></script>
<!-- Parallax Min JS -->
<script src="{{asset('frontendJS/parallax.min.js')}}"></script>
<!-- MeanMenu JS -->
<script src="{{asset('frontendJS/jquery.meanmenu.js')}}"></script>
<!-- Slick Min JS -->
<script src="{{asset('frontendJS/slick.min.js')}}"></script>
<!-- Owl Carousel Min JS -->
<script src="{{asset('frontendJS/owl.carousel.min.js')}}"></script>
<!-- MixItUp Min JS -->
<script src="{{asset('frontendJS/mixitup.min.js')}}"></script>
<!-- Odometer Min Js -->
<script src="{{asset('frontendJS/odometer.min.js')}}"></script>
<!-- Appear Min JS -->
<script src="{{asset('frontendJS/jquery.appear.min.js')}}"></script>
<!-- Magnific Popup Min JS -->
<script src="{{asset('frontendJS/jquery.magnific-popup.min.js')}}"></script>
<!-- Nice Select Min CSS -->
<script src="{{asset('frontendJS/jquery.nice-select.min.js')}}"></script>
<!-- AjaxChimp Min JS -->
<script src="{{asset('frontendJS/jquery.ajaxchimp.min.js')}}"></script>
<!-- Form Validator Min JS -->
<script src="{{asset('frontendJS/form-validator.min.js')}}"></script>
<!-- Contact Form Min JS -->
<script src="{{asset('frontendJS/contact-form-script.js')}}"></script>
<!-- Fennec Map JS -->
<script src="{{asset('frontendJS/fennec-map.js')}}"></script>
<!-- Main JS -->
<script src="{{asset('frontendJS/main.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function (e) {

        $("body").on("change", ".order_status", function (e) {


            var value = $(this).val();

            var order_id = $(this).attr('order-id');

            $.ajax({
                url: "changeOrderStatus/" + $(this).val(),
                data: {
                    _token: '{{ csrf_token() }}',
                    id: $(this).val(),
                    order_id: $(this).attr('order-id')
                },
                type: 'post',
                success: function (html) {
                    window.location.reload();
                }
            });
        });


    });

</script>

@endsection
