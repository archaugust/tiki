    <section id="banner">
    	<div class="banner">
    		<img src="$Photo.URL" alt="$Title" />
    	</div>
    </section>
	<section id="content">
		<div class="container pv-70 ph-70">
			<div class="text-center ph-70">
			$Content
			</div>
			<div class="row open-sans">
				<div class="col-md-offset-2 col-md-8 mt-25">
					$ContentTop
					
					<div id="slideshow" class="carousel slide" data-ride="carousel">
					  <ol class="carousel-indicators">
					  	<% loop $SlidePhotos %>
					    <li data-target="#slideshow" data-slide-to="$Pos(0)"<% if $First %>class="active"<% end_if %>></li>
					    <% end_loop %>
					  </ol>
					
					  <!-- Wrapper for slides -->
					  <div class="carousel-inner" role="listbox">
					  <% loop $SlidePhotos %>
					    <div class="item<% if $First %> active<% end_if %>">
					      $Photo.CroppedImage(734,455)
					      <div class="carousel-caption">
					        $Caption
					      </div>
					    </div>
					  <% end_loop %>
					  </div>
					
					  <!-- Controls -->
					  <a class="left carousel-control" href="#slideshow" role="button" data-slide="prev">
					    <img src="$ThemeDir/images/slide-left.png" alt="Previous" class="icon-prev" aria-hidden="true" />
					    <span class="sr-only">Previous</span>
					  </a>
					  <a class="right carousel-control" href="#slideshow" role="button" data-slide="next">
					    <img src="$ThemeDir/images/slide-right.png" alt="Next" class="icon-next" aria-hidden="true" />
					    <span class="sr-only">Next</span>
					  </a>
					</div>

					$ContentBottom
				</div>
			</div>
		</div>
	</section>