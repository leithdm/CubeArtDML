<?php

class OrderController extends \BaseController {
    /**
     *  Only accessible if authorized
     */
    public function __construct()
    {
        $this->beforeFilter('auth');
    }

    /**
     * Display the index page
     * @return the index page with all Orders
     */
    public function index()
    {
        //use of 'Eager Loading' of customers to avoid N+1 problem.
        $orders = Order::with('customer')->paginate(10);
        return View::make('ims.orders.index')->with('orders', $orders);
    }

    /**
     * Show the form for creating a new Order
     * @return form for creating a new Order
     */
    public function create()
    {
        $customers = array('' => 'Select an existing Customer') +
            Customer::select(DB::raw('concat (second_name, ", ", first_name, " ", middle_name) as full_name,id'))
                ->orderBy('second_name', 'asc')->lists('full_name', 'id');

        //search query
        $query = Input::get('query');
        $criteria = Input::get('criteria');

        //table sorts and ascending/descending direction
        $sortBy = Request::get('sortBy');
        $direction = (Request::get('direction'));

        if ($sortBy && $direction)
        {
            $arts = Art::orderBy($sortBy, $direction)->paginate(10);
        } elseif (($query) && ($criteria == 'title'))
        {
            $arts = Art::where('title', 'LIKE', "%$query%")->paginate(10);
        } elseif (($query) && ($criteria == 'price'))
        {
            $arts = Art::where('price', 'LIKE', "%$query%")->paginate(10);
        } elseif (($query) && ($criteria == 'category'))
        {
            $arts = Art::where('category', 'LIKE', "%$query%")->paginate(10);
        } elseif (($query) && ($criteria == 'art#'))
        {
            $arts = Art::where('id', "$query")->paginate(1);
        } else
        {
            $arts = Art::with('artist')->paginate(10);
        }
        return View::make('ims.orders.create', ['customers' => $customers, 'arts' => $arts,
                                                'direction' => $direction, 'sortBy' => $sortBy]);
    }

    /**
     * Store a newly created resource in storage.
     * @return Response
     */
    public function store()
    {
        $validator = Validator::make(Input::all(), Order::$rules);
        //process the login
        if ($validator->fails())
        {
            $input = Input::all();
            return Redirect::back()->withErrors($validator->messages())->withInput($input);

        } else
        {
            $order = new Order;
            $order->arts_id = Input::get('artItem');
            $artItem = Art::find(Input::get('artItem'));
            $artItem->status = "Sold";
            $artItem->save();
            $order->customer_id = Input::get('customer');
            $order->sellingPrice = Input::get('sellingPrice');
            $order->save();
        }
        Session::flash('message', 'Successfully added the Order!');
        return Redirect::route('ims.orders.index');
    }
    /**
     * Display the specified resource.
     * GET /arts/{id}
     * @param  int $id
     * @return Response
     */
    public
    function show($id)
    {
        $order = Order::find($id);
        return View::make('ims.orders.show')->with('order', $order);
    }
    /**
     * Show the form for editing the specified resource.
     * GET /arts/{id}/edit
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        $customers = array('' => 'Assign to a new customer...') + Customer::select(DB::raw('concat (second_name, ", ", first_name, " ", middle_name) as full_name,id'))->orderBy('second_name', 'asc')->lists('full_name', 'id');

        //search query
        $query = Input::get('query');
        $criteria = Input::get('criteria');

        //sorting and direction
        $sortBy = Request::get('sortBy');
        $direction = (Request::get('direction'));

        if ($sortBy && $direction)
        {
            $arts = Art::orderBy($sortBy, $direction)->paginate(10);
        } elseif (($query) && ($criteria == 'title'))
        {
            $arts = Art::where('title', 'LIKE', "%$query%")->paginate(10);
        } elseif (($query) && ($criteria == 'price'))
        {
            $arts = Art::where('price', 'LIKE', "%$query%")->paginate(10);
        } elseif (($query) && ($criteria == 'category'))
        {
            $arts = Art::where('category', 'LIKE', "%$query%")->paginate(10);
        } elseif (($query) && ($criteria == 'art#'))
        {
            $arts = Art::where('id', "$query")->paginate(1);
        } else
        {
            $arts = Art::with('artist')->paginate(10);
        }
        return View::make('ims.orders.edit', ['order' => $order, 'customers' => $customers, 'arts' => $arts, 'direction' => $direction, 'sortBy' => $sortBy]);
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
        $validator = Validator::make(Input::all(), Order::$rulesEdit);

        //process the login
        if ($validator->fails())
        {
            $input = Input::all();
            return Redirect::back()->withErrors($validator->messages())->withInput($input);
        } else
        {
            $order = Order::find($id);

            if (Input::get('artItem'))
            {
                $artsId = $order->arts_id;
                $oldArtItem = Art::find($artsId);
                $oldArtItem->status = "Available";
                $oldArtItem->save();
                $order->arts_id = Input::get('artItem');
                $newArtsId = Input::get('artItem');
                $artItem = Art::find($newArtsId);
                $artItem->status = "Sold";
                $artItem->save();
            }

            if (Input::get('customer'))
            {
                $order->customer_id = Input::get('customer');
            }
            $order->sellingPrice = Input::get('sellingPrice');
            $order->save();
            Session::flash('message', 'Successfully updated the Order!');
            return Redirect::route('ims.orders.index');
        }
    }
    /**
     * Remove the specified resource from storage.
     * DELETE /arts/{id}
     * @param  int $id
     * @return Response
     */
    public
    function destroy($id)
    {
        Order::find($id)->delete();
        //redirect
        Session::flash('message', 'Successfully deleted the P.O!');
        return Redirect::route('ims.orders.index');
    }
}