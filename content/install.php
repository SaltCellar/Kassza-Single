<?php
    if(!isMember()) location('c=login');
    //if(isMember()) location('c=menu');
    setTitle('Install');
?>

<?php
    
    print getDateStamp();
    print "<br>";
    print time();
    
?>
