@php
    // 🔁 Recursive function to render unlimited menu levels dynamically (Fully backward-compatible)
    if (!function_exists('renderMenu')) {
        function renderMenu($menu)
        {
            $hasChildren = isset($menu->children) && (is_countable($menu->children) ? count($menu->children) > 0 : false);

            $routeName = null;
            if (isset($menu->route)) {
                if (is_object($menu->route) && isset($menu->route->route_name)) {
                    $routeName = $menu->route->route_name;
                } elseif (is_string($menu->route)) {
                    $routeName = $menu->route;
                }
            }

            // Dynamic Active State Check
            $isActive = false;
            if ($routeName && \Illuminate\Support\Facades\Route::has($routeName)) {
                $isActive = request()->routeIs($routeName);
                if (isset($menu->custom_params) && is_array($menu->custom_params)) {
                    foreach ($menu->custom_params as $k => $v) {
                        if (request($k) != $v) {
                            $isActive = false;
                            break;
                        }
                    }
                }
            } elseif ($hasChildren) {
                foreach ($menu->children as $child) {
                    if (isset($child->custom_params) && is_array($child->custom_params)) {
                        $match = true;
                        foreach ($child->custom_params as $k => $v) {
                            if (request($k) != $v) {
                                $match = false;
                                break;
                            }
                        }
                        if ($match) {
                            $isActive = true;
                            break;
                        }
                    }
                }
            }

            $html = '<li class="nxl-item ' . ($hasChildren ? 'nxl-hasmenu' : '') . ($isActive ? ' active nxl-trigger' : '') . '">';

            $url = 'javascript:void(0);';
            if ($routeName && \Illuminate\Support\Facades\Route::has($routeName)) {
                $params = (isset($menu->custom_params) && is_array($menu->custom_params)) ? $menu->custom_params : [];
                try {
                    $url = route($routeName, $params);
                } catch (\Exception $e) {
                    $url = 'javascript:void(0);';
                }
            }

            $html .= '<a href="' . $url . '" class="nxl-link">';
            if (!empty($menu->icon)) {
                $html .= '<span class="nxl-micon"><i class="' . e($menu->icon) . '"></i></span>';
            }
            $html .= '<span class="nxl-mtext">' . e($menu->title ?? '') . '</span>';
            if ($hasChildren) {
                $html .= '<span class="nxl-arrow"><i class="feather-chevron-right"></i></span>';
            }
            $html .= '</a>';

            if ($hasChildren) {
                $html .= '<ul class="nxl-submenu">';
                foreach ($menu->children as $child) {
                    $html .= renderMenu($child); // 🔁 recursive call
                }
                if (strtolower(trim($menu->title ?? '')) === 'setting') {
                    $isPluginActive = request()->routeIs('plugins.*');
                    $html .= '<li class="nxl-item ' . ($isPluginActive ? 'active' : '') . '">';
                    $html .= '<a href="' . route('plugins.index') . '" class="nxl-link">';
                    $html .= '<span class="nxl-mtext">Call Plugin</span>';
                    $html .= '</a></li>';
                }
                $html .= '</ul>';
            }

            $html .= '</li>';
            return $html;
        }
    }
@endphp

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
                @php $renderedCallHistory = false; @endphp
                @foreach($menus as $menu)
                    {!! renderMenu($menu) !!}
                    @if(in_array(strtolower(trim($menu->title ?? '')), ['whatsapp', 'emails']) && !$renderedCallHistory)
                        {{-- Twilio Call History right after Communication menus --}}
                        <li class="nxl-item {{ request()->routeIs('call.history*') ? 'active' : '' }}">
                            <a href="{{ route('call.history', ['provider' => 'twilio']) }}" class="nxl-link">
                                <span class="nxl-micon"><i class="feather-phone-call"></i></span>
                                <span class="nxl-mtext">Call History</span>
                            </a>
                        </li>
                        @php $renderedCallHistory = true; @endphp
                    @endif
                @endforeach

                @if(!$renderedCallHistory)
                    <li class="nxl-item {{ request()->routeIs('call.history*') ? 'active' : '' }}">
                        <a href="{{ route('call.history', ['provider' => 'twilio']) }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-phone-call"></i></span>
                            <span class="nxl-mtext">Call History</span>
                        </a>
                    </li>
                @endif

                @php
                    $hasSettingMenu = false;
                    foreach ($menus as $m) {
                        if (strtolower(trim($m->title ?? '')) === 'setting') {
                            $hasSettingMenu = true;
                            break;
                        }
                    }
                @endphp
                @if(!$hasSettingMenu)
                <li class="nxl-item {{ request()->routeIs('plugins.*') ? 'active' : '' }}">
                    <a href="{{ route('plugins.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-settings"></i></span>
                        <span class="nxl-mtext">Call Plugin</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>