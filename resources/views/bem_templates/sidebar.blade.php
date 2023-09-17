<li>
    <a href="{{ url('bem/dashboard', []) }}">
        <i class="flaticon-381-back"></i>
        <span class="nav-text">Dashboard</span>
    </a>
</li>
<li>
    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
        <i class="flaticon-381-back"></i>
        <span class="nav-text">Properti</span>
    </a>
    <ul aria-expanded="false">
        <li><a href="{{ url('bem/organisasi-mahasiswa', []) }}">Organisasi Mahasiswa</a></li>
        <li><a href="{{ url('bem/mahasiswa', []) }}">Mahasiswa</a></li>
    </ul>
</li>
<li>
    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
        <i class="flaticon-381-back"></i>
        <span class="nav-text">Pengajuan</span>
    </a>
    <ul aria-expanded="false">
        <li><a href="{{ url('bem/persetujuan/alat', []) }}">Peminjaman Alat</a></li>
        <li><a href="{{ url('bem/persetujuan/aula', []) }}">Peminjaman Aula</a></li>
    </ul>
</li>
