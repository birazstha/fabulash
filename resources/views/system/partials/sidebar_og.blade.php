<!-- Sidebar -->

@php
    $roleId = auth()->user()->role_id;
    $role = \App\Models\Role::find($roleId);
@endphp
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @foreach (config('cmsConfig') as $key => $module)

                @if ($roleId != 1)
                    @foreach ($role->permissions as $permission)
                        @php
                            $route = isset($module['route']) ? $module['route'] . '.index' : '';
                            $route = ltrim($route, '/');
                        @endphp



                        @if ($permission->route === $route || 'home' === $route)
                            @if ($module['hasSubmodules'])
                                @php
                                    $submodulesRoute = collect($module['submodules'])
                                        ->pluck('route')
                                        ->toArray();
                                @endphp
                            @else
                                @php $submodulesRoute = [] @endphp
                            @endif
                            <li
                                class="nav-item has-treeview {{ in_array('/' . request()->segment(2), $submodulesRoute) ? 'active' : '' }}">

                                @if ($module['hasSubmodules'] === false)
                                    <a href="{{ url(env('PREFIX') . $module['route']) }}"
                                        class="nav-link icons {{ '/' . request()->segment(2) === $module['route'] ? 'active' : '' }}">

                                        {!! $module['icon'] !!} &nbsp;<p>{{ $module['name'] }}</p>
                                    </a>
                                @endif

                                @if ($module['hasSubmodules'] === true)
                                    <a href=""
                                        class="nav-link  {{ in_array('/' . request()->segment(2), $submodulesRoute) ? 'active' : '' }} ">

                                        {!! $module['icon'] !!} &nbsp;<p>{{ $module['name'] }}</p>


                                        <i
                                            class="right fas {{ in_array('/' . request()->segment(2), $submodulesRoute) ? 'fa-angle-down' : 'fa-angle-left' }}"></i>

                                    </a>
                                    @foreach ($module['submodules'] as $submodule)
                                        <ul class="nav nav-treeview"
                                            style="{{ in_array('/' . request()->segment(2), $submodulesRoute) ? 'display:block' : 'display:none' }}">
                                            <li class="nav-item">
                                                <a href="{{ url(env('PREFIX') . $submodule['route']) }}"
                                                    class="nav-link  {{ '/' . request()->segment(2) === $submodule['route'] ? 'active' : '' }}">
                                                    {{-- <i class="far fa-circle nav-icon"></i> --}}
                                                    &nbsp; &nbsp; {!! $submodule['icon'] !!} &nbsp;<p>
                                                        {{ $submodule['name'] }}
                                                    </p>
                                                </a>
                                            </li>
                                        </ul>
                                    @endforeach
                                @endif

                            </li>
                        @endif
                    @endforeach
                @else
                    @if ($module['hasSubmodules'])
                        @php
                            $submodulesRoute = collect($module['submodules'])
                                ->pluck('route')
                                ->toArray();
                        @endphp
                    @else
                        @php $submodulesRoute = [] @endphp
                    @endif
                    <li
                        class="nav-item has-treeview {{ in_array('/' . request()->segment(2), $submodulesRoute) ? 'active' : '' }}">

                        @if ($module['hasSubmodules'] === false)
                            <a href="{{ url(env('PREFIX') . $module['route']) }}"
                                class="nav-link icons {{ '/' . request()->segment(2) === $module['route'] ? 'active' : '' }}">

                                {!! $module['icon'] !!} &nbsp;<p>{{ $module['name'] }}</p>
                            </a>
                        @endif

                        @if ($module['hasSubmodules'] === true)
                            <a href=""
                                class="nav-link  {{ in_array('/' . request()->segment(2), $submodulesRoute) ? 'active' : '' }} ">

                                {!! $module['icon'] !!} &nbsp;<p>{{ $module['name'] }}</p>


                                <i
                                    class="right fas {{ in_array('/' . request()->segment(2), $submodulesRoute) ? 'fa-angle-down' : 'fa-angle-left' }}"></i>

                            </a>
                            @foreach ($module['submodules'] as $submodule)
                                <ul class="nav nav-treeview"
                                    style="{{ in_array('/' . request()->segment(2), $submodulesRoute) ? 'display:block' : 'display:none' }}">
                                    <li class="nav-item">
                                        <a href="{{ url(env('PREFIX') . $submodule['route']) }}"
                                            class="nav-link  {{ '/' . request()->segment(2) === $submodule['route'] ? 'active' : '' }}">
                                            {{-- <i class="far fa-circle nav-icon"></i> --}}
                                            &nbsp; &nbsp; {!! $submodule['icon'] !!} &nbsp;<p>
                                                {{ $submodule['name'] }}
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            @endforeach
                        @endif

                    </li>
                @endif


            @endforeach
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
