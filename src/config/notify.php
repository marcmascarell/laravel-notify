<?php

return array(

	'default' => array(
		'class' => 'alert notify',
		'show_icon' => true
	),

	'success' => array(
		'icon' => '<i class="fa fa-check"></i>',
		'autohide'    => false,
		'dismissable' => true,
		'class' => 'alert-success'
	),

	'info' => array(
		'icon' => '<i class="fa fa-info"></i>',
		'autohide'    => false,
		'dismissable' => true,
		'class' => 'alert-info'
	),

	'warning' => array(
		'icon' => '<i class="fa fa-warning"></i>',
		'autohide'    => false,
		'dismissable' => true,
		'class' => 'alert-warning'
	),

	'danger' => array(
		'icon' => '<i class="fa fa-times-circle-o"></i>',
		'autohide'    => false,
		'dismissable' => true,
		'class' => 'alert-danger'
	),

	'loading' => array(
		'icon' => '<i class="fa fa-circle-o-notch fa-spin"></i>',
		'autohide'    => true,
		'dismissable' => false,
		'class' => 'alert-info'
	),
);