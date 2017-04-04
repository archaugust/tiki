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
			<div class="col-1 <% if $Even %>even<% end_if %>">
				<img src="$Photo.CroppedImage(770, 510).URL" alt="$Title" class="col-photo" />
			</div>
			<div class="col-2 <% if $Odd %>odd<% end_if %>">
				<div class="text">
					<h3>$Title</h3>
					<br />
					<p>$Text</p>
				</div>
			</div>
		</div>
		<% end_loop %>
		</div>
	</section>