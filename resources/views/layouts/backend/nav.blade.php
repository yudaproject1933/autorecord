<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Traffic</div>
                <a class="nav-link" href="/dashboard">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

            @if (in_array(Auth::user()->role, ['admin']))
                <div class="sb-sidenav-menu-heading">Transaction</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-cart-arrow-down"></i></div>
                    Payments
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="/payment">Paypal</a>
                        <a class="nav-link" href="layout-sidenav-light.html">Bitcoin</a>
                    </nav>
                </div>
            @endif

            @if (in_array(Auth::user()->role, ['admin','employee']))
                <div class="sb-sidenav-menu-heading">Work</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts2">
                    <div class="sb-nav-link-icon"><i class="fas fa-tasks"></i></div>
                    Phone Number
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        @if (in_array(Auth::user()->role, ['admin']))
                        <a class="nav-link" href="/task">List Phone Number</a>
                        <a class="nav-link" href="/task-phone-number">Your Task</a>
                        @else
                        <a class="nav-link" href="/task-phone-number">Your Task</a>
                        @endif
                    </nav>
                </div>
            @endif

            @if (in_array(Auth::user()->role, ['admin','user']))
                <div class="sb-sidenav-menu-heading">Documents</div>
                <a class="nav-link" href="charts.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                    Report
                </a>
            @endif

                <div class="sb-sidenav-menu-heading">Help</div>
                <a class="nav-link" href="/contact">
                    <div class="sb-nav-link-icon"><i class="fas fa-phone"></i></div>
                    Contact Us
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>