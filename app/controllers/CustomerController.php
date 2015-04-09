<?php

class CustomerController extends \BaseController {

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
            $customers = Customer::orderBy($sortBy, $direction)->paginate(20);
        }
        elseif (($query) && ($criteria  == 'first_name'))
        {
            $customers = Customer::where('first_name', 'LIKE', "%$query%")->paginate(20);
        }
        elseif (($query) && ($criteria  == 'second_name'))
        {
            $customers = Customer::where('second_name', 'LIKE', "%$query%")->paginate(20);
        }
        elseif (($query) && ($criteria  == 'city'))
        {
            $customers = Customer::where('city', 'LIKE', "%$query%")->paginate(20);
        }
        elseif (($query) && ($criteria  == 'country'))
        {
            $customers = Customer::where('country', 'LIKE', "%$query%")->paginate(20);
        }
        elseif (($query) && ($criteria  == 'customer#'))
        {
            $customers = Customer::where('id', "$query")->paginate(1);
        }
        else {
            $customers = Customer::orderBy('id', 'asc')->paginate(20);
        }

        return View::make('ims.customers.index', ['customers' => $customers, 'direction' => $direction, 'sortBy' => $sortBy ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //load the create form (app/views/ims/create.blade.php
        return View::make('ims.customers.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validator = Validator::make(Input::all(), Customer::$rules);

        //process the login
        if ($validator->fails())
        {
            $input = Input::all();
            return Redirect::back()->withErrors($validator->messages())->withInput($input);

        } else
        {
            //store

            $customer = new Customer;
            $customer->title = Input::get('title');
            $customer->first_name = Input::get('first_name');
            $customer->middle_name = Input::get('middle_name');
            $customer->second_name = Input::get('second_name');
            $customer->address1 = Input::get('address1');
            $customer->address2 = Input::get('address2');
            $customer->address3 = Input::get('address3');
            $customer->city = Input::get('city');
            $customer->phone1 = Input::get('phone1');
            $customer->phone2 = Input::get('phone2');
            $customer->country = Input::get('country');
            $customer->email = Input::get('email');

            $customer->save();

            //redirect
            Session::flash('message', 'Successfully created the Customer!');

            return Redirect::to('ims/customers');
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
//        $customer = Customer::find($id);
//
//        //show the view and pass the artist to it
//        return View::make('ims.customers.show')->with('customer', $customer);
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
        $customer = Customer::find($id);

        //show the edit form and pass the artist
        return View::make('ims.customers.edit')->with('customer', $customer);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {

        $validator = Validator::make(Input::all(), Customer::$rules);

        //process the artist update
        if ($validator->fails())
        {
            $input = Input::all();

            return Redirect::to('ims/customers/' . $id . '/edit')->withErrors($validator)->withInput($input);

        } else
        {
            //update
            $customer = Customer::find($id);

            $customer->title = Input::get('title');
            $customer->first_name = Input::get('first_name');
            $customer->middle_name = Input::get('middle_name');
            $customer->second_name = Input::get('second_name');
            $customer->address1 = Input::get('address1');
            $customer->address2 = Input::get('address2');
            $customer->address3 = Input::get('address3');
            $customer->city = Input::get('city');
            $customer->country = Input::get('country');
            $customer->phone1 = Input::get('phone1');
            $customer->phone2 = Input::get('phone2');
            $customer->email = Input::get('email');

            $customer->save();

            //redirect
            Session::flash('message', 'Successfully updated the Customer!');
            return Redirect::to('ims/customers');
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
        $customer = Customer::find($id);
        $customer->delete();

        //redirect
        Session::flash('message', 'Successfully deleted the Customer!');

        return Redirect::to('ims/customers');
    }


}
