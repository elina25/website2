

<?php 
$ControllerAccompanyingObject = new ControllerAccompanyingObject();
$itemtypes = $ControllerAccompanyingObject->getAllAccompanyingItemTypes();

?>


				<div class="sidebar col-xs-12 col-sm-4 col-md-3">
					<div class="sidebar-padder">
						<aside id="nav_menu-3" class="widget widget_nav_menu">
							<h3 class="widget-title"><?php echo $lang['sinodeutiko_iliko'] ?></h3>
							<div class="menu-top-destinations-container">
								<ul id="menu-top-destinations" class="menu">
									<?php foreach ($itemtypes as $itemtype) { ?>
										<li class="cat-item"><a href="accompanying_object.php?item_type_id=<?php echo $itemtype->accompanyingItemTypeID; echo $langParam;?>"><?php echo ((isset($_GET['lang']) === false)?  $itemtype->PluralDesc : $itemtype->StandardName  ) ?></a></li>
									<?php } ?>			
								
									
								</ul>
							</div>
						</aside>
						<aside id="recent-posts-4" class="widget widget_recent_entries">
							<h3 class="widget-title">From the Blog</h3>
							<ul>
								<li> <a href="single-hero.html">Living the Travel Lifestyle</a></li>
								<li> <a href="single-hero.html">Choosing Your Next Vacation Destination</a></li>
								<li> <a href="single-hero.html">Unusual Places to Consider Visiting</a></li>
								<li> <a href="single-hero.html">8 Useful Tools for Planning a Great Trip</a></li>
								<li> <a href="single-hero.html">Great Advise for Ski Travelers</a></li>
								<li> <a href="single-hero.html">Time To Hit The Road</a></li>
								<li> <a href="single-hero.html">Safety First When Traveling Alone</a></li>
								<li> <a href="single-hero.html">The Trip of a Lifetime</a></li>
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
								<li class="cat-item"><a href="blog.html">Travel Planning</a></li>
								<li class="cat-item"><a href="blog.html">Travel Tips</a></li>
							</ul>
						</aside>
					</div>
				</div>