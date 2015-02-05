<div id="mainMenu">
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		@if (Menu::exists('leftMenu') && count(Menu::getMenu('leftMenu')->items) > 0)
			<ul class="nav navbar-nav">
				@each('layouts.menus.twitter.item', Menu::getMenu('leftMenu')->items, 'item')
			</ul>
		@endif
		@if (Menu::exists('rightMenu') && count(Menu::getMenu('rightMenu')->items) > 0)
			<ul class="nav navbar-nav navbar-right">
				@each('layouts.menus.twitter.item', Menu::getMenu('rightMenu')->items, 'item')
			</ul>
		@endif
	</nav>
</div>
<br style="clear: both;" />