<?php
// ----------------------------------------------------------------------------
// App configuration
const ENVIRONMENT = 'development';
const APP_NAMESPACE = 'App';

// ----------------------------------------------------------------------------
// Writable Directory Constants
const WRITEPATH = COREPATH . 'Writable' . _DS_;

// ----------------------------------------------------------------------------
// App Directory Constants
const VENDORPATH = BASEPATH . '/vendor';
const ENVPATH = BASEPATH;
const ENVFILE = '.env';
define('LOGFILE', WRITEPATH . date('d-M-Y') . '.log');
