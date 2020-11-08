<?php
    if(!isMember()) location('c=login');
    //if(isMember()) location('c=menu');
    setTitle('Install');
?>

<?php
    
    require('base/dbm.php');
    print(date('Y',time()));
    
?>
