<?php
/**
 * Author: Roger Creasy
 * Email: Roger.Creasy@gmail.com
 * Date: 2/19/16
 * Time: 5:53 AM
 */


require __DIR__ . '/vendor/autoload.php';

use src\movieTimes;

$listings = new movieTimes(27298);

$listings->printListings();

