<?php

require_once "vue/vue.class.php";

class card extends bdd
{
    /* Luhn algorithm number checker - (c) 2005-2008 shaman - www.planzero.org *
 * This code has been released into the public domain, however please      *
 * give credit to the original author where possible.                      */

    function luhn_check($number)
    {

        // Strip any non-digits (useful for credit card numbers with spaces and hyphens)
        $number = preg_replace('/\D/', '', $number);

        // Set the string length and parity
        $number_length = strlen($number);
        $parity = $number_length % 2;

        // Loop through each digit and do the maths
        $total = 0;
        for ($i = 0; $i < $number_length; $i++) {
            $digit = $number[$i];
            // Multiply alternate digits by two
            if ($i % 2 == $parity) {
                $digit *= 2;
                // If the sum is two digits, add them together (in effect)
                if ($digit > 9) {
                    $digit -= 9;
                }
            }
            // Total up the digits
            $total += $digit;
        }

        // If the total mod 10 equals 0, the number is valid
        return ($total % 10 == 0) ? TRUE : FALSE;

    }

    public function verifyCardCVC($cardCVC)
    {
        //verify the card cvc
        if (strlen($cardCVC) == 3 or strlen($cardCVC) == 4) {
            return true;
        } else {
            return false;
        }
    }

    public function verifyCardDate($cardDate)
    {
        //var_dump($cardDate);
        if (strlen($cardDate) != 5 and strlen($cardDate) != 7) {
            return false;
        }
        //verify the card date
        $cardDate = explode("/", $cardDate);
        $cardDate = $cardDate[1] . $cardDate[0];
        $cardDate = intval($cardDate);
        $date = date("ym");
        $date = intval($date);
        if ($cardDate > $date) {
            return true;
        } else {
            return false;
        }
    }

    public function verifyCardName($cardName)
    {
        //verify the card name
        if (strlen($cardName) > 0) {
            return true;
        } else {
            return false;
        }
    }

}