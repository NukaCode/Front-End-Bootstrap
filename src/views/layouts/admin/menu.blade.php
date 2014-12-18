<div class="sidebar" id="sidebar">
    <ul class="nav" id="side-menu">
        <li class="nav-header">Admin</li>
        <li>
            <a data-location="{{ URL::route('admin.dashboard', [], false) }}" id="dashboard" class="ajaxLink">
                <i class="fa fa-th-large"></i>
                <span class="nav-label">Dashboard</span>
            </a>
        </li>
        @each('layouts.admin.menu.item', $config->navigation, 'details')
        <li class="special_link">
            <a href="/">
                <i class="fa fa-sign-out"></i>
                <span class="nav-label">Return to site</span>
            </a>
        </li>
    </ul>
</div>