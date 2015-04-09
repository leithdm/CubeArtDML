<?php

/**
 * Created by: darrenleith
 * Date: 09/02/15
 */
class Exhibition extends Eloquent {

//    protected $fillable = ['first_name', 'second_name', 'address',
//        'country', 'about', 'email', 'facebook',
//        'twitter', 'pinterest', 'google', 'picture'];

    public static $rules = array(
        'title'       => 'required',
//        'date_event'  => 'required|date_format:"Y/m/d H:i"',
        'description' => 'required',
        'picture'     => 'image'
    );

//    public function arts()
//    {
//        return $this->hasMany('Art');
//    }

}