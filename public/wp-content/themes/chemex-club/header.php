<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1">
        <title><?php wp_title(); ?> </title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <link href="https://fonts.googleapis.com/css?family=EB+Garamond|Roboto" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
        <script type="text/javascript">
            var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
        </script>
        <?php 
            do_action('wp_head');
        ?>
    </head>
    <body>
        <input type="hidden" id="ajax_url" value="<?php echo admin_url('admin-ajax.php'); ?>">
        <div class="container" id="navbar-main">
            <div class="row">
                <div class="col-xs-12 company-logo">
                    <p>The <span class="darker">Chemex</span> <span class="lighter">club</span></p>
                    </a>
                </div>
            </div>
        </div>