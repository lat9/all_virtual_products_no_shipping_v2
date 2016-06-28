<?php
//-----
// Copyright 2015 Vinos de Frutas Tropicales (lat9): Minimum Customer Account Information
//
class min_account_address_book_check extends base {
  function __construct() {
    $this->attach($this, array ('NOTIFY_LOGIN_SUCCESS', 'NOTIFY_HEADER_START_CHECKOUT_SHIPPING'));
    
   }
  
  function update (&$class, $eventID, $p1) {
    global $db, $messageStack;
    switch ($eventID) {
      case 'NOTIFY_LOGIN_SUCCESS': {
        if ($this->check_address_needs_changing ($_SESSION['customer_default_address_id']) != 0) {
          // bof: contents merge notice
          // save current cart contents count if required
          if (SHOW_SHOPPING_CART_COMBINED > 0) {
            $zc_check_basket_before = $_SESSION['cart']->count_contents();
            
          }

          // bof: not require part of contents merge notice
          // restore cart contents
          $_SESSION['cart']->restore_contents();
          // eof: not require part of contents merge notice

          // check current cart contents count if required
          if (SHOW_SHOPPING_CART_COMBINED > 0 && $zc_check_basket_before > 0) {
            $zc_check_basket_after = $_SESSION['cart']->count_contents();
            if ($zc_check_basket_before != $zc_check_basket_after && $_SESSION['cart']->count_contents() > 0) {
              $messageStack->add_session ('addressbook', WARNING_SHOPPING_CART_COMBINED, 'caution');

            }
          }
          // eof: contents merge notice
          
          $messageStack->add_session ('addressbook', WARNING_ADDRESS_BOOK_CHECK_NEEDED, 'caution');
          zen_redirect (zen_href_link (FILENAME_ADDRESS_BOOK_PROCESS, 'edit=' . $_SESSION['customer_default_address_id'], 'SSL'));

        }
        break;
      }
      case 'NOTIFY_HEADER_START_CHECKOUT_SHIPPING': {
        if ($this->check_address_needs_changing ($_SESSION['customer_default_address_id']) != 0) {
          $messageStack->add_session ('addressbook', WARNING_ADDRESS_BOOK_CHECK_NEEDED, 'caution');
          zen_redirect (zen_href_link (FILENAME_ADDRESS_BOOK_PROCESS, 'edit=' . $_SESSION['customer_default_address_id'], 'SSL'));
          
        }
        break;
      }
      default: {
        break;
      }
    }
  }
  
  function check_address_needs_changing ($address_book_id) {
    global $db;
    $address_book_id_to_change = 0;
    $address_book = $db->Execute ("SELECT * FROM " . TABLE_ADDRESS_BOOK . " WHERE address_book_id = " . (int)$address_book_id . " LIMIT 1");
    if (!$address_book->EOF) {
      if ( (ACCOUNT_GENDER == 'true' && !($address_book->fields['entry_gender'] == 'm' || $address_book->fields['entry_gender'] == 'f')) ||
           (ACCOUNT_COMPANY == 'true' && ((int)ENTRY_COMPANY_MIN_LENGTH) > 0 && strlen ($address_book->fields['entry_company']) < ENTRY_COMPANY_MIN_LENGTH) ||
           (strlen ($address_book->fields['entry_street_address']) < ENTRY_STREET_ADDRESS_MIN_LENGTH) ||
           ($address_book->fields['entry_country_id'] < 1)
         ) {
        $address_book_id_to_change = $address_book->fields['address_book_id'];
        break;
      }

      if (ACCOUNT_STATE == 'true') {
        $country = $address_book->fields['entry_country_id'];
        $state = $address_book->fields['entry_state'];
        $zone_id = $address_book->fields['entry_zone_id'];
        $check = $db->Execute ("SELECT count(*) AS total FROM " . TABLE_ZONES . " WHERE zone_country_id = " . $address_book->fields['entry_country_id']);
        if ($check->fields['total'] > 0) {
          $zone_query = "SELECT distinct zone_id, zone_name, zone_code
                         FROM " . TABLE_ZONES . "
                         WHERE zone_country_id = :zoneCountryID
                         AND " .
                         ((trim($state) != '' && $zone_id == 0) ? "(upper(zone_name) like ':zoneState%' OR upper(zone_code) like '%:zoneState%') OR " : "") .
                        "zone_id = :zoneID
                         ORDER BY zone_code ASC, zone_name";

          $zone_query = $db->bindVars($zone_query, ':zoneCountryID', $country, 'integer');
          $zone_query = $db->bindVars($zone_query, ':zoneState', strtoupper($state), 'noquotestring');
          $zone_query = $db->bindVars($zone_query, ':zoneID', $zone_id, 'integer');
          $zone = $db->Execute($zone_query);

          //look for an exact match on zone ISO code
          $found_exact_iso_match = ($zone->RecordCount() == 1);
          if ($zone->RecordCount() > 1) {
            while (!$zone->EOF && !$found_exact_iso_match) {
              if (strtoupper($zone->fields['zone_code']) == strtoupper($state) ) {
                $found_exact_iso_match = true;
                continue;
              }
              $zone->MoveNext();
              
            }
          }

          if (!$found_exact_iso_match) {
            $address_book_id_to_change = $address_book->fields['address_book_id'];
            
          }
        } elseif (strlen ($state) < ENTRY_STATE_MIN_LENGTH) {
          $address_book_id_to_change = $address_book->fields['address_book_id'];
            
        }

      }     
    }
    return $address_book_id_to_change;
    
  }
  
}