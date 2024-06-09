<div id="sidebar" class="navbar-nav-left sidebar">
  <nav class="navbar navbar-expand-xl">
    <a class="navbar-brand" href="{{ url('/dashboard') }}">
      <img src="{{ asset('public/images/web_logo.png') }}" alt="">
    </a>
    <div class="collapse navbar-collapse" id="sidebar-nav">
      <ul id="accordion" class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="{{ url('/dashboard') }}"><i class="far fa-tachometer-alt-fastest"></i> <span>Dashboard</span></a>
        </li>
        <li class="nav-item menu-list" data-id="subscription">
          <a class="nav-link" data-toggle="collapse" href="#subscription" role="button" aria-expanded="false" aria-controls="subscription">
            <i class="fas fa-hand-holding-usd"></i><span>Subscription</span>
          </a>
          <div class="collapse {{ request()->is('subscription*') ? 'show' : '' }}" id="subscription" data-parent="#accordion">
            <ul class="sub-navbar-nav">
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('subscription/plan')}}"><i class="fas fa-paper-plane"></i> <span>Plans</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('subscription/billing')}}"><i class="fas fa-money-bill"></i> <span>Billings</span></a>
              </li>
            </ul>
          </div>
        </li>
        @if (Auth::user() && Auth::user()->role == App\Models\User::ROLE_ADMIN)
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#services" role="button" aria-expanded="false" aria-controls="services">
            <i class="fas fa-list"></i> <span>Manage</span>
          </a>
          <div class="collapse" id="services" data-parent="#accordion">
            <ul class="sub-navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/logs') }}"><i class="fas fa-key"></i> <span> Logger</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/dashboard/backup') }}"><i class="fas fa-undo"></i> <span> Backup</span></a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ url('/files') }}"><i class="fas fa-file"></i> <span> Files</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/dashboard/users') }}"><i class="fas fa-users"></i> <span> Users</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/settings/') }}"><i class="fas fa-users-cog"></i> <span> Settings</span></a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ url('/notifications') }}"><i class="fas fa-bell"></i> <span> Notifications</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/comment') }}"><i class="fas fa-comment"></i> <span> Comment</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/logActivity') }}"><i class="fas fa-user-clock"></i><span> User History</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/sms') }}"><i class="fas fa-sms"></i> <span> Sms</span></a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-list" data-id="page_management">
          <a class="nav-link" data-toggle="collapse" href="#page" role="button" aria-expanded="false" aria-controls="page">
            <i class="far fa-file-alt"></i><span>Page Management</span>
          </a>
          <div class="collapse" id="page" data-parent="#accordion">
            <ul class="sub-navbar-nav">
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('page')}}"><i class="fas fa-copy"></i> <span>Pages</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('faq')}}"><i class="fas fa-question"></i> <span>Faqs</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('favourite')}}"><i class="fas fa-heart"></i> <span>Favourites</span></a>
              </li>

            </ul>
          </div>
        </li>
        <li class="nav-item menu-list" data-id="stripe">
          <a class="nav-link" data-toggle="collapse" href="#stripe" role="button" aria-expanded="false" aria-controls="stripe">
            <i class="fab fa-cc-stripe"></i> <span>Stripe</span>
          </a>
          <div class="collapse {{ request()->is('stripe*') ? 'show' : '' }}" id="stripe" data-parent="#accordion">
            <ul class="sub-navbar-nav">
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('/stripe/settings/')}}"><i class="fas fa-cog"></i><span>Settings</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('/stripe/')}}"><i class="fas fa-user-check"></i> <span>My details</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('/stripe/cards')}}"><i class="far fa-id-card"></i> <span>Cards</span></a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-list" data-id="blog">
          <a class="nav-link" data-toggle="collapse" href="#blog" role="button" aria-expanded="false" aria-controls="blog">
            <i class="fas fa-blog"></i> <span>Blog</span>
          </a>
          <div class="collapse {{ request()->is('blog*') ? 'show' : '' }}" id="blog" data-parent="#accordion">
            <ul class="sub-navbar-nav">
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('blog/category')}}"><i class="fas fa-universal-access"></i> <span>Category</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('blog/post')}}"><i class="fas fa-inbox"></i> <span>Post</span></a>
              </li>
            </ul>
          </div>
        </li>

        <li class="nav-item menu-list" data-id="seo">
          <a class="nav-link" data-toggle="collapse" href="#seo" role="button" aria-expanded="false" aria-controls="seo">
            <i class="fas fa-key"></i> <span>Seo</span>
          </a>
          <div class="collapse {{ request()->is('seo*') ? 'show' : '' }}" id="seo" data-parent="#accordion">
            <ul class="sub-navbar-nav">
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('seo/')}}"><i class="fas fa-home"></i> <span>Home</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('seo/manager')}}"><i class="fas fa-meteor"></i> <span>Meta</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('seo/analytics')}}"><i class="fas fa-chart-line"></i><span>Analytics</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('seo/redirect')}}"><i class="fas fa-directions"></i> <span>Redirect</span></a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-list" data-id="smtp">
          <a class="nav-link" data-toggle="collapse" href="#smtp" role="button" aria-expanded="false" aria-controls="smtp">
            <i class="fas fa-key"></i> <span>Smtp</span>
          </a>
          <div class="collapse {{ request()->is('smtp*') ? 'show' : '' }}" id="smtp" data-parent="#accordion">
            <ul class="sub-navbar-nav">
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('smtp/home')}}"><i class="fas fa-home"></i> <span>Home</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('smtp/emailQueue')}}"><i class="fas fa-meteor"></i> <span>Email Queue</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('smtp/account')}}"><i class="fas fa-chart-line"></i><span>Account</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('smtp/redirect')}}"><i class="fas fa-directions"></i> <span>Redirect</span></a>
              </li>
            </ul>
          </div>
        </li>

        <li class="nav-item menu-list" data-id="sms">
          <a class="nav-link" data-toggle="collapse" href="#sms" role="button" aria-expanded="false" aria-controls="sms">
            <i class="fas fa-comments"></i><span>SMS</span>
          </a>
          <div class="collapse {{ request()->is('sms*') ? 'show' : '' }}" id="sms" data-parent="#accordion">
            <ul class="sub-navbar-nav">
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('sms/gateway')}}"><i class="fab fa-megaport"></i> <span>Gateway</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('sms/history')}}"><i class="fas fa-history"></i> <span>History</span></a>
              </li>
            </ul>
          </div>
        </li>
        <div id="chat">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/banners') }}"><i class="fas fa-comments"></i> <span>Banners</span></a>
          </li>
        </div>

        <div id="chat">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/chat') }}"><i class="fas fa-comments"></i> <span>Chats</span></a>
          </li>

          <li class="nav-item menu-list" data-id="vendor">
            <a class="nav-link" data-toggle="collapse" href="#vendor" role="button" aria-expanded="false" aria-controls="sms">
              <i class="fas fa-list"></i> <span>Vendors</span>
            </a>
            <div class="collapse {{ request()->is('vendor*') ? 'show' : '' }}" id="vendor" data-parent="#accordion">
              <ul class="sub-navbar-nav">
                <li class="nav-item">
                  <a class="nav-link menu-list-link" href="{{ url('dashboard/vendors')}}"><i class="fas fa-fire"></i> <span>Vendor</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link menu-list-link" href="{{ url('dashboard/file-import')}}"><i class="fas fa-fire"></i> <span>Import</span></a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item menu-list" data-id="catalog">
            <a class="nav-link" data-toggle="collapse" href="#catalog" role="button" aria-expanded="false" aria-controls="sms">
              <i class="fas fa-list"></i> <span>Catalog</span>
            </a>
            <div class="collapse {{ request()->is('catalog*') ? 'show' : '' }}" id="catalog" data-parent="#accordion">
              <ul class="sub-navbar-nav">
                <li class="nav-item">
                  <a class="nav-link menu-list-link" href="{{ url('catalog/category')}}"><i class="fas fa-fire"></i> <span>Category</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link menu-list-link" href="{{ url('catalog/subcategory')}}"><i class="fas fa-fire"></i> <span>SubCategory</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link menu-list-link" href="{{ url('#')}}"><i class="fas fa-fire"></i> <span>Product manage</span></a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item menu-list" data-id="order">
            <a class="nav-link" data-toggle="collapse" href="#order" role="button" aria-expanded="false" aria-controls="sms">
              <i class="fas fa-list"></i> <span>Orders</span>
            </a>
            <div class="collapse {{ request()->is('order*') ? 'show' : '' }}" id="order" data-parent="#accordion">
              <ul class="sub-navbar-nav">
                <li class="nav-item">
                  <a class="nav-link menu-list-link" href="{{ url('dashboard/orders')}}"><i class="fas fa-fire"></i> <span>Active Orders</span></a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item menu-list" data-id="accounting">
            <a class="nav-link" data-toggle="collapse" href="#accounting" role="button" aria-expanded="false" aria-controls="sms">
              <i class="fas fa-list"></i> <span>Accounting</span>
            </a>
            <div class="collapse {{ request()->is('accounting*') ? 'show' : '' }}" id="accounting" data-parent="#accordion">
              <ul class="sub-navbar-nav">
                <li class="nav-item">
                  <a class="nav-link menu-list-link" href="{{ url('dashboard/orders')}}"><i class="fas fa-fire"></i> <span>Orders</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link menu-list-link" href="{{ url('dashboard/promo-code')}}"><i class="fas fa-fire"></i> <span>Promo codes</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link menu-list-link" href="{{ url('dashboard/vendors')}}"><i class="fas fa-fire"></i> <span>Vendors</span></a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item menu-list" data-id="promotion">
            <a class="nav-link" href="{{ url('/dashboard/promotion') }}"><i class="fas fa-fire"></i> <span>Promotions</span></a>
          </li>
          <li class="nav-item menu-list" data-id="drivertag">
            <a class="nav-link" href="{{ url('/dashboard/driver-tag') }}"><i class="fas fa-fire"></i> <span>Driver Tags</span></a>
          </li>
          <li class="nav-item menu-list" data-id="transporttype">
            <a class="nav-link" href="{{ url('/dashboard/transport-type') }}"><i class="fas fa-fire"></i> <span>Transport Type</span></a>
          </li>
          <li class="nav-item menu-list" data-id="vehicletype">
            <a class="nav-link" href="{{ url('/dashboard/vehicle-type') }}"><i class="fas fa-fire"></i> <span>Vehicle Type</span></a>
          </li>
          <li class="nav-item menu-list" data-id="transporttype">
            <a class="nav-link" href="{{ url('/dashboard/team-tag') }}"><i class="fas fa-fire"></i> <span>Team Tags</span></a>
          </li>
          <li class="nav-item menu-list" data-id="customer">
            <a class="nav-link" href="{{ url('/dashboard/team') }}"><i class="fas fa-fire"></i> <span>Teams</span></a>
          </li>
          @elseif (Auth::user() && Auth::user()->role == App\Models\User::ROLE_VENDOR)
          <li class="nav-item menu-list" data-id="driver">
            <a class="nav-link" href="{{ url('/dashboard/driver') }}"><i class="fas fa-fire"></i> <span>Drivers</span></a>
          </li>
          <li class="nav-item menu-list" data-id="customer">
            <a class="nav-link" href="{{ url('/dashboard/customer') }}"><i class="fas fa-fire"></i> <span>Customers</span></a>
          </li>
          @endif
          <div id="chat">
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/chat') }}"><i class="fas fa-comments"></i> <span>Chats</span></a>
            </li>
          </div>
      </ul>
    </div>
    </li>
    </ul>
</div>
</nav>
</div>