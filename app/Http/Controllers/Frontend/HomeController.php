<?php

namespace App\Http\Controllers\Frontend;

use App\Facility;
use App\FaqQuestion;
use App\Http\Controllers\Controller;
use App\Slider;
use App\ServiceSubService;
use App\SubService;
use App\ServiceCategory;
use Illuminate\Http\Request;
use App\CheckContact;
use App\Comment;
use App\RoleUser;
use Illuminate\Support\Facades\Auth;
use App\User;
use Mail;
use App\Cnic;
use File;
use Image;




class HomeController extends Controller
{
    public function index()
    {
        $facilities = SubService::pluck('name');
        return view('frontend.home', compact('facilities'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function about()
    {
        return view('frontend.about.about');
    }

    public function term()
    {
        return view('frontend.terms');
    }

    public function sliders()
    {

        $sliders = slider::select('image', 'title', 'description')->where('status', '=', '1')->get();


        return view('home')->with('sliders', $sliders);
    }

    public function Signup()
    {
        return view('frontend.auth.signup');
    }

    public function services($id = 0)
    {
        $services = ServiceCategory::where('id', $id)->first();
        $subServices = Facility::where('category_id', $id)->get();

        if ($subServices) {
            $ServiceSubservices = ServiceSubService::where('facility_id', $subServices[0]['id'])->get();
            foreach ($ServiceSubservices as $key => $subservice) {
                $ids[$key] = $subservice['sub_service_id'];
            }
        }
        // $sub_service_ids = explode(',',$ids);
        $comments = Comment::join('users as u', 'u.id', '=', 'comments.user_id')->whereIn('subservice_id', $ids)->get();

        if (isset($subServices)) {
            foreach ($subServices as $sub_service) { }
        }

        $FAQs = FaqQuestion::where('category_id', $id)->get();

        return view('frontend.services.services', compact('subServices', 'services', 'FAQs', 'comments'));
    }
    public function signin()
    {
        return view('frontend.auth.login');
    }

    public function servicesDetail()
    {
        return view('frontend.services.services-detail');
    }

    public function checkout($id = 0)
    {
        if ($id == 0) {

            return view('frontend.checkout.checkout');
        } else {
            session()->forget('cart');

            $product = SubService::find($id);

            if (!$product) {

                abort(404);
            }

            $cart = session()->get('cart');

            // if cart is empty then this the first product
            if (!$cart) {

                $cart = [
                    $id => [
                        "sub_service_id" => $product->id,
                        "name" => $product->name,
                        "quantity" => 1,
                        "price" => $product->charges,
                        "photo" => $product['picture'][0]['url'],
                        "description" => $product['description']
                    ]
                ];

                session()->put('cart', $cart);

                return view('frontend.checkout.checkout');
            }

            // if cart not empty then check if this product exist then increment quantity
            if (isset($cart[$id])) {

                $cart[$id]['quantity']++;

                session()->put('cart', $cart);

                return view('frontend.checkout.checkout');
            }

            // if item not exist in cart then add to cart with quantity = 1
            $cart[$id] = [
                "sub_service_id" => $product->id,
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->charges,
                "photo" => $product['picture'][0]['url'],
                "description" => $product['description']

            ];

            session()->put('cart', $cart);

            // $facilities = SubService::where('id', $id)->get();
            return view('frontend.checkout.checkout');
        }
    }

    public function ordersdetail()
    {

        $id= Auth::user()->id;
        $orders = checkcontact::
        //     join('cnic as c', 'c.subservice_id', '=', 'contact.subservice_id')
        // ->where('contact.user_id',$id)->get();
                where('user_id',$id)->get();

        return view('frontend.orders', compact('orders'));

    }

    public function postPost(Request $request)

    {
        $user = Auth::user();

        if ($user) {
            request()->validate(['rate' => 'required']);

            $post = SubService::find($request->id);
            $rating = new \willvincent\Rateable\Rating;
            $rating->rating = $request->rate;
            $rating->user_id = Auth::user()->id;
            $post->ratings()->save($rating);
            return redirect()->back();
        }
        return redirect()->back()->with('alert', 'Login First!');

        // return redirect()->back();

    }

    public function checkcontact(Request $request)
    {
        $request->validate([
            // 'first_name' => 'required',
            // 'last_name' => 'required',
            // 'email' => 'required',
            // 'password' => 'required',
            // 'phone_no' => 'required',
            // 'cnic' => 'required',
            // 'address' => 'required',

        ]);


        if (session('cart')) {
            foreach (session('cart') as $id => $details) {

                // dd(session('cart'));
                $CheckContact = new CheckContact;

                $CheckContact->order_person_name = Auth::user()->name;
                $CheckContact->user_id = Auth::user()->id;
                $CheckContact->service_name = $details['name'];
                $CheckContact->subservice_id = $details['sub_service_id'];
                $CheckContact->charges = $details['price'];
                $CheckContact->quantity = $details['quantity'];
                $CheckContact->name = $request->name;
                $CheckContact->date = $request->date;
                $CheckContact->time = $request->time;
                $CheckContact->address = $request->address;
                $CheckContact->city = $request->city;
                $CheckContact->country = $request->country;
                $CheckContact->save();

                $order_ids[] = $CheckContact->id;
            }
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
        $email_data['to_emails'] = ['support@holisticgroup.com.pk', 'admin@holisticgroup.com.pk', 'saqib@holisticgroup.com.pk', 'salman.arif684@gmail.com'];



        $mail_sent = Mail::send($email_data['email_view_user'], $dataa, function ($message) use ($request) {
            $message->subject('Service Notification');
            $message->from('info@holisticgroup.com.pk', 'Holistic Group');
            $message->to(Auth::user()->email, Auth::user()->full_name);
        });


        
        Mail::send($email_data['email_view_admin'], $dataa, function ($m) use ($email_data) {
            $m->from($email_data['from_email'], $email_data['from_name']);
            $m->subject('Service Notification');
            if (count($email_data['to_emails']) > 0) {
                $m->to($email_data['to_emails']);
            }
        });

        session()->forget('cart');



        return redirect()->route('thanks');

        // return redirect()->back()->with('#pills-complete', 'Thankyou For your Order');
    }


    public function indexorder()
    {

        // $CheckContact = checkcontact::all();
    }


    public function registerUser(Request $request)
    {
        // dd($request->first_name);

        // $request->validate([
        //     'first_name' => 'required',
        //     'last_name' => 'required',
        //     'email' => 'required',
        //     'password' => 'required',
        //     'phone_no' => 'required',
        //     'cnic' => 'required',
        //     'address' => 'required',

        // ]);

        $user = new User;
        $user->full_name = $request->first_name . ' ' . $request->last_name;
        $user->user_role_id = 2;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->phone_no = $request->phone_no;
        $user->cnic = $request->cnic;
        $user->address = $request->address;
        // $user->is_login = 1;
        $user->language = 'EN';

        $user->save();

        $user_role = new RoleUser;
        $user_role->user_id = $user->id;
        $user_role->role_id = 2;
        $user_role->save();

        return redirect()->route('signin')->with('register', 'Your account have been register, you can login now');
    }


    public function commentspost(Request $request)
    {
        if (Auth::check()) {

            $user = Auth::user()->id;
            $comment = new Comment;
            $comment->user_id = $user;
            $comment->subservice_id = $request->sub_service_id;
            $comment->comment = $request->comment;
            $comment->save();

            return redirect()->back();
        }

        return redirect()->back();
    }

    public function thankyou()
    {
        return view('frontend.checkout.thankyou');
    }


    public function career()
    {
        return view ('frontend.career');
    }


}
