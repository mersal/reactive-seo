<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
	'seo_form' => array(
		array(
		       'field' => 'url',
		       'label' => 'url',
		       'rules' => 'prep_url|trim|required|xss_clean'
		    ),
		array(
		       'field' => 'timeframe',
		       'label' => 'timeframe',
		       'rules' => 'trim|required|xss_clean'
		    )
	)
			
);
