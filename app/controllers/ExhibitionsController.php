<?php

class ExhibitionsController extends \BaseController {


    /**
     *  Only accessible if authorized
     */
    public function __construct()
    {
        $this->beforeFilter('auth');
    }

    /**
     * Display a listing of the resource.
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
            $exhibition = Exhibition::orderBy($sortBy, $direction)->paginate(20);
        }
        elseif (($query) && ($criteria  == 'title'))
        {
            $exhibition = Exhibition::where('title', 'LIKE', "%$query%")->paginate(20);
        }
        elseif (($query) && ($criteria  == 'description'))
        {
            $exhibition = Exhibition::where('description', 'LIKE', "%$query%")->paginate(20);
        }
        elseif (($query) && ($criteria  == 'event#'))
        {
            $exhibition = Exhibition::where('id', "$query")->paginate(1);
        }
        else {
            $exhibition = Exhibition::orderBy('id', 'asc')->paginate(20);
        }

        return View::make('ims.events.index', ['events' => $exhibition, 'direction' => $direction, 'sortBy' => $sortBy ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('ims.events.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validator = Validator::make(Input::all(), Exhibition::$rules);

        //process the login
        if ($validator->fails())
        {
            $input = Input::except('picture');

            return Redirect::back()->withErrors($validator->messages())->withInput($input);

        } else
        {
            //store

            $exhibition = new Exhibition;
            $exhibition->title = Input::get('title');

            //not great code here. Seriously needs to be changed as hard-coding a value if no date is inputted !
            if (!Input::has('date'))
            {
                $exhibition->date_event = "2015-01-01 00:00:00";
            }
            else {
                $exhibition->date_event = Input::get('date');
            }

            $exhibition->about = Input::get('about');

            if (Input::hasFile('picture'))
            {
                $file = Input::file('picture');
                $name = time() . '-' . $file->getClientOriginalName();

                $file = $file->move(public_path() . '/upload', $name);

                $exhibition->picture = $name;
            }
            $exhibition->save();

            //redirect
            Session::flash('message', 'Successfully created the Event!');
            return Redirect::to('ims/events');
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
//    public function show($id)
//    {
//        //get the artist
//        $exhibition = Exhibition::find($id);
//
//        //show the view and pass the artist to it
//        return View::make('ims.events.show')->with('event', $exhibition);
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //get the artist
        $exhibition = Exhibition::find($id);

        //show the edit form and pass the artist
        return View::make('ims.events.edit')->with('exhibition', $exhibition);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {

        $validator = Validator::make(Input::all(), Exhibition::$rules);

        //process the artist update
        if ($validator->fails())
        {
            $input = Input::except('picture');

            return Redirect::to('ims/events/' . $id . '/edit')->withErrors($validator)->withInput($input);

        } else
        {
            //store
            $exhibition = Exhibition::find($id);
            $exhibition->title = Input::get('title');

            if (Input::has('date')) {
            $exhibition->date_event = Input::get('date');
            }

            $exhibition->about = Input::get('about');

            if (Input::hasFile('picture'))
            {
                $file = Input::file('picture');
                $name = time() . '-' . $file->getClientOriginalName();
                $file = $file->move(public_path() . '/upload', $name);
                $exhibition->picture = $name;
            }
            $exhibition->save();

            //redirect
            Session::flash('message', 'Successfully updated the Event!');
            return Redirect::to('ims/events');
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
        $exhibition = Exhibition::find($id);
        $exhibition->delete();

        //redirect
        Session::flash('message', 'Successfully deleted the Event!');

        return Redirect::to('ims/events');
    }


}