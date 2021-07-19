<?php require __DIR__ . '/../src/System/Bootstrap.php';
/* ----------------------------------------------------------------------------
 * MAIN ENTRY POINT / FRONT CONTROLLER
 * ----------------------------------------------------------------------------
 * This is the main entry point for the application. Think of this as the
 * standard front controller for the application. It calls upon the app's
 * bootstrap process and gets the main framework fired up.
 *
 * There is no need to add or modify code within this file. One thing you
 * could add at your discretion are framework-wide constants that you can
 * later call them within the entire applications codebase.
 *
 * However I'd recommend using the included app/System/Constants.php file
 * to accomplish this. This helps to contain all of your constants inside
 * a single file that loads very early on in the bootstrap process.
 * ----------------------------------------------------------------------------
 * @author  Jason Napolitano
 * @version 1.0.0
 * @since   1.0.0
 * @license MIT https://mit-license.org/
 * ----------------------------------------------------------------------------
 */ Bootstrap::run();
