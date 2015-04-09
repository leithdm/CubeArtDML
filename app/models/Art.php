<?php

class Art extends \Eloquent {

    protected $fillable = [];

    public static $rules = array(
        'artist'      => 'required|numeric',
        'status'      => 'required',
        'title'       => 'required',
        'subject'     => 'required',
        'category'    => 'required',
        'medium'      => 'required',
        'year'        => 'required',
        'height'      => 'required|numeric',
        'width'       => 'required|numeric',
        'depth'       => 'required|numeric',
        'price'       => 'required|numeric',
        'description' => 'required',
        'picture'     => 'image'
    );

    public static $rulesEdit = array(
        'status'      => 'required',
        'title'       => 'required',
        'subject'     => 'required',
        'category'    => 'required',
        'medium'      => 'required',
        'year'        => 'required',
        'height'      => 'required|digits_between:1,1000',
        'width'       => 'required|digits_between:1,1000',
        'depth'       => 'required|digits_between:1,1000',
        'price'       => 'required|numeric',
        'description' => 'required',
        'picture'     => 'image'
    );


    public function artist()
    {
        return $this->belongsTo('Artist');
    }

    public function gallery()
    {
        return $this->hasMany('Gallery');
    }

    public function carousels()
    {
        return $this->hasMany('Carousel');
    }

    public function orders()
    {
        return $this->belongsTo('Order');
    }
}