<div id="mainMenu">
	@if (Menu::exists('leftMenu') && count(Menu::getMenu('leftMenu')->items) > 0)
		<ul id="utopian-navigation" class="black utopian">
			@each('layouts.menus.utopian.item', Menu::getMenu('leftMenu')->items, 'item')
		</ul>
	@endif
	@if (Menu::exists('rightMenu') && count(Menu::getMenu('rightMenu')->items) > 0)
		<div class="pull-right">
			<ul id="utopian-navigation" class="black utopian">
				@each('layouts.menus.utopian.item', Menu::getMenu('rightMenu')->items, 'item')
			</ul>
		</div>
	@endif
</div>
<br style="clear: both;" />