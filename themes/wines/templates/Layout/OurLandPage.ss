    <section id="banner">
    	<div class="banner">
    		<img src="$Photo.URL" alt="$Title" />
    		<div class="container pv-70">
    			$Content
    		</div>
    	</div>
    </section>
	<section id="content">
		<div class="container-fluid">
		<% loop $Sections %>
		<div class="ourland">
			<% if $Odd %>
			<div class="col-1">
				$Photo.CroppedImage(770, 510)
			</div>
			<div class="col-2 odd">
				<div class="text">
					<h3>$Title</h3>
					<br />
					<p>$Text</p>
				</div>
			</div>
			<% else %>
			<div class="col-2">
				<div class="text">
					<h3>$Title</h3>
					<br />
					<p>$Text</p>
				</div>
			</div>
			<div class="col-1">
				$Photo.CroppedImage(770, 510)
			</div>
			<% end_if %>
		</div>
		<% end_loop %>
		</div>
	</section>