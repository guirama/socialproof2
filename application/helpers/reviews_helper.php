<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('get_all_reviews'))
{
    function get_all_reviews($client_id)
    {
       // $listing_id = $client_id;
        $reviews1 = $reviews2 = $reviews3 = array();
        // List Reviews 
        $reviews_get_config = array('id' => $client_id);//array('id' => $listing_id);
        //$reviews1 = getCustomReviews($reviews_get_config);
    }
}
