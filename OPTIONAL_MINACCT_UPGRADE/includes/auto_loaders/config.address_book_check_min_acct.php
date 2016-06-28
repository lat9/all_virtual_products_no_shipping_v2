<?php
//-----
// Copyright 2015 Vinos de Frutas Tropicales (lat9): Minimum Customer Account Information
//
  $autoLoadConfig[90][] = array('autoType'=>'class',
                                'loadFile'=>'observers/class.address_book_check_min_acct.php');
  $autoLoadConfig[90][] = array('autoType'=>'classInstantiate',
                                'className'=>'min_account_address_book_check',
                                'objectName'=>'min_account_address_book_check');