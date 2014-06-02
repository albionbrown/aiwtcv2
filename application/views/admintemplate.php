<?php
    $userid = $_SESSION['userid'];
    $query = $this->db->query("SELECT * FROM users WHERE userid='$userid'");
    foreach($query->result_array() as $row){
        $fname = $row['fname'];
        $sname = $row['sname'];
        $username = ucwords($fname." ".$sname);
    }
    //$this->load->model('general');
    $email = $this->general->getemail();
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{title}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">

        <link rel="stylesheet" href="/css/jquery.multilevelpushmenu.css">
        <link rel="stylesheet" href="/css/responsive.css">
        <link rel="stylesheet" href="/css/aiwtc.css">
        <link rel="icon" type="image/png" href="/images/favicon.png">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="http://oss.maxcdn.com/libs/modernizr/2.6.2/modernizr.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="/js/jquery.multilevelpushmenu.min.js"></script>
        <script src="/js/responsive.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="page-contrainer">
        <div id="header_bar">
            <div id="header_profile">
            <?php echo "<h2>".$username."</h2>"; ?>
            <img src=<?php echo "http://www.gravatar.com/avatar/" . md5(trim($email))?>>
            </div>
        </div>
        <div id="menu">
            <nav>
                <i class="fa fa-reorder"></i>
                <ul>
                    <a href="/home"><li class="fa fa-laptop">
                        Home
                    </li></a>
                    <a href="/my_wishlist"><li class="fa fa-laptop">
                        <img src="/images/my_wishlist.png" height="100%" width="100%">
                    </li></a>
                    <a href="/groups"><li class="fa fa-laptop">
                        Groups
                    </li></a>
                    <a href="/gifts"><li class="fa fa-laptop">
                        <img src="/images/shopping_list.png" height="100%" width="100%">
                    </li></a>
                    <a href="http://www.google.co.uk"><li class="fa fa-laptop">
                        Gift ideas
                    </li></a>
                    <a href="http://www.google.co.uk"><li class="fa fa-laptop">
                        <img src="/images/help.png" height="100%" width="100%">
                    </li></a>
                    <a href="/profile"><li class="fa fa-laptop">
                        <img src="/images/profile.png" height="100%" width="100%">
                    </li></a>
                    <a href="/logout"><li class="fa fa-laptop">
                        <img src="/images/logout.png" height="100%" width="100%">
                    </li></a>
                </ul>
            </nav>
        </div>
        <div id="pushobj">
            
            <?php 

                echo @$main_content;

            ?>

        </div>
        </div>
    </body>
</html>
