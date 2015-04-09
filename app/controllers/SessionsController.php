<?php

class SessionsController extends \BaseController {

    /**
     *  only guests can see this form
     */
    public function __construct()
    {
//        $this->beforeFilter('guest');

    }

    /**
     * Show a log in form for the IMS system
     * @return Response
     */
    public function create()
    {
        return View::make('sessions.create');
    }


    /**
     * Check credentials, and log the user into the IMS/CMS portal
     * @return Response
     */
    public function store()
    {
        /**
         *  Perform Validation
         */
        $validator = Validator::make(Input::all(), User::$rules);

        $input = Input::all();

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator->messages())->withInput($input);

        } else {
            /**
             *  Laravel offers a really helpful class here called Auth::attempt.
             * If the credentials match the user will be logged in
             */
            $attempt = Auth::attempt([
                'username' => $input['username'],
                'password' => $input['password']
            ]);

            if ($attempt)
            {
                Flash::overlay('You are now logged in', 'Welcome Back!');
                return Redirect::route('ims.dashboard.index');
            }

            return Redirect::back()->with('flash_message', 'Invalid credentials')->withInput();
        }
	}


    /**
     * Log the user out of the session
     * @return Response
     */
    public function destroy()
    {
        //again, another nice helper method here provided by Laravel
        Auth::logout();
        Flash::overlay('You are now logged out', 'See you next time!');
        return Redirect::home();
    }

}