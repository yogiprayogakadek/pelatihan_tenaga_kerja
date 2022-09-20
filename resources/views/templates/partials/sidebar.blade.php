<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <div class="navigation-left">
            <li class="nav-item {{Request::is('/') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{route('dashboard')}}">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <div class="triangle"></div>
            </li>
            @can('admin')
                <li class="nav-item {{Request::is('class') ? 'active' : '' }}">
                    <a class="nav-item-hold" href="{{route('class.index')}}">
                        <i class="nav-icon i-Computer-Secure"></i>
                        <span class="nav-text">Class</span>
                    </a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item {{Request::is('assessor') ? 'active' : '' }}">
                    <a class="nav-item-hold" href="{{route('assessor.index')}}">
                        <i class="nav-icon i-Administrator"></i>
                        <span class="nav-text">Assessor</span>
                    </a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item {{Request::is('participant') ? 'active' : '' }}">
                    <a class="nav-item-hold" href="{{route('participant.index')}}">
                        <i class="nav-icon i-Business-ManWoman"></i>
                        <span class="nav-text">Participant</span>
                    </a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item {{Request::is('announcement') ? 'active' : '' }}">
                    <a class="nav-item-hold" href="{{route('announcement.index')}}">
                        <i class="nav-icon i-File-Horizontal-Text"></i>
                        <span class="nav-text">Announcement</span>
                    </a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item {{Request::is('assessment') ? 'active' : '' }}">
                    <a class="nav-item-hold" href="{{route('assessment.index')}}">
                        <i class="nav-icon i-Pen-2"></i>
                        <span class="nav-text">Assessment</span>
                    </a>
                    <div class="triangle"></div>
                </li>
            @endcan
            @can('participant')
            <li class="nav-item {{Request::is('participant/document') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{route('participant.document')}}">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="nav-text">Document</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{Request::is('payment') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{route('payment.index')}}">
                    <i class="nav-icon i-Billing"></i>
                    <span class="nav-text">Payment</span>
                </a>
                <div class="triangle"></div>
            </li>
            @endcan
        </div>
    </div>
    <div class="sidebar-overlay"></div>
</div>