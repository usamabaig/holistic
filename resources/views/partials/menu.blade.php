<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route("admin.home") }}" class="nav-link">
                        <p>
                            <i class="fas fa-fw fa-tachometer-alt">

                            </i>
                            <span>{{ trans('global.dashboard') }}</span>
                        </p>
                    </a>
                </li>

                @can('user_management_access')
                <li
                    class="nav-item has-treeview {{ request()->is('admin/permissions*') ? 'menu-open' : '' }} {{ request()->is('admin/roles*') ? 'menu-open' : '' }} {{ request()->is('admin/users*') ? 'menu-open' : '' }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users">

                        </i>
                        <p>
                            <span>{{ trans('cruds.userManagement.title') }}</span>
                            <i class="right fa fa-fw fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('permission_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.permissions.index") }}"
                                class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt">

                                </i>
                                <p>
                                    <span>{{ trans('cruds.permission.title') }}</span>
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('role_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.roles.index") }}"
                                class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-briefcase">

                                </i>
                                <p>
                                    <span>{{ trans('cruds.role.title') }}</span>
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('user_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.users.index") }}"
                                class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-user">

                                </i>
                                <p>
                                    <span>{{ trans('cruds.user.title') }}</span>
                                </p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan

                


                @can('service_access')
                <li
                    class="nav-item has-treeview {{ request()->is('admin/facilities*') ? 'menu-open' : '' }} {{ request()->is('admin/sub-services*') ? 'menu-open' : '' }} {{ request()->is('admin/service-categories*') ? 'menu-open' : '' }} {{ request()->is('admin/sub-catagories*') ? 'menu-open' : '' }} {{ request()->is('admin/areas*') ? 'menu-open' : '' }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-server">

                        </i>
                        <p>
                            <span>Service Section</span>
                            <i class="right fa fa-fw fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('service_category_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.service-categories.index") }}"
                                class="nav-link {{ request()->is('admin/service-categories') || request()->is('admin/service-categories/*') ? 'active' : '' }}">
                                <i class="fa-fw fab fa-servicestack">

                                </i>
                                <p>
                                    {{--<span>{{ trans('cruds.serviceCategory.title') }}</span>--}}
                                    <span>Services</span>
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('facility_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.facilities.index") }}"
                                class="nav-link {{ request()->is('admin/facilities') || request()->is('admin/facilities/*') ? 'active' : '' }}">
                                <i class="fa-fw fab fa-servicestack">

                                </i>
                                <p>
                                    {{--<span>{{ trans('cruds.facility.title') }}</span>--}}
                                    <span>Categories</span>
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('sub_service_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.sub-services.index") }}"
                                class="nav-link {{ request()->is('admin/sub-services') || request()->is('admin/sub-services/*') ? 'active' : '' }}">
                                <i class="fa-fw fab fa-servicestack">

                                </i>
                                <p>
                                    {{--<span>{{ trans('cruds.subService.title') }}</span>--}}
                                    <span>Packages</span>
                                </p>
                            </a>
                        </li>
                        @endcan
                        {{--@can('sub_catagory_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.sub-catagories.index") }}"
                                class="nav-link {{ request()->is('admin/sub-catagories') || request()->is('admin/sub-catagories/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-folder">

                                </i>
                                <p>
                                    <span>{{ trans('cruds.subCatagory.title') }}</span>
                                </p>
                            </a>
                        </li>
                        @endcan--}}
                        {{--@can('area_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.areas.index") }}"
                                class="nav-link {{ request()->is('admin/areas') || request()->is('admin/areas/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-align-justify">

                                </i>
                                <p>
                                    <span>{{ trans('cruds.area.title') }}</span>
                                </p>
                            </a>
                        </li>
                        @endcan--}}
                    </ul>
                </li>
                @endcan
                @can('faq_management_access')
                <li
                    class="nav-item has-treeview {{ request()->is('admin/faq-categories*') ? 'menu-open' : '' }} {{ request()->is('admin/faq-questions*') ? 'menu-open' : '' }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-question">

                        </i>
                        <p>
                            <span>{{ trans('cruds.faqManagement.title') }}</span>
                            <i class="right fa fa-fw fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                       
                        @can('faq_question_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.faq-questions.index") }}"
                                class="nav-link {{ request()->is('admin/faq-questions') || request()->is('admin/faq-questions/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-question">

                                </i>
                                <p>
                                    <span>{{ trans('cruds.faqQuestion.title') }}</span>
                                </p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan

                <li class="nav-item">
                    <a href="{{ url("admin/orders") }}"
                        class="nav-link {{ request()->is('admin/orders') || request()->is('admin/orders/*') ? 'active' : '' }}">
                        <i class="fab fa-first-order"></i>                        
                        <p>
                            <span>Orders</span>
                        </p>
                    </a>
                </li>

                {{-- Settings tab --}}

                <li
                    class="nav-item has-treeview {{ request()->is('admin/faq-categories*') ? 'menu-open' : '' }} {{ request()->is('admin/faq-questions*') ? 'menu-open' : '' }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">

                        <i class="fa fa-cog" aria-hidden="true"></i>

                        <p>
                            <span>Settings</span>
                            <i class="right fa fa-fw fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                        <a href="{{url('admin/header')}}"
                                class="nav-link {{ request()->is('admin/faq-categories') || request()->is('admin/faq-categories/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-folder">

                                </i>
                                <p>
                                    <span> Header / Footer </span>
                                </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{url('admin/testimonials')}}"
                                    class="nav-link {{ request()->is('admin/faq-categories') || request()->is('admin/faq-categories/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-folder">

                                    </i>
                                    <p>
                                        <span> Testimonials </span>
                                    </p>
                                </a>
                            </li>


                    </ul>
                </li>






                @can('feedback_access')
                <li class="nav-item">
                    <a href="{{ route("admin.feedback.index") }}"
                        class="nav-link {{ request()->is('admin/feedback') || request()->is('admin/feedback/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-rss-square">

                        </i>
                        <p>
                            <span>{{ trans('cruds.feedback.title') }}</span>
                        </p>
                    </a>
                </li>
                @endcan












                {{--@can('slider_access')--}}
                <li class="nav-item">
                    <a href="{{ url("admin/slider") }}"
                        class="nav-link {{ request()->is('admin/slider') || request()->is('admin/slider/*') ? 'active' : '' }}">

                        <i class="fas fa-images    "></i>
                        <p>
                            <span>Slider</span>
                        </p>
                    </a>
                </li>
                {{--@endcan--}}
                @can('order_access')
                <li class="nav-item">
                    <a href="{{ route("admin.orders.index") }}"
                        class="nav-link {{ request()->is('admin/orders') || request()->is('admin/orders/*') ? 'active' : '' }}">
                        <i class="fa-fw fab fa-first-order">

                        </i>
                        <p>
                            <span>{{ trans('cruds.order.title') }}</span>
                        </p>
                    </a>
                </li>
                @endcan
                <li class="nav-item">
                    <a href="#" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt">

                            </i>
                            <span>{{ trans('global.logout') }}</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
