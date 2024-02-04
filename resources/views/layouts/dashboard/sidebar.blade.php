<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Link-slicer</div>
    </a>

    <hr class="sidebar-divider">

    <li class="nav-item active">
        <a class="nav-link" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
            aria-controls="collapsePages" style="cursor: pointer; user-select: none">
            <i class="fas fa-fw fa-folder"></i>
            <span>Links</span>
        </a>
        <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('links.view') }}">My Links</a>
                <a class="collapse-item" href="{{ route('links.create.view') }}">Create Link</a>
                <a class="collapse-item" href="{{ route('links.edit.view') }}">Edit Link</a>
                <a class="collapse-item" href="{{ route('links.delete.view') }}">Delete link</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
