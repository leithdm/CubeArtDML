<?php
/**
 * Created by: darrenleith
 * Date: 09/04/15
 */

function link_me_to($url, $body) {

//  return "<a href='http://:/dogs/1'>Show Dog</a>"; //here we have slimed it

  $url = url($url);
  return "<a href='{$url}'>{$body}</a>";
}