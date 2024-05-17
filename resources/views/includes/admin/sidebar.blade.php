<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html"> <img alt="image" src="/admin/assets/img/logo.png" class="header-logo" /> <span
            class="logo-name">Otika</span>
        </a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Main</li>
        <li class="dropdown {{ Request::route()->getName() === 'dashboard' ? 'active' : '' }}">
          <a href="{{ route('dashboard') }}" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
        </li>
        <li class="dropdown 
        {{ Request::route()->getName() === 'admin.pages.index' || 
           Request::route()->getName() === 'admin.pages.edit' ||
           Request::route()->getName() === 'admin.pages.show' ||
           Request::route()->getName() === 'admin.pages.create' ? 'active' : '' 
          }}">
          <a href="{{ route('admin.pages.index') }}" class="nav-link"><i data-feather="monitor"></i><span>Pages</span></a>
        </li>
        <li class="dropdown 
        {{ Request::route()->getName() === 'admin.categories.index' || 
           Request::route()->getName() === 'admin.categories.edit' ||
           Request::route()->getName() === 'admin.categories.show' ||
           Request::route()->getName() === 'admin.categories.create' ? 'active' : '' 
          }}">
          <a href="admin.categories.index" class="nav-link"><i data-feather="monitor"></i><span>Categories</span></a>
        </li>
        <li class="dropdown 
        {{ Request::route()->getName() === 'admin.products.index' || 
           Request::route()->getName() === 'admin.products.edit' ||
           Request::route()->getName() === 'admin.products.show' ||
           Request::route()->getName() === 'admin.products.create' ? 'active' : '' 
          }}">
          <a href="admin.products.index" class="nav-link"><i data-feather="monitor"></i><span>Products</span></a>
        </li>
        {{-- <li class="dropdown">
            <a href="{{ route('admin.tags.index') }}" class="nav-link"><i data-feather="monitor"></i><span>Products</span></a>
          </li> --}}
      </ul>
    </aside>
  </div>