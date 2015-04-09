<?php

class GalleryController extends \BaseController {

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
        $galleryArt = Gallery::all();
        return View::make('ims.gallery.index', ['galleryArt' => $galleryArt]);
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
        $getId = Gallery::find($id);

        //search query
        $query = Input::get('query');
        $criteria = Input::get('criteria');

//        //sorting and direction
//        $sortBy = Request::get('sortBy');
//        $direction = Request::get('direction');
//
//        if ($sortBy && $direction)
//        {
//            $arts = Art::orderBy($sortBy, $direction)->paginate(20);
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

        return View::make('ims.gallery.edit', ['arts' => $arts, 'getId' => $getId]);
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
        $radio = Input::get('radio');
        $gallery = Gallery::find($id);

        if ($radio)
        {
            $gallery->arts_id = $radio;
            $gallery->save();
            Session::flash('message', 'Successfully updated the gallery!');
        }

        return Redirect::route('ims.gallery.index');
    }


}