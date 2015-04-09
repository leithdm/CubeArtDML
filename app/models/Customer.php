<?php

/**
 * Created by: darrenleith
 * Date: 09/02/15
 */
class Customer extends Eloquent {

//    protected $fillable = ['first_name', 'second_name', 'address',
//        'country', 'about', 'email', 'facebook',
//        'twitter', 'pinterest', 'google', 'picture'];

    public static $rules = array(
        'title'       => 'required',
        'first_name'  => 'required',
        'second_name' => 'required',
        'address1'    => 'required',
        'address2'    => 'required',
        'address3'    => 'required',
        'city'        => 'required',
        'country'     => 'required',
        'email'       => 'required|email',
    );

    public function orders()
{
    return $this->hasMany('Order');
}

}