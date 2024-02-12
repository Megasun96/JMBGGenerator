<?php

class JMBGGenerator {
    public static function generateJMBG() {
        $randomDate = self::generateRandomDate();
        $randomDigits = mt_rand(100, 999);
        $controlDigit = self::calculateControlDigit($randomDate, $randomDigits);

        return $randomDate . $randomDigits . $controlDigit;
    }

    private static function generateRandomDate() {
        $year = str_pad(mt_rand(40, 99), 2, '0', STR_PAD_LEFT);
        $month = str_pad(mt_rand(1, 12), 2, '0', STR_PAD_LEFT);
        $day = str_pad(mt_rand(1, 28), 2, '0', STR_PAD_LEFT);

        return $year . $month . $day;
    }

    private static function calculateControlDigit($date, $digits) {
        $weights = array(7, 6, 5, 4, 3, 2, 7, 6, 5, 4, 3, 2);
        $checksum = 0;

        $jmbg = $date . $digits;
        for ($i = 0; $i < 13; $i++) {
            $checksum += $jmbg[$i] * $weights[$i];
        }

        $remainder = $checksum % 11;
        if ($remainder === 0) {
            return 0;
        } else {
            return 11 - $remainder;
        }
    }
}

$jmbg = JMBGGenerator::generateJMBG();

echo "Generated JMBG: $jmbg\n";
