<?php

class ArtsNestedController extends \BaseController {


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
public function index($id)
{

    $artist = Artist::find($id);

    return View::make('ims.artists.arts.index')->with('artist', $artist);
}

/**
 * Show the form for creating a new resource.
 * GET /arts/create
 *
 * @return Response
 */
public function create($id)
{
    $artist = Artist::find($id);
    return View::make('ims.artists.arts.create', ['artist' => $artist]);
}

/**
 * Store a newly created resource in storage.
 * POST /arts
 *
 * @return Response
 */
public  function store($id)
{

//    $artist = Artist::find($id);
    $validator = Validator::make(Input::all(), Art::$rules);

    //process the login
    if ($validator->fails())
    {
        $input = Input::except('picture');

        return Redirect::back()->withErrors($validator->messages())->withInput($input);

    } else
    {
        $art = new Art;
        $art->title = Input::get('title');
        $art->category = Input::get('category');
        $art->price = Input::get('price');
        $art->description = Input::get('description');
        $art->subject = Input::get('subject');
        $art->medium = Input::get('medium');
        $art->artist_id = $id;

        if (Input::hasFile('picture'))
        {
            $file = Input::file('picture');
            $name = time() . '-' . $file->getClientOriginalName();

            $file->move(public_path() . '/artPictures', $name);

            $art->picture = $name;
        }
        $art->save();
    }

    Session::flash('message', 'Successfully added the Art!');

    return Redirect::route('ims.artists.show', ['artist' => $id]);
}

/**
 * Display the specified resource.
 * GET /arts/{id}
 *
 * @param  int $id
 * @return Response
 */
public
function show($id)
{
    $art = Art::find($id);

    return View::make('ims.arts.show')->with('art', $art);
}

/**
 * Show the form for editing the specified resource.
 * GET /arts/{id}/edit
 *
 * @param  int $id
 * @return Response
 */
public
function edit($id)
{
    $art = Art::find($id);

    return View::make('ims.arts.edit')->with('art', $art);

}

/**
 * Update the specified resource in storage.
 * PUT /arts/{id}
 *
 * @param  int $id
 * @return Response
 */
public
function update($id)
{
    $validator = Validator::make(Input::all(), Art::$rules);

    //process the login
    if ($validator->fails())
    {
        $input = Input::except('picture');

        return Redirect::back()->withErrors($validator->messages())->withInput($input);

    } else
    {
        $art = Art::find($id);
        $art->title = Input::get('title');
        $art->category = Input::get('category');
        $art->price = Input::get('price');
        $art->description = Input::get('description');
        $art->subject = Input::get('subject');
        $art->medium = Input::get('medium');

        if (Input::hasFile('picture'))
        {
            $file = Input::file('picture');
            $name = time() . '-' . $file->getClientOriginalName();

            $file->move(public_path() . '/artPictures', $name);

            $art->picture = $name;
        }
        $art->save();

//        return Redirect::route('ims.arts.index');
//              return Redirect::back();
    }
}

/**
 * Remove the specified resource from storage.
 * DELETE /arts/{id}
 *
 * @param  int $id
 * @return Response
 */
public
function destroy($id)
{
    Art::find($id)->delete();

    //redirect
    Session::flash('message', 'Successfully deleted the item of Art!');

    return Redirect::route('ims.arts.index');
}

}