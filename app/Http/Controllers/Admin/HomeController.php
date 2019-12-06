<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\CheckContact;
use Illuminate\Http\Request;
use App\HeaderFooter;
use App\Testimonial;
use App\Cnic;
use Illuminate\Support\Facades\Auth;


class HomeController
{
    public function index()
    {
        return view('home');
    }

    public function order()
    {
        $user_orders = CheckContact::select('contact.id as order_id', 'contact.*', 'c.*')->leftjoin('users as u', 'u.id', '=', 'contact.user_id')
        ->leftjoin('cnic as c', 'c.user_id', '=', 'u.id')->orderBy('contact.id', 'desc')->paginate(5);
        // $id= Auth::user()->id;
        // $user_orders = checkcontact::join('cnic as c', 'c.subservice_id', '=', 'contact.subservice_id')->where('c.user_id',$id)->get();
        //  $user_orders = checkcontact::Leftjoin('cnic as c', 'c.subservice_id', '=', 'contact.subservice_id')->get();

        // dd($user_orders->toArray());

        return view('admin.orders.index', compact('user_orders'));
    }

    public function changeOrderStatus(Request $request)
    {
        $order = CheckContact::where('id', $request['order_id'])->update(['status' => $request['id']]);
        return redirect()->back();
    }


    public function headerfooter()
    {
        $headerfooter= HeaderFooter::orderBy('id','desc')->get();
        return view('admin.headerFooter.index', compact('headerfooter'));
    }

    public function headerfooteredit($id)
    {
        $header=HeaderFooter::find($id);
        return view ('admin.headerFooter.edit',compact('header'));
    }


    public function headerfooterupdate(Request $request, $id)
    {
        $header = HeaderFooter::find($id);
        $header->address = $request->get('address');
        $header->timing = $request->get('timing');
        $header->email = $request->get('email');
        $header->phone_no = $request->get('phone_no');
        $header->fax = $request->get('fax');
        $header->facebook = $request->get('facebook');
        $header->twitter = $request->get('twitter');
        $header->insta = $request->get('insta');
        $header->youtube = $request->get('youtube');
        $header->save();

        return redirect()->back()->with('success','Successfully Updated');

    }

    public function changeCategoryStatus(Request $request)
    {
       dd($request->toArray());

    }

    public function testimonials()
    {
        $videos= Testimonial::orderBy('id','desc')->get();
        return view('admin.testimonials.index', compact('videos'));
    }

    public function testimonialsedit($id)
    {
        $video=Testimonial::find($id);
        return view ('admin.testimonials.edit',compact('video'));

    }

    public function testimonialsupdate(Request $request, $id)
    {
        $video = Testimonial::find($id);
        $video->youtube_link = $request->get('youtube_link');
        $video->save();

        return redirect()->back()->with('success','Video Link Updated');

    }


    public function homeindex()
    {
        return view('admin.error');
    }


}
