<div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
        <ul class="nav nav-secondary">
            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                <a href="/">
                    <i class="fas fa-home"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-section">
                <span class="sidebar-mini-icon">
                    <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Components</h4>
            </li>
            @can('admin')
                <li class="nav-item {{ Request::is('diseases*') ? 'active' : '' }}">
                    <a href="{{ route('diseases.index') }}">
                        <i class="fas fa-thermometer-quarter"></i>
                        <p>Data Penyakit</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('symptoms*') ? 'active' : '' }}">
                    <a href="{{ route('symptoms.index') }}">
                        <i class="fas fa-asterisk"></i>
                        <p>Gejala</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('knowledgebases*') ? 'active' : '' }}">
                    <a href="{{ route('knowledgebases.index') }}">
                        <i class="fas fa-book-reader"></i>
                        <p>Basis Pengetahuan</p>
                    </a>
                </li>
            @endcan
            @can('user')
                <li class="nav-item {{ Request::is('consultation') ? 'active' : '' }}">
                    <a href="{{ route('consultation.index') }}">
                        <i class="fas fa-check-double"></i>
                        <p>Konsultasi</p>
                    </a>
                </li>
            @endcan
            <li class="nav-item {{ Request::is('consultation/result*') ? 'active' : '' }}">
                <a href="{{ route('consultation.result') }}">
                    <i class="fas fa-clock"></i>
                    <p>Riwayat Diagnosa</p>
                </a>
            </li>

        </ul>
    </div>
</div>
