<?php

class Art extends \Eloquent {

  protected $fillable = [
    'artist', 'status', 'title', 'subject', 'category', 'medium', 'year',
    'height', 'width', 'depth', 'price', 'details', 'picture'
  ];
  public static $rules = array(
      'artist'   => 'required|numeric',
      'status'   => 'required',
      'title'    => 'required',
      'subject'  => 'required',
      'category' => 'required',
      'medium'   => 'required',
      'year'     => 'required',
      'height'   => 'required|numeric',
      'width'    => 'required|numeric',
      'depth'    => 'required|numeric',
      'price'    => 'required|numeric',
      'details'  => 'required',
      'picture'  => 'image'
  );

  public static $rulesEdit = array(
      'status'   => 'required',
      'title'    => 'required',
      'subject'  => 'required',
      'category' => 'required',
      'medium'   => 'required',
      'year'     => 'required',
      'height'   => 'required|numeric',
      'width'    => 'required|numeric',
      'depth'    => 'required|numeric',
      'price'    => 'required|numeric',
      'details'  => 'required',
      'picture'  => 'image'
  );

  public function artist() {
    return $this->belongsTo('Artist');
  }

  public function gallery() {
    return $this->hasMany('Gallery');
  }

  public function carousels() {
    return $this->hasMany('Carousel');
  }

  public function orders() {
    return $this->belongsTo('Order');
  }

}