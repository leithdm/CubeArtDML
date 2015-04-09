<?php

class EmployeeController extends \BaseController {


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

        if ($sortBy && $direction)
        {
            $employees = Employee::orderBy($sortBy, $direction)->paginate(20);
        } elseif (($query) && ($criteria == 'first_name'))
        {
            $employees = Employee::where('first_name', 'LIKE', "%$query%")->paginate(20);
        } elseif (($query) && ($criteria == 'second_name'))
        {
            $employees = Employee::where('second_name', 'LIKE', "%$query%")->paginate(20);
        } elseif (($query) && ($criteria == 'city'))
        {
            $employees = Employee::where('city', 'LIKE', "%$query%")->paginate(20);
        } elseif (($query) && ($criteria == 'country'))
        {
            $employees = Employee::where('country', 'LIKE', "%$query%")->paginate(20);
        } elseif (($query) && ($criteria == 'employee#'))
        {
            $employees = Employee::where('id', "$query")->paginate(1);
        } else
        {
            $employees = Employee::orderBy('id', 'asc')->paginate(20);
        }

        return View::make('ims.employees.index', ['employees' => $employees, 'direction' => $direction, 'sortBy' => $sortBy]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //load the create form (app/views/ims/create.blade.php
        return View::make('ims.employees.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validator = Validator::make(Input::all(), Employee::$rules);

        //process the login
        if ($validator->fails())
        {
            $input = Input::except('picture');

            return Redirect::back()->withErrors($validator->messages())->withInput($input);

        } else
        {
            //store

            $employee = new Employee;
            $employee->title = Input::get('title');
            $employee->first_name = Input::get('first_name');
            $employee->middle_name = Input::get('middle_name');
            $employee->second_name = Input::get('second_name');
            $employee->address1 = Input::get('address1');
            $employee->address2 = Input::get('address2');
            $employee->address3 = Input::get('address3');
            $employee->city = Input::get('city');
            $employee->country = Input::get('country');
            $employee->email = Input::get('email');
            $employee->phone1 = Input::get('phone1');
            $employee->phone2 = Input::get('phone2');

            if (Input::hasFile('picture'))
            {
                $file = Input::file('picture');
                $name = time() . '-' . $file->getClientOriginalName();

                $file = $file->move(public_path() . '/upload', $name);

                $employee->picture = $name;
            }
            $employee->save();

            //redirect
            Session::flash('message', 'Successfully created the Employee!');

            return Redirect::to('ims/employees');
        }

    }


//    /**
//     * Display the specified resource.
//     *
//     * @param  int $id
//     * @return Response
//     */
//    public function show($id)
//    {
//        //get the artist
//        $artist = Artist::find($id);
//
//        //show the view and pass the artist to it
//        return View::make('ims.artists.show')->with('artist', $artist);
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
        $employee = Employee::find($id);

        //show the edit form and pass the artist
        return View::make('ims.employees.edit')->with('employee', $employee);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {

        $validator = Validator::make(Input::all(), Employee::$rules);

        //process the artist update
        if ($validator->fails())
        {
            $input = Input::except('picture');

            return Redirect::to('ims/employees/' . $id . '/edit')->withErrors($validator)->withInput($input);

        } else
        {
            //store
            $employee = Employee::find($id);

            $employee->title = Input::get('title');
            $employee->first_name = Input::get('first_name');
            $employee->middle_name = Input::get('middle_name');
            $employee->second_name = Input::get('second_name');
            $employee->address1 = Input::get('address1');
            $employee->address2 = Input::get('address2');
            $employee->address3 = Input::get('address3');
            $employee->city = Input::get('city');
            $employee->country = Input::get('country');
            $employee->email = Input::get('email');
            $employee->phone1 = Input::get('phone1');
            $employee->phone2 = Input::get('phone2');

            if (Input::hasFile('picture'))
            {
                $file = Input::file('picture');
                $name = time() . '-' . $file->getClientOriginalName();
                $file = $file->move(public_path() . '/upload', $name);
                $employee->picture = $name;
            }
            $employee->save();

            //redirect
            Session::flash('message', 'Successfully updated the Employee!');

            return Redirect::to('ims/employees');
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
        $employee = Employee::find($id);
        $employee->delete();

        //redirect
        Session::flash('message', 'Successfully deleted the Employee!');

        return Redirect::to('ims/employees');
    }


}