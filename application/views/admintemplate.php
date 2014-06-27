<?php
    $username = $this->general->getusername();
    $email    = $this->general->getemail();
    $userid = $_SESSION['userid'];
    $encrypteduserid = base64_encode($userid);
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js logged-in"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{title}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">

        <link rel="stylesheet" href="/css/jquery.multilevelpushmenu.css">
        <link rel="stylesheet" href="/css/bootstrap.css">
        <link rel="stylesheet" href="/css/responsive.css">
        <link rel="stylesheet" href="/css/aiwtc.css">
        <link rel="stylesheet" href="/css/fonts/css/font-awesome.css">
        <link rel="icon" type="image/png" href="/images/favicon.png">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="http://oss.maxcdn.com/libs/modernizr/2.6.2/modernizr.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="/js/jquery.multilevelpushmenu.js"></script>
        <script src="/js/responsive.js"></script>
        <script src="/js/countdown.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="page-container">
        <div id="header_bar">
        <div id="logo">
        <a href="/home"><img src="/images/logo.gif" title="All I Want This Christmas" alt="All I Want This Christmas"/></a>
        </div>
            <div id="header_profile" class="">
            <?php echo '<h2><a href="/main/user?uid='.$encrypteduserid.'">'.$username.'</a></h2>'; ?>
            <img src=<?php echo "http://www.gravatar.com/avatar/" . md5($email)?>>
            </div>
            <div id="search_box">
            <?php 
            $attributes = array('class' => 'form clearfix', 'id' => 'search_form');
            echo form_open('/main/search_model', $attributes);
            $input_data = array(
                'name'      => 'searchentry',
                'class'     => 'text-input max-width',
                'placeholder' => 'Search for somebody',
            );
            echo form_input($input_data);
            echo form_close();
            ?>
            </div>

            <div id="countdown">
                <p class="days">00</p>
                <p class="timeRefDays">days</p>
            </div>
        </div>
        <div id="menu">
            <nav>
                <h2 class="clearfix"><i class="fa fa-reorder"></i></h2>
                <ul>
                    <a href="/home"><li>
                        <h2>DASHBOARD<i class="fa fa-tachometer menu-icon"></i></h2>
                    </li></a>
                    <a href="/my_wishlist"><li>
                       <h2> MY WISHLIST<i class="fa fa-gift menu-icon"></i></h2>
                    </li></a>
                    <a href="/groups"><li>
                        <h2>GROUPS<i class="fa fa-users menu-icon"></i></h2>
                    </li></a>
                    <a href="/gifts"><li>
                        <h2>SHOPPING LIST<i class="fa fa-list-ol menu-icon"></i></h2>
                    </li></a>
                    <a href="http://www.google.co.uk"><li>
                        <h2>GIFT IDEAS<i class="fa fa-lightbulb-o menu-icon"></i></h2>
                    </li></a>
                    <a href="http://www.google.co.uk"><li>
                        <h2>HELP<i class="fa fa-question menu-icon"></i></h2>
                    </li></a>
                    <a href="/profile"><li>
                        <h2>PROFILE<i class="fa fa-user menu-icon"></i></h2>
                    </li></a>
                    <a href="/logout"><li>
                        <h2>LOGOUT<i class="fa fa-sign-out menu-icon"></i></h2>
                    </li></a>
                </ul>
            </nav>
        </div>
        <div id="pushobj">
            <div  class="container">
                
                <?php 

                    echo @$main_content;

                ?>
            </div>
        </div>
        </div>
    </body>
</html>
