<?php

class ArtsController extends \BaseController {


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
    //search query
    $query = Input::get('query');
    $criteria = Input::get('criteria');

    //sorting and direction
    $sortBy = Request::get('sortBy');
    $direction = (Request::get('direction'));

    if ($sortBy && $direction) {
        $arts = Art::orderBy($sortBy, $direction)->paginate(20);
    }
    elseif (($query) && ($criteria  == 'status'))
    {
        $arts = Art::where('status', 'LIKE', "%$query%")->paginate(20);
    }
    elseif (($query) && ($criteria  == 'year'))
    {
        $arts = Art::where('year', "$query")->paginate(20);
    }
    elseif (($query) && ($criteria  == 'title'))
    {
        $arts = Art::where('title', 'LIKE', "%$query%")->paginate(20);
    }
    elseif (($query) && ($criteria  == 'category'))
    {
        $arts = Art::where('category', 'LIKE', "%$query%")->paginate(20);
    }
    elseif (($query) && ($criteria  == 'subject'))
    {
        $arts = Art::where('subject', 'LIKE', "%$query%")->paginate(20);
    }
    elseif (($query) && ($criteria  == 'medium'))
    {
        $arts = Art::where('medium', 'LIKE', "%$query%")->paginate(20);
    }
    elseif (($query) && ($criteria  == 'art#'))
    {
        $arts = Art::where('id', "$query")->paginate(1);
    }
    else {
        $arts = Art::with('artist')->paginate(20);
    }
    return View::make('ims.arts.index' , ['arts' => $arts, 'direction' => $direction, 'sortBy' => $sortBy]);
}

/**
 * Show the form for creating a new resource.
 * GET /arts/create
 *
 * @return Response
 */
public function create()
{

    $artists = array('' => 'Select an Artist') + Artist::select(DB::raw('concat (second_name, ", ", first_name) as full_name,id'))->orderBy('second_name', 'asc')->lists('full_name', 'id');
//    $artists = DB::table('artists')->orderBy('second_name', 'asc')->lists('second_name','id');

//    $artists = Artist::lists('second_name', 'id');
    return View::make('ims.arts.create', ['artists'=> $artists]);
}

/**
 * Store a newly created resource in storage.
 * POST /arts
 *
 * @return Response
 */
public  function store()
{

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
        $art->status = Input::get('status');
        $art->year = Input::get('year');
        $art->height = Input::get('height');
        $art->width = Input::get('width');
        $art->depth = Input::get('depth');
        $art->price = Input::get('price');
        $art->details = Input::get('details');
        $art->subject = Input::get('subject');
        $art->medium = Input::get('medium');
        $art->artist_id = Input::get('artist');

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
    return Redirect::route('ims.arts.index');
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
    $artists = array('' => 'Assign to a different artist...') + Artist::select(DB::raw('concat (second_name, ", ", first_name) as full_name,id'))->orderBy('second_name', 'asc')->lists('full_name', 'id');
    return View::make('ims.arts.edit',['art' => $art, 'artists' => $artists]);
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
    $validator = Validator::make(Input::all(), Art::$rulesEdit);

    //process the login
    if ($validator->fails())
    {
        $input = Input::except('picture');

        return Redirect::back()->withErrors($validator->messages())->withInput($input);

    } else
    {
        $art = Art::find($id);
        $art->title = Input::get('title');
        $art->status = Input::get('status');
        $art->year = Input::get('year');
        $art->height = Input::get('height');
        $art->width = Input::get('width');
        $art->depth = Input::get('depth');
        $art->category = Input::get('category');
        $art->price = Input::get('price');
        $art->details = Input::get('details');
        $art->subject = Input::get('subject');
        $art->medium = Input::get('medium');

        if (Input::get('artist')) {
            $art->artist_id = Input::get('artist');
        }

        if (Input::hasFile('picture'))
        {
            $file = Input::file('picture');
            $name = time() . '-' . $file->getClientOriginalName();

            $file->move(public_path() . '/artPictures', $name);

            $art->picture = $name;
        }
        $art->save();

        Session::flash('message', 'Successfully updated the item of Art!');
        return Redirect::route('ims.arts.index');
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