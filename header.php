<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" itemscope="itemscope" itemtype="http://schema.org/Organization" dir="ltr" lang="en-US" class="no-js">

  <head>

    <title>

      <?php 

        if (is_front_page() || is_404()) { 

          echo get_bloginfo('title'); 

        } else { 

          echo get_bloginfo('title')." - ".get_the_title(); 

        } 

      ?>

    </title>

    <meta charset="<?php bloginfo('charset'); ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no"/>

    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>

    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"/>

    <meta http-equiv="cache-Control" content="no-cache, no-store, must-revalidate"/>

    <meta http-equiv="expires" content="0"/>

    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT"/>

    <meta http-equiv="pragma" content="no-cache"/>

    <meta http-equiv="apple-mobile-web-app-capable" content="yes"/>

    <meta http-equiv="HandheldFriendly" content="true"/>

    <meta name="audience" content="all"/>

    <meta name="keywords" content=" "/>

    <meta name="author" content="Wesley Andrade"/>

    <meta name="resource-type" content="Document"/>

    <meta name="distribution" content="Global"/>

    <meta name="robots" content="index, follow, ALL"/>

    <meta name="GOOGLEBOT" content="index, follow"/>

    <meta name="rating" content="General"/>

    <meta name="revisit-after" content="2 Days"/>

    <meta name="language" content="pt-br"/>

    <?php wp_meta(); ?>

    <meta name="HandheldFriendly" content="true"/>

    <link rel="canonical" href="<?php echo site_url(); ?>" />

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css" media="all"/>

    <link rel="stylesheet" href="<?php echo get_template_directory_uri().'/css/default.css?v='.rand(5, 15); ?>" type="text/css" media="all" />

    <link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_url')."?v=".rand(5, 15); ?>"> 

    <link rel="apple-touch-icon" sizes="57x57" href="favicon-57.png"/>

    <script href="<?php echo get_template_directory_uri(); ?>/js/modernizr.js" type="text/javascript" media="all"></script>

    <script href="<?php echo get_template_directory_uri(); ?>/js/selectivizr.js" type="text/javascript" media="all"></script>

    <script href="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js" type="text/javascript" media="all"></script>

    <script href="<?php echo get_template_directory_uri(); ?>/js/html5shiv-printshiv.js" type="text/javascript" media="all"></script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>

    <script type="text/javascript">

      $(document).ready(function(){ 

        function removeLightbox() { 

          $("#lightbox").remove();

          $("body").css("overflow","initial");

        }

        function mobile(){

          if ($(window).width() <= 1024) {

            //- $("section.full").addClass("hide");

            $( "section.full .flex50" ).each(function() {

              if($(this).html()==""||$(this).text()==""){

                $(this).hide();

              }

            }); 

          } else {

            $( "section.full .flex50" ).each(function() {

              if($(this).html()==""||$(this).text()==""){

                $(this).show().css("display","flex");

              }

            }); 

          }       

        }

        $( ".lightbox" ).click(function() {

          $("body").css("overflow","hidden").hide().append("<div id='lightbox' class='flex'><div><div><a href='javascript:void(0)' rel='close'><i class='material-icons'>&#xE14C;</i></a> <img src='"+$(this).find("img").attr("src")+"'/></div></div></div>").fadeIn();

        });

        $( "#lightbox [rel='close']" ).click(function() {

            removeLightbox();         

        });

        $(document).mouseup(function (e){

          var container = $("img");

          if (!container.is(e.target) 

          && container.has(e.target).length === 0)

          {

            removeLightbox();           

          }

        });

        $( ".accordion strong" ).click(function() {

          $(this).closest('li').toggleClass("open");

          if(!$(this).closest('li').is('.open')){

            $(this).find('i').html('&#xE145');

          } else {

            $(this).find('i').html('-');

          }

        });

        $( "[role='menu']" ).click(function() {

          if ($(window).width() <= 1024) {

            $("#mobileNav").toggleClass("on");

            if(!$("#mobileNav").is(".on")){

              $(this).find("i").html("&#xE3C7;");

            } else {

              $(this).find("i").html("&#xE15B;");

            }

          }

        }); 

        mobile();

        $(window).resize(function(){

          removeLightbox();

          mobile();

          // 

          $(".open").removeClass("open");

          $(".on").removeClass("on");

          if(!$("#mobileNav").is(".on")){

            $("[role='menu']").find("i").html("&#xE3C7;");

          } else {

            $("[role='menu']").find("i").html("&#xE15B;");

          }

        });       

      });

    </script>

    <?php wp_head(); ?>

  </head>

  <body onload="initialize()" 

  <?php

  global $post;

  if (is_front_page()) {

    echo 'class="pg-home"';

  } else if(is_archive()){

    echo 'class="pg-archive pg-interna"';

  } else if(is_category()){

    echo 'class="pg-category pg-interna"';

  } else if(is_search()){

    echo 'class="pg-search pg-interna"';

  } else if(is_single()){

    echo 'class="pg-single pg-interna"';

  } else {

    echo 'class="pg-interna page_id_'.$post->ID.'"';

  }

  ?>>

    <div id="wrap">

      <header>

        <div id="mobileNav">

          <nav>

            <ul>

              <?php wp_nav_menu( array( 'container' => false, 'menu' => 'header','walker' => new description_walker(),'items_wrap' => '%3$s' ) ); ?>

            </ul>

          </nav>

        </div>

        <div class="wrap flex">

          <div class="flex20">

            <a href="index.php" title="SherpaBase" rel="home"><!-- --></a>

          </div>

          <div class="flex80">

            <nav>

              <ul>

                <?php wp_nav_menu( array( 'container' => false, 'menu' => 'header','walker' => new description_walker(),'items_wrap' => '%3$s' ) ); ?>

                <!-- if there's extra button link -->

                <?php /* code goes here */ ?>

                <!-- Mobile Menu Link (It only appears on mobile screens) -->

                <li><a href="javascript:void(0)" role="menu"> <i class="material-icons">&#xE3C7;</i></a></li>

              </ul>

            </nav>

          </div>

        </div>

      </header>