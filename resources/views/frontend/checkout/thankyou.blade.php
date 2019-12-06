@extends('layouts.user')
@section('content')

<section class="complete-sec">

        <div class="container bg-section">

                <div class="row center-text complete-row">

                        <i class="fa fa-check-circle tick-mark text-center" aria-hidden="true"></i>


                        <h2>Thankyou your order is Complete</h2>

             
                
                
                
                <ul class="text-left" style="margin-top: 24px; color:grey;padding-bottom: 10px;">
                    
                    <li style="padding-bottom: 7px; padding-top: 7px;">
                        
                        Your Order is being Processed and you will shortly receive a confirmation email to 
                
                
                @if(Auth::check())
                
                <b>{{Auth::user()->email}}</b>
                
                @else 
                
                
                
                @endif
                        
                        
                    </li>
                    
                    
                    
                    
                    
                      <li>
                        
                        If you have any query regarding your order please contact <b>support@holisticgroup.com.pk</b>
                
        
                        
                        
                    </li>
                </ul>
                
              
            


                </div>




                <p></p>

                    <div style="width:200px;" class="center-text">
                    <a name="" id="" class="shooping-btn center-text" href="{{url('services-detail')}}" role="button">Continue Shooping</a>
                </div>

        </div>
    </section>


@endsection
