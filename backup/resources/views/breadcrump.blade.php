<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <h1 class="page-title fw-semibold fs-18 mb-0">@yield('title', $page_title ?? '')</h1>
    <div class="ms-md-1 ms-0">
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Ana Sayfa</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('title', $page_title ?? '')</li>
            </ol>
        </nav>
    </div>
</div>