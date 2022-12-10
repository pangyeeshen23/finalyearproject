<?php

namespace App\Helper;

use DateTime;

class Helpers{

    public function calculateAgeFromBirthday($birtday){
        $bday = new DateTime($birtday);
        $today = new DateTime(date('m.d.y'));

        $diff = $today->diff($bday);

        return $diff->y;
    }
} 

?>