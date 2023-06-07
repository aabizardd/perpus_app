<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">

                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                @foreach (getUserMenu(Auth::user()->role) as $item)
                    <li class="sidebar-item  @if (Request::segment(1) == strtolower($item->url)) active @endif">
                        <a href="{{ route($item->url) }}" class="sidebar-link">
                            <i class="{{ $item->icon }}"></i>
                            <span>{{ $item->menu }}</span>
                        </a>
                    </li>
                @endforeach




            </ul>
        </div>
        <button class="sidebar-toggler btn x">
            <i data-feather="x"></i>
        </button>
    </div>
</div>
