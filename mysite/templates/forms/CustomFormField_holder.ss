	<% if $Title %><label for="$ID"><% if $Message %>$Message<% else %>$Title<% end_if %></label><% end_if %>
		$Field
	<% if $RightTitle %><label class="right" for="$ID">$RightTitle</label><% end_if %>
	<% if $Description %><span class="description">$Description</span><% end_if %>
