<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <link href="css/style.css" rel="stylesheet" type="text/css">
                <link href="css/menu.css" rel="stylesheet" type="text/css">
                    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
                    <script type="text/javascript" src="javascript/ddaccordion.js"></script>
                    <script type="text/javascript">
                        ddaccordion.init({
                            headerclass: "expandable", //Shared CSS class name of headers group that are expandable
                            contentclass: "categoryitems", //Shared CSS class name of contents group
                            revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
                            mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
                            collapseprev: true, //Collapse previous content (so only one open at any time)? true/false
                            defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content
                            onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
                            animatedefault: true, //Should contents open by default be animated into view?
                            persiststate: true, //persist state of opened contents within browser session?
                            toggleclass: ["", "openheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
                            togglehtml: ["prefix", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
                            animatespeed: "slow", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
                            oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
                                //do nothing
                            },
                            onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
                                //do nothing
                            }
                    })</script>

                    <title>Electronic Books</title>
                    </head>
                    <body>
						<div class="container">
							
							<div class="topnav">
								<a href="../index.php">Home</a>
								<a href="php/home.inc.php">List All Books (sorted by authors last name)</a>
								<a href="search/searchForm.inc.php">Search Database by Author, ISBN, or Title</a>
								<a href="change_password.php">Change Password</a>
								<a href="mailto:webmaster@kennys-spot.org">Contact Me</a>
							</div>
							
						<div>
							<aside>
								<table class="rightside">
									<script src="http://www.gmodules.com/ig/ifr?url=http://www.caribsso.com/City/xml/charleston-sc.xml&amp;synd=open&amp;w=160&amp;h=250&amp;title=Charleston%2C+SC+News&amp;border=%23ffffff%7C0px%2C1px+solid+%23998899%7C0px%2C1px+solid+%23aa99aa%7C0px%2C2px+solid+%23bbaabb%7C0px%2C2px+solid+%23ccbbcc&amp;output=js"></script>
								</table>
							</aside>
						</div>
                        <script type="text/javascript">
                            // var name = prompt("Please enter your first name.");
                            // alert("Welcome to the electronic book database, " + name + ". The menu system throughout these web pages will help you find the book you are looking for! Use it wisely and Happy Reading!!" );
                        </script>
							<div>                        
							<table>
								<?php
								$pages_dir = 'C:/server/www/PHP/EBooks/php';

								if ( ! empty ( $_GET[ 'p' ] ) )
								{
									$pages = scandir ( $pages_dir, 0 );
									unset ( $pages[ 0 ], $pages[ 1 ] );

									$p = $_GET[ 'p' ];

									if ( in_array ( $p . '.inc.php', $pages ) )
									{
										include ($pages_dir . '/' . $p . '.inc.php');
									}
									else
									{
										echo 'Sorry, page not found!';
									}
								}
								else
								{
									include('C:/server/www/PHP/EBooks/php/home.inc.php');
								}
								?>
							</table>
						</div>
						<div>
							<aside>
								<a id="weather" href="http://www.wunderground.com/cgi-bin/findweather/getForecast?query=zmw:29440.1.99999&bannertypeclick=wu_blueglass"><img src="http://weathersticker.wunderground.com/cgi-bin/banner/ban/wxBanner?bannertype=wu_blueglass&airportcode=KGGE&ForcedCity=Georgetown&ForcedState=SC" alt="Click for Georgetown, South Carolina Forecast" height="90" width="160"></a>
								&nbsp;
								<a id="face" href="http://www.facebook.com/kenny.coltharp"><img src="images/facebook-1.jpg"></a>
								&nbsp
								<a href="http://www.gamecocksonline.com/"><img src="images/GamecockLogo.jpg"></a>
							</aside>
						</div>
						<footer>
							<p>&copy;, 2012, Kenny Coltharp</p><br>
							<ul id="foot">
								<li><a href="main.php">Home</a> <a href="">TO COME</a> <a href="">TO COME</a> <a href="">TO COME</a> <a href="">TO COME</a><a href="mailto:webmaster@kennys-spot.org">Contact Me</a></li>
							</ul>
						</footer>
		</div>
	</body>
</html>