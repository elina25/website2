<?php 
require_once("inc/init.php");
require_once("inc/lang.php");

$ControllerReligiousEvent = new ControllerReligiousEvent();
$infos = $ControllerReligiousEvent->getReligiousEventWithID($_GET['ReligiousEventID']);
print_r($infos);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Panorama</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="assets/css/imports.css" media="screen">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="assets/css/custom.css" media="screen">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class="single single-post">

    <div id="top"></div>

    <!-- Navigation (main menu)
    ================================================== -->

    <div class="navbar-wrapper">
          <?php include('inc/header.php'); ?>

    </div><!-- /.navbar-wrapper -->




    <!-- Hero Section
    ================================================== -->

    <section class="hero small-hero" style="background-image:url(assets/images/photo_profil.jpg);">
      <div class="bg-overlay">
        <div class="container">
          <div class="intro-wrap">
            <p class="intro-title"><?php echo $lang['religiousevent']; ?></p>
          </div>
        </div>
      </div>
    </section>




    <!-- Main Section
    ================================================== -->

    <section class="main container">
      <div id="content" class="row">
        <div class="col-sm-8 col-md-6 col-md-push-3">
          <header class="entry-header">
            <h3 class="widget-title"><?php echo $lang['otherdetails']  ?></h3>
          </header>
          <article class="post">
            <div class="entry-summary">
              <p class="lead">And if I'm ever in need of advice from a psychotic potato dwarf, you'll certainly be the first to know. And that is more important. Then it doesn't have to end. I hate endings! I never know why. I only know who.</p>
            </div>
            <div class="entry-content">
           
          
            </div>
            <div id="comments" class="comments-area">
              <header class="page-header">
                <h2 class="comments-title"> 3 thoughts on “<span>Living the Travel Lifestyle</span>”</h2> </header>
              <ol class="comment-list media-list">
                <li class="comment even thread-even depth-1 parent">
                  <article id="div-comment-6" class="comment-body media">
                    <div class="media-body">
                      <div class="media-body-wrap panel panel-default">
                        <div class="panel-heading clearfix">
                          <a class="pull-left" href="#"> <img src="assets/images/user-1.jpg" width="50" height="50" alt="Mason" class="avatar alignnone photo"> </a>
                          <h5 class="media-heading">
                            <cite class="fn">Mason</cite> <span class="says">says:</span>
                          </h5>
                          <div class="comment-meta">
                            <a href="#">
                              <time datetime="2015-05-13T16:27:32+00:00"> May 13, 2015 </time>
                            </a>
                          </div>
                        </div>
                        <div class="comment-content panel-body">
                          <p>That’s great. Maybe someday that can be me. I love to travel and it would be a dream to make it a lifestyle!</p>
                        </div>
                        <footer class="reply comment-reply panel-footer"><a class="comment-reply-link" href="#" aria-label="Reply to Mason">Reply</a></footer>
                      </div>
                    </div>
                  </article>
                  <ul class="children">
                    <li class="comment odd alt depth-2">
                      <article id="div-comment-7" class="comment-body media">
                        <div class="media-body">
                          <div class="media-body-wrap panel panel-default">
                            <div class="panel-heading clearfix">
                              <a class="pull-left" href="#"> <img src="assets/images/user-2.jpg" width="50" height="50" alt="Sophia" class="avatar alignnone photo"> </a>
                              <h5 class="media-heading"><cite class="fn">Sophia</cite> <span class="says">says:</span></h5>
                              <div class="comment-meta">
                                <a href="#">
                                  <time datetime="2015-05-13T16:28:16+00:00"> May 13, 2015 </time>
                                </a>
                              </div>
                            </div>
                            <div class="comment-content panel-body">
                              <p>I deceived you, mom. Tricked makes it sound like we have a playful relationship. But where did the lighter fluid come from? Go ahead, touch the Cornballer.</p>
                            </div>
                            <footer class="reply comment-reply panel-footer"><a class="comment-reply-link" href="#" aria-label="Reply to Sophia">Reply</a></footer>
                          </div>
                        </div>
                      </article>
                    </li>
                  </ul>
                </li>
                <li class="comment even thread-odd thread-alt depth-1">
                  <article class="comment-body media">
                    <div class="media-body">
                      <div class="media-body-wrap panel panel-default">
                        <div class="panel-heading clearfix">
                          <a class="pull-left" href="#"> <img src="assets/images/user-3.jpg" width="50" height="50" alt="Ethan" class="avatar alignnone photo"> </a>
                          <h5 class="media-heading"><cite class="fn">Ethan</cite> <span class="says">says:</span></h5>
                          <div class="comment-meta">
                            <a href="#">
                              <time datetime="2015-05-13T16:28:54+00:00"> May 13, 2015 </time>
                            </a>
                          </div>
                        </div>
                        <div class="comment-content panel-body">
                          <p>This would be an amazing thing to do. I really appreciate you sharing the details with us and how you were able to accomplish such a thing. It’s an inspiration to me, and many others I’m sure.</p>
                          <p>Keep this up! We love hearing the awesome advise.</p>
                        </div>
                        <footer class="reply comment-reply panel-footer"><a class="comment-reply-link" href="#" aria-label="Reply to Ethan">Reply</a></footer>
                      </div>
                    </div>
                  </article>
                </li>
              </ol>
              <div id="respond" class="comment-respond">
                <h3 id="reply-title" class="comment-reply-title">Leave a Reply <small><a rel="nofollow" href="#" style="display:none;">Cancel Reply</a></small></h3>
                <form id="commentform" class="comment-form">
                  <p class="comment-notes"><span id="email-notes">Your email address will not be published.</span> Required fields are marked <span class="required">*</span></p>
                  <p class="comment-form-author">
                    <label for="author">Name <span class="required">*</span></label>
                    <input id="author" name="author" type="text" value="" size="30" aria-required="true" required="required">
                  </p>
                  <p class="comment-form-email">
                    <label for="email">Email <span class="required">*</span></label>
                    <input id="email" name="email" type="text" value="" size="30" aria-describedby="email-notes" aria-required="true" required="required">
                  </p>
                  <p class="comment-form-url">
                    <label for="url">Website</label>
                    <input id="url" name="url" type="text" value="" size="30">
                  </p>
                  <p>
                    <textarea placeholder="Start typing..." id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true"></textarea>
                  </p>
                  <div class="form-allowed-tags-wrapper">
                    <p class="form-allowed-tags">You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:</p>
                    <div class="well well-sm"><small>&lt;a href="" title=""&gt; &lt;abbr title=""&gt; &lt;acronym title=""&gt; &lt;b&gt; &lt;blockquote cite=""&gt; &lt;cite&gt; &lt;code&gt; &lt;del datetime=""&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=""&gt; &lt;s&gt; &lt;strike&gt; &lt;strong&gt; </small></div>
                  </div>
                  <p class="form-submit">
                    <input name="submit" type="submit" id="commentsubmit" class="submit" value="Post Comment">
                    <input type="hidden" name="comment_post_ID" value="636" id="comment_post_ID">
                    <input type="hidden" name="comment_parent" id="comment_parent" value="0">
                  </p>
                </form>
              </div>
            </div>
          </article>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-3 col-md-pull-6 blog-details-column">
          <div class="entry-meta">
            <span class="icon-meta">
              <span class="posted-on"> 
                <h3 class="widget-title"><?php echo $lang['basicdetails']; ?>
              </span>
            </span>

            <div class="byline icon-meta">
              <i class="fa fa-user "></i>
              <span class="author vcard meta-item">
                <?php foreach ($infos as $info){ ?><?php echo $info->UniqueName ?>
                <?php echo $info->UniqueName ?>
                
                <?php  } ?>
              </span>
            </div>

            <div class="comments-link icon-meta">
              <i class="fa fa-comments"></i>
              <span class="meta-item">
                <a href="#"><?php echo $info->parentID ?></a>
              </span>
            </div>

            <div class="cat-links icon-meta">
              <i class="fa fa-folder"></i>
              <a href="#" rel="category tag">Europe</a>&nbsp;&nbsp;
              <a href="#" rel="category tag">Family Travel</a>&nbsp;&nbsp;
              <a href="#" rel="category tag">North America</a>&nbsp;&nbsp;
              <a href="#" rel="category tag">Travel News</a>&nbsp;&nbsp;
              <a href="#" rel="category tag">Travel Planning</a>
            </div>

            <div class="tag-links icon-meta">
              <i class="fa fa-tag"></i>
              <a href="#" rel="tag">choices</a>&nbsp;&nbsp;
              <a href="#" rel="tag">destination</a>&nbsp;&nbsp;
              <a href="#" rel="tag">family</a>&nbsp;&nbsp;
              <a href="#" rel="tag">lifestyle</a>&nbsp;&nbsp;
              <a href="#" rel="tag">living</a>&nbsp;&nbsp;
              <a href="#" rel="tag">memories</a>&nbsp;&nbsp;
              <a href="#" rel="tag">planning</a>&nbsp;&nbsp;
              <a href="#" rel="tag">route</a>&nbsp;&nbsp;
              <a href="#" rel="tag">tips</a>&nbsp;&nbsp;
              <a href="#" rel="tag">trip</a>
            </div>
          </div>

          <div class="sidebar">
            <div class="sidebar-padder">
              <div class="widget scg_widget single-post-left widget_text">
                <div class="textwidget">
                  <hr>
                  <p>Are you a writer? Are you interested in seeing the world, and being paid to do it? Of course you are.
                    <br>
                    <br> <a href="#"><strong>Find our more</strong> <i class="fa fa-arrow-right"></i></a></p>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="sidebar col-xs-12 col-sm-4 col-md-3">
          <div class="sidebar-padder">
            <aside id="nav_menu-3" class="widget widget_nav_menu">
              <h3 class="widget-title"><?php echo $lang['sinodeutiko_iliko']  ?></h3>
              <div class="menu-top-destinations-container">
                <ul id="menu-top-destinations" class="menu">
                  <li class="menu-item"><a href="destination-sub-page.html">London, England</a></li>
                  <li class="menu-item"><a href="destination-sub-page.html">Sydney, Australia</a></li>
                  <li class="menu-item"><a href="destination-sub-page.html">Chicago, USA</a></li>
                  <li class="menu-item"><a href="destination-sub-page.html">San Francisco, USA</a></li>
                  <li class="menu-item"><a href="destination-sub-page.html">Toronto, Canada</a></li>
                  <li class="menu-item"><a href="destination-sub-page.html">Buenos Aires, Argentina</a></li>
                  <li class="menu-item"><a href="destination-sub-page.html">Queenstown, New Zealand</a></li>
                  <li class="menu-item"><a href="destination-sub-page.html">Santorini, Greece</a></li>
                </ul>
              </div>
            </aside>
            <aside id="recent-posts-4" class="widget widget_recent_entries">
              <h3 class="widget-title">From the Blog</h3>
              <ul>
                <li> <a href="single-hero.html">Living the Travel Lifestyle</a></li>
                <li> <a href="single-hero.html">Choosing Your Next Vacation Destination</a></li>
                <li> <a href="single-hero.html">Unusual Places to Consider Visiting</a></li>
              
              </ul>
            </aside>
            <aside id="categories-2" class="widget widget_categories">
              <h3 class="widget-title">Topics</h3>
              <ul>
                <li class="cat-item cat-item-48"><a href="destinations.html">Destinations</a>
                  <ul class="children">
                    <li class="cat-item"><a href="destination-parent.html">Europe</a></li>
                    <li class="cat-item"><a href="destination-parent.html">North America</a></li>
                    <li class="cat-item"><a href="destination-parent.html">Oceania</a></li>
                    <li class="cat-item"><a href="destination-parent.html">South America</a></li>
                  </ul>
                </li>
                <li class="cat-item"><a href="blog.html">Family Travel</a></li>
                <li class="cat-item"><a href="blog.html">Travel News</a></li>
              </ul>
            </aside>
          </div>
        </div>
      </div>
    </section>


    <!-- Footer
    ================================================== -->
<?php include('inc/footer.php') ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/custom.js"></script>
  </body>
</html>