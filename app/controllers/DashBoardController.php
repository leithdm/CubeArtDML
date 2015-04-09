<?php

class DashBoardController extends \BaseController {

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

		return View::make('ims.dashboard.index');
	}


}
