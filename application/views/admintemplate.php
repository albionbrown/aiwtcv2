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
        <script type="text/javascript" src="http://oss.maxcdn.com/libs/modernizr/2.6.2/modernizr.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <div id="header_menu">
            test
        </div>
        <div id="menu">
            <nav>
                <h2><i class="fa fa-reorder"></i>username</h2>
                <ul>
                    <a href="http://www.google.co.uk"><li class="fa fa-laptop">
                        Home
                    </li></a>
                    <a href="http://www.google.co.uk"><li class="fa fa-laptop">
                        My Wishlist
                    </li></a>
                    <a href="http://www.google.co.uk"><li class="fa fa-laptop">
                        Groups
                    </li></a>
                    <a href="http://www.google.co.uk"><li class="fa fa-laptop">
                        Shopping List
                    </li></a>
                    <a href="http://www.google.co.uk"><li class="fa fa-laptop">
                        Gift ideas
                    </li></a>
                    <a href="http://www.google.co.uk"><li class="fa fa-laptop">
                        Help
                    </li></a>
                    <a href="http://www.google.co.uk"><li class="fa fa-laptop">
                        Profile
                    </li></a>
                    <a href="http://www.google.co.uk"><li class="fa fa-laptop">
                        Log Out
                    </li></a>
                </ul>
            </nav>
        </div>
        <div id="pushobj">
            
            <?php 

                echo @$main_content;

            ?>

        </div>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="/js/jquery.multilevelpushmenu.min.js"></script>
        <script type="text/javascript" src="/js/responsive.js"></script>

        <!-- Google Analytics -->
        <script type="text/javascript">

          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-45795667-3']);
          _gaq.push(['_setDomainName', 'make.rs']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();

        </script>
    </body>
</html>
