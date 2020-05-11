<li class="nav-item {{ Request::is('admin/books*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.books.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Books</span>
    </a>
</li>
<li class="nav-item {{ Request::is('admin/categories*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.categories.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Categories</span>
    </a>
</li>

<li class="nav-item {{ Request::is('admin/users*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('admin.users.index') !!}">
        <i class="nav-icon icon-cursor"></i>
        <span>Users</span>
    </a>
</li>
