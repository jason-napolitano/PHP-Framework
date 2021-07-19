<?php
// ----------------------------------------------------------------------------
// App configuration - Take note that if you modify the APP_NAMESPACE constant,
// you will have to ensure that all controllers, config files, models, etc have
// been modified to this new value.
const ENVIRONMENT = 'development';
const APP_NAMESPACE = 'App';

// ----------------------------------------------------------------------------
// Writable Directory Constants
const WRITEPATH = APPPATH . 'Writable' . _DS_;

// ----------------------------------------------------------------------------
// App Directory Constants
const VENDORPATH = BASEPATH . '/vendor';
const ENVPATH    = BASEPATH;
const ENVFILE    = '.env';
define('LOGFILE', WRITEPATH . date('d-M-Y') . '.log');
