<?php

namespace App\Http\Controllers\Frontend;

use App\Facility;
use App\SubService;
use App\ServiceCategory;
use App\ServiceSubService;
use Illuminate\Http\Request;
use App\Cnic;
use Illuminate\Support\Facades\Auth;
use File;
use Image;

use App\Http\Controllers\Controller;
use App\Slider;

class ServicesController extends Controller
{
    public function getService()
    {
        $categories = Facility::orderBy('id', 'desc')->get();
        return view('frontend.services.services-detail', compact('categories'));
    }
    
    public function searchPackages(){

        $allservices = 1;
            $services = Facility::orderBy('id', 'desc')->get();
            $SubServices = SubService::orderBy('id', 'desc')->get();
            return view('frontend.services.services-detail', compact('services', 'allservices', 'SubServices'));

    }

    public function getSubService($id = 0)
    {

        if ($id != 0) {
            $ids = [];
            $ServiceSubservices = ServiceSubService::where('facility_id', $id)->get();
            foreach ($ServiceSubservices as $key => $subservice) {
                $ids[$key] = $subservice['sub_service_id'];
            }
            $SubServices = SubService::whereIn('id', $ids)->get();
            $return = '';
            foreach ($SubServices as $service) {

                $token = csrf_field();

                if (Auth::check()) {
                    $user_id = Auth::user()->id;
                } else {
                    $user_id = NULL;
                }

                $is_cnic_exist = Cnic::where('subservice_id', $service->id)->where('user_id', $user_id)->first();


                $return .=
                    "<div class='col-md-12'>"
                    . "<div class='row right-sec'>"
                    . "<div class='col-md-4'>"
                    . "<div class='card'>";
                foreach ($service->picture as $media) {
                    $return .=
                        "<div class='card-img-top card-img-top-250'>"
                        . "<img class='services-img-sec' src='$media->url' alt='Carousel 1'>"
                        . "</div>";
                }
                $return .=

                    "</div>"
                    . "</div>"
                    . "<div class='col-md-8'>"
                    . "<h2>$service->name</h2>"
                    . "<div class='top-sec'>"
                    . "<div class='rating'>"
                    . "<label for='e4'>☆</label>"
                    . "<label for='e4'>☆</label>"
                    . "<label for='e4'>☆</label>"
                    . "<label for='e4'>☆</label>"
                    . "<label for='e4'>☆</label>"
                    . "</div>"
                    . "<div class='review'> 0 Reviews</div>"
                    // . "<div class='review-submit'> Submit a review</div>"


                    . "<div class='review-submit'>"
                    . "<a href='#openModal-comment{{$service->id}}' id='{{$service->id}}'>Write a
                        comment</a>"
                    . "</div>"

                    . "</div>"
                    . "<hr>"
                    . "<h3>$service->charges pkr</h3>"
                    . "<p>$service->description</p>"



                    . "<div id='openModal-comment{{$service->id}}' class='modalDialog' style='z-index:9999;'>"
                    . "<div class='row .home-cat-modal w-100' style='height: 350px;'>"
                    . "<a name='' id='' class='btn close' href='#close' role='button'>Close</a>"
                    . "<section>"
                    . "<div class='container'>"
                    . "<p>Write a comment ...</p>"

                    . "<form action='/comments-post' method='post'
                                    enctype='multipart/form-data'>"
                    . "{$token}"
                    . "<input type='hidden' name='sub_service_id' value='{$service->id}'>"
                    . "<textarea class='w-100' name='comment' id='' cols='60'
                                        rows='10'></textarea>"
                    . "<button type='submit' class='btn btn-primary mt-1'>Comment</button>"
                    . "</form>"
                    . "</div>"
                    . "</section>"
                    . "</div>"
                    . "</div>";


                if ($service->is_women == 0) {


                    $return .= "<a class='btn custom-cart-btn' href='/add-to-cart/$service->id'>Add to cart</a>"

                        . "<a class='btn custom-cart-btn' href='/checkout/$service->id'>Checkout</a>";

                        

                } elseif ($service->is_women == 1 && $is_cnic_exist == NULL && Auth::user()) {


                    $return .= "<a href='#openModal-about3' data-toggle='lightbox' data-gallery='gallery'
                        class='btn custom-cart-btn'>
                        Add to Cart           </a>"

                        . "<a href='#openModal-about3' data-toggle='lightbox' data-gallery='gallery'
                        class='btn custom-cart-btn'>
                        Checkout      </a>";


                    ?>

                    <div id="openModal-about3" class="modalDialog" style="z-index:9999;">
                        <div>
                            <a href="#close" title="Close" class="text-right text-secondary">Close</a>


                            <section class="message-service">

                                <div class="container">

                                    <div class="row">


                                        <h2 class="title text-center">Privacy Policy</h2><br>


                                        <p class="paragraph">

                                            <b class="text-left">For the Protection Purpose</b><br>

                                            Lorem ipsum, or lipsum as it is sometimes known, is dummy text used
                                            in laying
                                            out print, graphic or web designs. The passage is attributed to an
                                            unknown
                                            typesetter in the 15th century who is thought to have scrambled
                                            parts of
                                            Cicero's De Finibus Bonorum et Malorum for use in a type specimen
                                            book.<br><br>


                                            Lorem ipsum, or lipsum as it is sometimes known, is dummy text used
                                            in laying
                                            out print, graphic or web designs. The passage is attributed to an
                                            unknown
                                            typesetter in the 15th century who is thought to have scrambled
                                            parts of
                                            Cicero's De Finibus Bonorum et Malorum for use in a type specimen
                                            book.<br><br>


                                            Lorem ipsum, or lipsum as it is sometimes known, is dummy text used
                                            in laying
                                            out print, graphic or web designs. The passage is attributed to an
                                            unknown
                                            typesetter in the 15th century who is thought to have scrambled
                                            parts of
                                            Cicero's De Finibus Bonorum et Malorum for use in a type specimen
                                            book.<br><br>


                                            Lorem ipsum, or lipsum as it is sometimes known, is dummy text used
                                            in laying
                                            out print, graphic or web designs. The passage is attributed to an
                                            unknown
                                            typesetter in the 15th century who is thought to have scrambled
                                            parts of
                                            Cicero's De Finibus Bonorum et Malorum for use in a type specimen
                                            book.<br><br>


                                            Lorem ipsum, or lipsum as it is sometimes known, is dummy text used
                                            in laying
                                            out print, graphic or web designs. The passage is attributed to an
                                            unknown
                                            typesetter in the 15th century who is thought to have scrambled
                                            parts of
                                            Cicero's De Finibus Bonorum et Malorum for use in a type specimen
                                            book.<br><br>


                                            Lorem ipsum, or lipsum as it is sometimes known, is dummy text used
                                            in laying
                                            out print, graphic or web designs. The passage is attributed to an
                                            unknown
                                            typesetter in the 15th century who is thought to have scrambled
                                            parts of
                                            Cicero's De Finibus Bonorum et Malorum for use in a type specimen
                                            book. <br><br>

                                        </p>

                                    </div>

                                    <?php

                                    // $return.= "<form action='/uploadcnic' method='post'
                                    // enctype='multipart/form-data'>"
                                    //   . "{$token}"

                                      ?>

                                     <form action="/uploadcnic" method="post" enctype="multipart/form-data">
                                        <?php $token;  ?> 

                                        <br>

                                        <input type="hidden" name="subservice_id" value="{{$service->id}}">

                                        <label>Upload Your CNIC (front Side)
                                            <i class="fa fa-upload" aria-hidden="true"></i>
                                            <input type="file" name="cnic_front" required>

                                        </label>
                                        <br>

                                        <label>Upload Your CNIC (Back Side)
                                            <i class="fa fa-upload" aria-hidden="true"></i>
                                            <input type="file" name="cnic_back" required>
                                        </label>
                                        <br><br>

                                        <input type="submit" value="submit" name="submit" class="btn text-secondary">



                                    </form>
                            </section>

                        </div>

                    </div>

            <?php

                }


            elseif (Auth::guest())

            {

                $return .= "<a class='btn custom-cart-btn' href='/signin'>Login first to Verify your identity</a>";

            }

            else
            {
                $return .= "<a class='btn custom-cart-btn' href='/add-to-cart/$service->id'>Add to cart</a>"

                . "<a class='btn custom-cart-btn' href='/checkout/$service->id'>Checkout</a>";

                


            }




                $return .= "</div>"
                    . "</div>"
                    . "</div>";
            }

            return $return;
        } else {
            $allservices = 1;
            $services = Facility::orderBy('id', 'desc')->get();
            $SubServices = SubService::orderBy('id', 'desc')->get();
            return view('frontend.services.services-detail', compact('services', 'allservices', 'SubServices'));
        }
    }


    public function showSubServiceOnHomeServiceClick($id)
    {
        $allservices = 1;
        $ids = [];
        $services = Facility::orderBy('id', 'desc')->get();
        $ServiceSubservices = ServiceSubService::where('facility_id', $id)->get();
        foreach ($ServiceSubservices as $key => $subservice) {
            $ids[$key] = $subservice['sub_service_id'];
        }
        $SubServices = SubService::whereIn('id', $ids)->get();

        return view('frontend.services.services-detail', compact('services', 'allservices', 'SubServices'));
    }

    public static function addToCart($id = 0)
    {
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

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if cart not empty then check if this product exist then increment quantity
        if (isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');
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

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }


    // upload cnic
    public static function uploadcnic(Request $request)
    {

        // dd($request->toArray());

        if ($request->hasFile('cnic_front')) {
            $imageName1 = 'fimage_' . time() . '.' . request()->cnic_front->getClientOriginalExtension();
            request()->cnic_front->move(public_path('images/cnic/front'), $imageName1);
        }

        if ($request->hasFile('cnic_back')) {
            $imageName2 = 'bimage_' . time() . '.' . request()->cnic_back->getClientOriginalExtension();
            request()->cnic_back->move(public_path('images/cnic/back'), $imageName2);
        }

        $cnic = new Cnic;
        $user_id = Auth::user()->id;
        $cnic->user_id  = $user_id;
        $cnic->subservice_id = $request->subservice_id;

        $cnic->cnic_front = 'images/cnic/front/' . $imageName1;
        $cnic->cnic_back = 'images/cnic/back/' . $imageName2;

        $cnic->save();

        return redirect()->back()->with('success', 'CNIC Uploaded Successfully, Now you can add Women Services into Cart');
    }
    //upload cnic end



    public function update(Request $request)
    {
        if ($request->id and $request->quantity) {
            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {

            $cart = session()->get('cart');

            if (isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            session()->flash('success', 'Product removed successfully');
        }
    }
}
