<?php

class ArtistController extends \BaseController {

    /**
     *  Only accessible if authorized
     */
    public function __construct()
    {
        $this->beforeFilter('auth');
    }

    /**
     * Display a listing of the resource.
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
            $artists = Artist::orderBy($sortBy, $direction)->paginate(20);
        }
        elseif (($query) && ($criteria  == 'first_name'))
        {
            $artists = Artist::where('first_name', 'LIKE', "%$query%")->paginate(20);
        }
        elseif (($query) && ($criteria  == 'second_name'))
        {
            $artists = Artist::where('second_name', 'LIKE', "%$query%")->paginate(20);
        }
        elseif (($query) && ($criteria  == 'city'))
        {
            $artists = Artist::where('city', 'LIKE', "%$query%")->paginate(20);
        }
        elseif (($query) && ($criteria  == 'country'))
        {
            $artists = Artist::where('country', 'LIKE', "%$query%")->paginate(20);
        }
        elseif (($query) && ($criteria  == 'artist#'))
        {
            $artists = Artist::where('id', "$query")->paginate(1);
        }
        else {
            $artists = Artist::orderBy('id', 'asc')->paginate(20);
        }

        return View::make('ims.artists.index', ['artists' => $artists, 'direction' => $direction, 'sortBy' => $sortBy ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //load the create form (app/views/ims/create.blade.php
        return View::make('ims.artists.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validator = Validator::make(Input::all(), Artist::$rules);

        //process the login
        if ($validator->fails())
        {
            $input = Input::except('picture');
            return Redirect::back()->withErrors($validator->messages())->withInput($input);

        } else
        {
            //store

            $artist = new Artist;
            $artist->title = Input::get('title');
            $artist->first_name = Input::get('first_name');
            $artist->middle_name = Input::get('middle_name');
            $artist->second_name = Input::get('second_name');
            $artist->address1 = Input::get('address1');
            $artist->address2 = Input::get('address2');
            $artist->address3 = Input::get('address3');
            $artist->quote = Input::get('quote');
            $artist->city = Input::get('city');
            $artist->country = Input::get('country');
            $artist->about = Input::get('about');
            $artist->email = Input::get('email');
            $artist->phone1 = Input::get('phone1');
            $artist->phone2 = Input::get('phone1');
            $artist->facebook = Input::get('facebook');
            $artist->twitter = Input::get('twitter');
            $artist->pinterest = Input::get('pinterest');
            $artist->google = Input::get('google');

            if (Input::hasFile('picture'))
            {
                $file = Input::file('picture');
                $name = time() . '-' . $file->getClientOriginalName();

                $file = $file->move(public_path() . '/upload', $name);

                $artist->picture = $name;
            }
            $artist->save();

            //redirect
            Session::flash('message', 'Successfully created the Artist!');
            return Redirect::to('ims/artists');
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //get the artist
        $artist = Artist::find($id);

        //show the view and pass the artist to it
        return View::make('ims.artists.show')->with('artist', $artist);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //get the artist
        $artist = Artist::find($id);

        //show the edit form and pass the artist
        return View::make('ims.artists.edit')->with('artist', $artist);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {

        $validator = Validator::make(Input::all(), Artist::$rules);

        //process the artist update
        if ($validator->fails())
        {
            $input = Input::except('picture');

            return Redirect::to('ims/artists/' . $id . '/edit')->withErrors($validator)->withInput($input);

        } else
        {
            //store
            $artist = Artist::find($id);

            $artist->title = Input::get('title');
            $artist->first_name = Input::get('first_name');
            $artist->middle_name = Input::get('middle_name');
            $artist->second_name = Input::get('second_name');
            $artist->address1 = Input::get('address1');
            $artist->address2 = Input::get('address2');
            $artist->address3 = Input::get('address3');
            $artist->quote = Input::get('quote');
            $artist->city = Input::get('city');
            $artist->country = Input::get('country');
            $artist->about = Input::get('about');
            $artist->email = Input::get('email');
            $artist->phone1 = Input::get('phone1');
            $artist->phone2 = Input::get('phone1');
            $artist->facebook = Input::get('facebook');
            $artist->twitter = Input::get('twitter');
            $artist->pinterest = Input::get('pinterest');
            $artist->google = Input::get('google');

            if (Input::hasFile('picture'))
            {
                $file = Input::file('picture');
                $name = time() . '-' . $file->getClientOriginalName();
                $file = $file->move(public_path() . '/upload', $name);
                $artist->picture = $name;
            }
            $artist->save();

            //redirect
            Session::flash('message', 'Successfully updated the Artist!');
            return Redirect::to('ims/artists');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //delete
        $artist = Artist::find($id);
        $artist->delete();

        //redirect
        Session::flash('message', 'Successfully deleted the Artist!');

        return Redirect::to('ims/artists');
    }


}
