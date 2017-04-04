    <section id="banner">
    	<div class="banner">
    		<img src="$Photo.URL" alt="$Title" />
    		<div class="container pv-70">
    			$Content
    		</div>
    	</div>
    </section>
	<section id="content-adventure">
		<div class="container">
			<div class="row">
			<% loop $Children %>
				<div class="col-md-4 col-sm-6">
					<figure class="box blog">
						<img src="$Photo.CroppedImage(480,480).URL" alt="$Title" />
						<a href="$Link">
							<figcaption>
								<div>
									<h3>$Title</h3>
									<span>$Date.Format('F Y')</span>
								</div>
							</figcaption>
						</a>
					</figure>
				</div>
			<% end_loop %>
			</div>
		</div>
	</section>