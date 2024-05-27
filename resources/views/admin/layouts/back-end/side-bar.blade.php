<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('backend/assets/images/logo-sm.png')}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('backend/assets/images/logo-dark.png')}}" alt="" height="17">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('backend/assets/images/logo-sm.png')}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('backend/assets/images/logo-light.png')}}" alt="" height="17">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div class="dropdown sidebar-user m-1 rounded">
                <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="d-flex align-items-center gap-2">
                        <img class="rounded header-profile-user" src="assets/images/users/avatar-1.jpg" alt="Header Avatar">
                        <span class="text-start">
                            <span class="d-block fw-medium sidebar-user-name-text">Anna Adame</span>
                    <span class="d-block fs-14 sidebar-user-name-sub-text"><i class="ri ri-circle-fill fs-10 text-success align-baseline"></i> <span class="align-middle">Online</span></span>
                    </span>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <h6 class="dropdown-header">Welcome Anna!</h6>
                    <a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                    <a class="dropdown-item" href="apps-chat.html"><i class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Messages</span></a>
                    <a class="dropdown-item" href="apps-tasks-kanban.html"><i class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Taskboard</span></a>
                    <a class="dropdown-item" href="pages-faqs.html"><i class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Help</span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Balance : <b>$5971.67</b></span></a>
                    <a class="dropdown-item" href="pages-profile-settings.html"><span class="badge bg-success-subtle text-success mt-1 float-end">New</span><i class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Settings</span></a>
                    <a class="dropdown-item" href="auth-lockscreen-basic.html"><i class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Lock screen</span></a>
                    <a class="dropdown-item" href="auth-logout-basic.html"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                </div>
            </div>
            <div id="scrollbar">
                <div class="container-fluid">


                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{Request::is('admin/dashboard')?'active':''}}" href="{{route('admin_dashboard')}}">
                              <i class="ri-dashboard-2-line"></i> <span data-key="t-widgets">Dashboards</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{Request::is('admin/customer/list')?'collapsed active':''}}" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="ri-account-circle-line"></i> <span data-key="t-dashboards">User Management</span>
                            </a>
                            <div class="collapse menu-dropdown {{Request::is('admin/customer/list')|| Request::is('admin/astrologer/list')?'show':''}}" id="sidebarDashboards">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('customer.list')}}" class="nav-link {{Request::is('admin/customer/list')?'active':''}}" data-key="t-analytics"> Customer </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('astrologer.list')}}" class="nav-link {{Request::is('admin/astrologer/list')?'active':''}}" data-key="t-crm"> Astrologoer </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{Request::is('admin/skill*')?'active':''}}" href="{{route('skill.list')}}">
                              <i class="ri-file-list-2-line"></i> <span data-key="t-widgets">Skills</span>
                            </a>
                        </li>
                        <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Product Management</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{Request::is('admin/category*')?'active':''}}" href="{{route('category.list')}}">
                              <i class="ri-file-list-2-line"></i> <span data-key="t-widgets">Categories</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{Request::is('admin/product*')?'active':''}}" href="{{route('product.list')}}">
                              <i class="ri-list-check-2"></i> <span data-key="t-widgets">Products</span>
                            </a>
                        </li>
                        <hr>
                        <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Order Management</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{Request::is('admin/order*')?'active':''}}" href="{{route('order.list')}}">
                             <i class="ri-shopping-cart-2-line"></i> <span data-key="t-widgets">Orders</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{Request::is('admin/service*')?'active':''}}" href="{{route('service.list')}}">
                              <i class="ri-list-check-2"></i> <span data-key="t-widgets">Services</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{Request::is('admin/horoscope*')?'collapsed active':''}}" href="#sidebarhoroscope" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class=" ri-book-open-line"></i> <span data-key="t-dashboards">Horoscope</span>
                            </a>
                            <div class="collapse menu-dropdown {{Request::is('admin/horoscope/zodiac/list')?'show':''}}" id="sidebarhoroscope">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('horoscope.zodiac.list')}}" class="nav-link {{Request::is('admin/horoscope/zodiac/list')?'active':''}}" data-key="t-analytics">Zodiac Sign</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('horoscope.view')}}" class="nav-link {{Request::is('admin/horoscope/view')?'active':''}}" data-key="t-analytics">Weekly, Monthly & Yearly Horoscope</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('horoscope.dailyHoroscope')}}" class="nav-link {{Request::is('admin/horoscope/dailyHoroscope')?'active':''}}" data-key="t-analytics">Daily Horoscope</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{Request::is('admin/setting')?'active':''}}" href="{{route('setting')}}">
                              <i class="ri-settings-5-line"></i> <span data-key="t-widgets">Settings</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>