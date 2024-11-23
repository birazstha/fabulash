@php
    $segment = request()->segment(2);
    $subMenuIsActive = false;
    $hasPermissionForChild = false;
    if (isset($input['subMenus'])) {
        foreach ($input['subMenus'] as $key => $subMenu) {
            if (isset($subMenu['route']) && $subMenu['route'] === $segment) {
                $subMenuIsActive = true;
            }

            if (isset($subMenu['permission']) && $subMenu['permission'] === true) {
                $hasPermissionForChild = true;
            }
        }
    }
@endphp

<li class="nav-item {{ $subMenuIsActive === true ? 'menu-open' : '' }}">
    <a href="{{ isset($input['route'])
        ? (isset($input['hasSubmenu']) && $input['hasSubmenu']
            ? '#'
            : (isset($input['customRoute'])
                ? route($input['route'])
                : route($input['route'] . '.index')))
        : '#' }}"
        class="nav-link 
    {{ $subMenuIsActive === true ? 'active' : '' }} 
    {{ isset($input['permission']) && $input['permission'] == false ? 'd-none' : '' }}
    {{ !isset($input['hasSubmenu']) && isset($input['route']) && request()->segment(2) === $input['route'] ? 'active' : '' }}
    {{ isset($input['hasSubmenu']) && $input['hasSubmenu'] === true && $hasPermissionForChild === false ? 'd-none' : '' }}">
        <i class="nav-icon {{ $input['icon'] ?? '' }}"></i>
        <p>
            {{ $input['title'] }}
            @if (isset($input['hasSubmenu']) && $input['hasSubmenu'])
                <i class="fas fa-angle-left right"></i>
            @endif
        </p>
    </a>

    @if (isset($input['hasSubmenu']) && $input['hasSubmenu'])
        <ul class="nav nav-treeview">
            @foreach ($input['subMenus'] as $subMenu)
                <li class="nav-item">
                    <a href="{{ route($subMenu['route'] . '.index') }}"
                        class="nav-link {{ request()->segment(2) === $subMenu['route'] ? 'active' : '' }} {{ isset($subMenu['permission']) && $subMenu['permission'] == false ? 'd-none' : '' }}">
                        <div class="ml-3">
                            <i class="nav-icon {{ $subMenu['icon'] ?? '' }}"></i>
                            <p>{{ $subMenu['title'] ?? '' }}</p>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</li>
