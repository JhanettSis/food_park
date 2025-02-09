<nav class="navbar navbar-expand-lg main-navbar">
    {{-- ==========  Start NAVBAR  =======================================
                Button navbar  --}}
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
    </form>

    <ul class="navbar-nav navbar-right">
        {{-- Variables for adding notifications and notification Chats --}}
        @php
            $notifications = \App\Models\OrderPlacedNotification::where('seen', true)
                ->latest()
                ->take(10)
                ->get();
            $unseenMessages = \App\Models\Chat::where(['receiver_id' => Auth::user()->id, 'seen' => true])->count();
        @endphp
        @if (Auth::user()->role === 'admin')
            <li class="dropdown dropdown-list-toggle">
                <a href="{{ route('admin.chat.index') }}"
                    class="nav-link nav-link-lg message-envelope {{ $unseenMessages > 0 ? 'beep' : '' }}"><i
                        class="far fa-envelope"></i></a>
            </li>
        @endif

        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                class="nav-link notification-toggle nav-link-lg notification_beep {{ count($notifications) > 0 ? 'beep' : '' }}"><i
                    class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Notifications
                    <div class="float-right">
                        <a href="{{ route('admin.clear-notification') }}">Mark All As Read</a>
                    </div>
                </div>
                <div class="dropdown-list-content dropdown-list-icons rt_notification">
                    @foreach ($notifications as $notification)
                        <a href="{{ route('admin.orders.show', $notification->order_id) }}" class="dropdown-item">
                            <div class="dropdown-item-icon bg-info text-white">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="dropdown-item-desc">
                                {{ $notification->message }}
                                <div class="time">{{ date('h:i A | d-F-Y', strtotime($notification->created_at)) }}
                                </div>
                            </div>
                        </a>
                    @endforeach

                </div>
                <div class="dropdown-footer text-center">
                    <a href="{{ route('admin.orders.index') }}">View All <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </li>

        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                {{-- The code {{ Auth::user()->avatar }} is adding, It displays a user photo from the database  --}}
                <img alt="image" src="{{ asset(Auth::user()->avatar) }}" class="rounded-circle mr-1">
                {{-- The code {{ Auth::user()->name }} is adding, It displays a user name from the database  --}}
                <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Logged in 5 min ago</div>
                <a href="{{ route('admin.profile') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <a href="{{ route('admin.setting.index') }}" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();"
                        class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </form>

            </div>
        </li>
    </ul>
</nav>
{{-- ========  End NAVBAR  ======================================= --}}

{{-- =========  Start SIDEBAR  ========================================= --}}
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        {{-- Start Section name --}}
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">{{config('settings.site_name')}}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        {{-- End Section name --}}

        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown active">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-rss"></i>
                    <span> Blog </span></a>
                <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('admin.blog-category.index') }}">Blog Categories</a></li>
                        <li><a class="nav-link" href="{{ route('admin.blogs.index') }}">All Blogs</a></li>
                        <li><a class="nav-link" href="{{ route('admin.blogs.comments.index') }}">Comments</a></li>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Starter</li>
            <li>
                <a class="nav-link" href="{{ route('admin.slider.index') }}"><i
                        class="far fa-square"></i><span>Silder</span></a>
            </li>
            <li><a class="nav-link" href="{{ route('admin.daily-offer.index') }}"><i class="far fa-clock"></i>
                <span>Daily Offer</span></a></li>
            <li>
                <a class="nav-link" href="{{ route('admin.banner_slider.index') }}">
                    <i class="far fa-square"></i><span>Banner Slider</span></a></li>
            <li>
                <a class="nav-link" href="{{ route('admin.why_choose_us.index') }}"><i
                    class="far fa-square"></i><span>Why Choose Us</span></a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('admin.chefs.index') }}"><i
                    class="far fa-square"></i><span>Chefs</span></a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('admin.counter.index') }}"><i
                    class="far fa-square"></i><span>Counters</span></a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('admin.testimonials.index') }}"><i
                    class="far fa-square"></i><span>Testimonials</span></a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('admin.app_download.index') }}"><i
                    class="far fa-square"></i><span>App Download Section</span></a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('admin.about.index') }}"><i
                    class="far fa-square"></i><span>About</span></a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('admin.privacy_policy.index') }}">
                    <i class="far fa-square"></i><span>Privacy Policy</span></a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('admin.terms_and_conditions.index') }}">
                    <i class="far fa-square"></i><span>Terms & Conditions</span></a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('admin.reservation-time.index') }}">
                    <i class="far fa-square"></i><span>Reservation Times</span></a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('admin.reservation.index') }}">
                    <i class="far fa-square"></i><span>Reservation</span></a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('admin.contact.index') }}"><i
                    class="far fa-square"></i><span>Contact</span></a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('admin.news_letter.index') }}"><i
                    class="far fa-square"></i><span>News Letter</span></a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('admin.social_link.index') }}"><i
                    class="far fa-square"></i><span>Social Link</span></a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('admin.menu_builder.index') }}"><i
                    class="far fa-square"></i><span>Menu Builder</span></a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('admin.custom-page-builder.index') }}"><i
                    class="far fa-square"></i><span>Page Builder</span></a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('admin.footer_info.index') }}"><i
                    class="far fa-square"></i><span>Footer Info</span></a>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Manage Restaurant</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.categories.index') }}">Product Categories</a></li>
                    <li><a class="nav-link" href="{{ route('admin.products.index') }}">Products</a></li>
                    <li><a class="nav-link" href="{{ route('admin.product-reviews.index') }}">Product Reviews</a>
                    </li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Manage Ecommerce</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.coupons.index') }}">Coupon</a></li>
                    <li><a class="nav-link" href="{{ route('admin.delivery_areas.index') }}">Delivery Areas</a></li>
                    <li>
                        <a class="nav-link" href="{{ route('admin.payment-setting.index') }}">Payment Gateways</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Manage Orders</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.orders.index') }}">All Orders</a></li>
                    <li><a class="nav-link" href="{{ route('admin.pending-orders') }}">Pending Orders</a></li>
                    <li><a class="nav-link" href="{{ route('admin.inprocess-orders') }}">In Process Orders</a></li>
                    <li><a class="nav-link" href="{{ route('admin.delivered-orders') }}">Delivered Orders</a></li>
                    <li><a class="nav-link" href="{{ route('admin.declined-orders') }}">Decliend Orders</a></li>
                </ul>
            </li>
            @if (Auth::user()->id === 1)
                <li>
                    <a class="nav-link" href="{{ route('admin.chat.index') }}">
                        <i class="fas fa-comment-dots"></i>
                        <span>Messages</span></a></li>
            @endif
            <li>
                <a class="nav-link" href="{{ route('admin.setting.index') }}">
                    <i class="far fa-square"></i><span>Settings</span></a>
            </li>
        </ul>
    </aside>
</div>
