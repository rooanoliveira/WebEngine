<?php
/**
 * CabalEngine
 * http://muengine.net/
 * 
 * @version 1.0.9
 * @Mod author Rooan Oliveira / Original author Lautaro Angelico <http://lautaroangelico.com/>
 * @copyright (c) 2013-2017 Lautaro Angelico, All Rights Reserved
 * 
 * Licensed under the MIT license
 * http://opensource.org/licenses/MIT
 */

if(!isLoggedIn()) { redirect(); }

// Sign Out Process
logOutUser();

// Redirect to home
redirect();