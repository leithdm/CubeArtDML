<?php

class CarouselController extends \BaseController {

    /**
     *  Only accessible if authorized
     */
    public function __construct()
    {
        $this->beforeFilter('auth');
    }

    /**
     * Display a listing of the resource.
     * GET /arts
     *
     * @return Response
     */
    public function index()
    {
        $galleryArt = Carousel::all();
        return View::make('ims.carousel.index', ['galleryArt' => $galleryArt]);
    }


    /**
     * Show the form for editing the specified resource.
     * GET /arts/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {

        $getId = Carousel::find($id);

        //search query
        $query = Input::get('query');
        $criteria = Input::get('criteria');

        if (($query) && ($criteria == 'status'))
        {
            $arts = Art::where('status', 'LIKE', "%$query%")->paginate(20);
        } elseif (($query) && ($criteria == 'title'))
        {
            $arts = Art::where('title', 'LIKE', "%$query%")->paginate(20);
        } elseif (($query) && ($criteria == 'category'))
        {
            $arts = Art::where('category', 'LIKE', "%$query%")->paginate(20);
        } elseif (($query) && ($criteria == 'art#'))
        {
            $arts = Art::where('id', "$query")->paginate(1);
        } else
        {
            $arts = Art::with('artist')->paginate(20);
        }

        return View::make('ims.carousel.edit', ['arts' => $arts, 'getId' => $getId]);
    }

    /**
     * Update the specified resource in storage.
     * PUT /arts/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $gallery = Carousel::find($id);
        $radio = Input::get('radio');

        if ($radio)
        {
            $gallery->arts_id = $radio;
            $gallery->save();
            Session::flash('message', 'Successfully updated the carousel!');
        }

        return Redirect::route('ims.carousel.index');


    }


}