<?php
    if(!isMember()) location('c=login');
    //if(isMember()) location('c=menu');
    setTitle('Fill random data');
?>

<?php

    // TEST:

    require('base/dbm.php');

    $_SESSION['THE_KP'] = 400000;

    //fill_year(2019);


    // FUNCTIONS:

    function fill_year($y) {
        for ($m = 1; $m < 13; $m++) {
            $dc = date('t',mktime(0, 0, 0, $m, 1, $y));
            for ($d = 1; $d < $dc+1; $d++) {
                fill_day(makeDate($y,$m,$d));
            }
        }
    }

    function fill_day($time) {

        $OPTIONS = [
            'bv_osz'    => randomEzres(25,80),
            'ny_db'     => rand(6,15),
            'bv_bank'   => randomEzres(5,20),
            'ki_osz'    => randomKifiz(),
            'ki_db'     => 0,
            'bv_a'      => 0,
            'bv_b'      => 0,
            'bv_c'      => 0,
            'bv_d'      => 0,
            'bv_e'      => 0,
        ];

        $OPTIONS['time'] = $time;

        $OPTIONS['ki_db'] = getKiDB($OPTIONS['ki_osz']);

        $res = parseBV_bc($OPTIONS['bv_osz']);
        $OPTIONS['bv_b'] = $res['bv_b'];
        $OPTIONS['bv_c'] = $res['bv_c'];

        $_SESSION['THE_KP'] += $OPTIONS['bv_osz'] - $OPTIONS['bv_bank'];
        $_SESSION['THE_KP'] -= $OPTIONS['ki_osz'];
        $OPTIONS['kp'] = $_SESSION['THE_KP'];

        // ADD TO DB

        $res = dbm_addNap($OPTIONS);

    }

    function randomEzres($min,$max) {
        return rand($min*1000,$max*1000);
    }

    function randomKifiz() {
        if(rand(0,5) > 3) {
            return randomEzres(0,40);
        } else {
            return 0;
        }
    }

    function getKiDB($ki_osz) {
        if($ki_osz > 0) {
            return rand(1,4);
        } else {
            return 0;
        }
    }

    function parseBV_bc($bv_osz) {
        
        $bv_b = 0;
        $bv_c = 0;
        
        $e = intval(($bv_osz / 100) * rand(10,40));

        return [
            'bv_b' => $e,
            'bv_c' => $bv_osz - $e
        ];
    }

?>