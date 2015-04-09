<?php

class Order extends \Eloquent {

    protected $fillable = ['customer', 'artItem', 'sellingPrice'];

    public static $rules = array(
        'customer'     => 'required|numeric',
        'artItem'      => 'required',
        'sellingPrice' => 'required|numeric'
    );

    public static $rulesEdit = array(
        'sellingPrice' => 'numeric'
    );

    public function customer()
    {
        return $this->belongsTo('Customer');
    }

    public function arts()
    {
        return $this->hasMany('Art');
    }
}