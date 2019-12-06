<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\CheckContact;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreFacilityRequest;
use App\Http\Requests\UpdateFacilityRequest;
use App\Http\Resources\Admin\OrderResource;
use App\ServiceCategory;
use App\SubService;
use App\ServiceSubService;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class OrderApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        // abort_if(Gate::denies('facility_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // return new FacilityResource(Facility::with(['category', 'areas'])->get());
    }

    public function orderPlace(Request $request)
    {
        $ids = explode(',',$request->sub_service_ids);
        $quantity = explode(',',$request->sub_service_qty);
        $facilities = SubService::whereIn('id', $ids)->get();

        $user = User::where('id', $request->user_id)->first();

        foreach($facilities as $key => $facility){

            $CheckContact = new CheckContact;
            $CheckContact->order_person_name = $user->full_name;
            $CheckContact->user_id = $user->id;
            $CheckContact->service_name = $facility['name'];
            $CheckContact->charges = $facility['charges'];
            $CheckContact->quantity = $quantity[$key];
            // $CheckContact->name = $request->name;
            $CheckContact->date = $request->date;
            $CheckContact->time = $request->time;
            $CheckContact->address = $request->address;
            $CheckContact->city = $request->city;
            $CheckContact->country = $request->country;
            // dd($CheckContact->toArray());
            $CheckContact->save();

            $order_ids[] = $CheckContact->id;

 
        }

        $orders = CheckContact::whereIn('id', $order_ids)->get();

        foreach($orders as $order){
            $service_names[] = $order->service_name;
            $service_quantity[] = $order->quantity;
            $service_charges[] = $order->charges;
            $order_person_name = $order->name;
            $date = $order->date;
            $time = $order->charges;
            $address = $order->address;
        }

        $service_name_in_string = implode(', ', $service_names);
        $service_qty_in_string = implode(', ', $service_quantity);
        $service_charges_in_string = implode(', ', $service_charges);

        $email_data = [];
        $dataa = [];
        $dataa['service_name'] = $service_name_in_string;
        $dataa['order_person_name'] = $order_person_name;
        $dataa['charges'] = $service_charges_in_string;
        $dataa['quantity'] = $service_qty_in_string;
        $dataa['date'] = $date;
        $dataa['time'] = $time;
        $dataa['address'] = $address;


        $email_data['email_view_user'] = 'frontend.email_format_user';
        $email_data['email_view_admin'] = 'frontend.email_format_admin';

        $email_data['from_email'] = 'info@holisticgroup.com.pk';
        $email_data['from_name'] = 'Holistic Group';
        $email_data['to_emails'] = ['support@holisticgroup.com.pk', 'admin@holisticgroup.com.pk', 'saqib@holisticgroup.com.pk',  'salman.arif684@gmail.com'];


        $mail_sent = Mail::send($email_data['email_view_user'], $dataa, function ($message) use ($request, $user) {
            $message->subject('Service Notification');
            $message->from('info@holisticgroup.com.pk', 'Holistic Group');
            $message->to($user->email, $user->full_name);
        });


        if ($mail_sent) {

            Mail::send($email_data['email_view_admin'], $dataa, function ($m) use ($email_data) {
                $m->from($email_data['from_email'], $email_data['from_name']);
                $m->subject('Service Notification');
                if (count($email_data['to_emails']) > 0) {
                    $m->to($email_data['to_emails']);
                }
            });
        }

            return (new OrderResource($CheckContact))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);  

    }



    public function orderHistory(Request $request)
    {
        $orders = CheckContact::where('user_id',$request->user_id)->get();
        return new OrderResource($orders);
    }

}
