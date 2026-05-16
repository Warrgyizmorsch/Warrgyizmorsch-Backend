<nav class="nxl-navigation">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('dashboard') }}" class="b-brand">
                <!-- Logo -->
                <img src="{{ asset('/images/WARR LOGO.webp') }}" alt="Full Logo" class="logo logo-lg"
                    style="max-height: 50px;">
                <img src="{{ asset('/images/image copy.png') }}" alt="Small Logo" class="logo logo-sm">
            </a>
        </div>

        <div class="navbar-content">
            <ul class="nxl-navbar">
                @foreach($menus as $menu)
                    {!! renderMenu($menu) !!}
                @endforeach
            </ul>
        </div>
    </div>
</nav>

@php
    // 🔁 Recursive function to render unlimited levels
    function renderMenu($menu)
    {
        $hasChildren = $menu->children && $menu->children->count();
        $html = '<li class="nxl-item ' . ($hasChildren ? 'nxl-hasmenu' : '') . '">';

        $html .= '<a href="' . ($menu->route ? route($menu->route->route_name) : 'javascript:void(0);') . '" class="nxl-link">';
        if ($menu->icon) {
            $html .= '<span class="nxl-micon"><i class="' . $menu->icon . '"></i></span>';
        }
        $html .= '<span class="nxl-mtext">' . $menu->title . '</span>';
        if ($hasChildren) {
            $html .= '<span class="nxl-arrow"><i class="feather-chevron-right"></i></span>';
        }
        $html .= '</a>';

        if ($hasChildren) {
            $html .= '<ul class="nxl-submenu">';
            foreach ($menu->children as $child) {
                $html .= renderMenu($child); // 🔁 recursive call
            }
            $html .= '</ul>';
        }

        $html .= '</li>';
        return $html;
    }
@endphp