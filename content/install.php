<?php
    if(!isMember()) location('c=login');
    //if(isMember()) location('c=menu');
    setTitle('Install');
?>

<?php
    file_put_contents('private/settings.json',json_encode([
        'gyujtes' => [
            'kp_sz'     => false,
            'bv_osz'    => false,
            'ny_db'     => false,
            'bv_bank'   => false,
            'ki_osz'    => false,
            'ki_db'     => false,
            'bv_a'      => false,
            'bv_b'      => false,
            'bv_c'      => false,
            'bv_d'      => false,
            'bv_e'      => false
        ],
        'biztonsag' => [
            'csrf'                  => false,
            'auto_logout'           => false,
            'auto_logout_timeout'   => false
        ]
    ]));
?>
