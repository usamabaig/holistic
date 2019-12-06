<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use File;
use Image;
use App\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $images = Slider::latest()->paginate(5);
        return view('admin.slider.slider', ['images' => $images]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,jpg,png,gif|max:8000'
        ]);

        if ($request->hasFile('image')) {
            $images = $request->file('image');

            $org_img = $thm_img = true;

            if( ! File::exists('images/slider/originals/')) {
                $org_img = File::makeDirectory(public_path('images/slider/originals/'), 0777, true);
            }
            // if ( ! File::exists('images/slider/thumbnails/')) {
            //     $thm_img = File::makeDirectory(public_path('images/slider/thumbnails'), 0777, true);
            // }

            foreach($images as $key => $image) {

                $slider = new Slider;

                $filename = rand(1111,9999).time().'.'.$image->getClientOriginalExtension();

                $org_path = 'images/slider/originals/' . $filename;
                // $thm_path = 'images/slider/thumbnails/' . $filename;


                $slider->image     = 'images/slider/originals/'.$filename;
                // $slider->thumbnail = 'images/slider/thumbnails/'.$filename;



                $slider->title     = $request->title;
                $slider->status    = $request->status;
                $slider->description = $request->description;

                if ( ! $slider->save()) {
                    return redirect()->back()->with('error', 'slider could not be updated');

                }

               if (($org_img && $thm_img) == true) {
                   Image::make($image)->fit(1920, 749, function ($constraint) {
                           $constraint->upsize();
                       })->save($org_path);
                //    Image::make($image)->fit(270, 160, function ($constraint) {
                //        $constraint->upsize();
                //    })->save($thm_path);
               }
            }
        }
        return redirect()->back()->with('success', 'Images Inserted Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, slider $slider)
    {
        $image = Slider::findOrFail($request->id);

        if ($image->status == 1) {
            $image->status = 0;
            $status = 'disabled';
        } else {
            $image->status = 1;
            $status = 'enabled';
        }

        if ( ! $image->save()) {

            return redirect()->back()->with('error', 'Image could not be reverted');


        }
        return redirect()->back()->with('success','Image has been successfully '.$status);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Slider::findOrFail($id);

        if ($post->delete()) {

            return redirect()->back()->with('success', 'Deleted Successfully');

        } else {

            return redirect()->back()->with('error', 'Image could not be deleted.');
        }

        return redirect()->route('slider');
    }

}
