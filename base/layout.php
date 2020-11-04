<?php
    function getFormTitle() {
        return '<h3 class="text-center" style="margin-bottom: 20px;">Kassza <small>v2 (Single)</small></h3>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <!-- Font Awsome CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="main.css">

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

    <title>/</title>
</head>
<body>
    
    <?php

        if(!isset($_GET['c']) || !file_exists('content/'.$_GET['c'].'.php')) {
            $_GET['c'] = $_SESSION['DEFAULT_CONTENT'];
        }
        
        if(!isMember() && !$_GET['c'] != $_SESSION['DEFAULT_CONTENT']) {
            $_GET['c'] = $_SESSION['DEFAULT_CONTENT']; 
        }
    
    ?>

    <div class="container">
    <?php
        require('content/'.$_GET['c'].'.php');
    ?>
    </div>

</body>
</html>
<script>

    $(()=>{
        
        //Apply title
        document.title = 'Kassza - '+'<?=$_SESSION['TITLE']?>';

    });

    function bootstrapAlert(_parent,_type,_content) {
        _parent.html('');
        _parent.append('<div class="alert alert-'+_type+' alert-dismissible fade show" role="alert">'+_content+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }

    function executeAjax(_callback,_endpoint,_data = {}) {

        $.ajax({
            url: '?a=',
            type: 'POST',
            data: function(){
                let data = new FormData();
                data.append('_csrf', '<?= getCSRF() ?>');
                data.append('endpoint', _endpoint);
                data.append('data',JSON.stringify(_data));
                return data;
            }(),
            success: function (data) {
                _callback(JSON.parse(data));
            },
            error: function (data) {
                _callback({
                    status  : false,
                    error   : data
                });
            },
            cache: false,
            contentType: false,
            processData: false
        });

    }

</script>
<?php
    if(file_exists('content/'.$_GET['c'].'.js')) {
        echo('<script src="content/'.$_GET['c'].'.js"></script>');
    }
?>