<?php

class Gallery extends \Eloquent {
	protected $fillable = [];

	public static $rules = array(
		'position'  => 'required|numeric',
//		'subject' => 'required',
//		'medium'     => 'required',
//		'category'     => 'required',
//		'price'       => 'required|numeric',
//		'description'    => 'required',
//		'picture'     => 'image',
		'arts_id'  => 'required|numeric'
	);

//	public function arts()
//	{
//		return $this->belongsToMany('Art', 'gallery_arts', 'gallery_id', 'arts_id');
//	}

	public function arts()
	{
		return $this->belongsTo('Art');
	}
}