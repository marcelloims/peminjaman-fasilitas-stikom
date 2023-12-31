<li>
    <a href="{{ url('sarpras/dashboard', []) }}">
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
        <li><a href="{{ url('sarpras/organisasi-mahasiswa', []) }}">Organisasi Mahasiswa</a></li>
        <li><a href="{{ url('sarpras/mahasiswa', []) }}">Mahasiswa</a></li>
        <li><a href="{{ url('sarpras/alat', []) }}">Alat-alat</a></li>
        <li><a href="{{ url('sarpras/fasilitas', []) }}">Fasilitas</a></li>
    </ul>
</li>
<li>
    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
        <i class="flaticon-381-back"></i>
        <span class="nav-text">Persetujuan</span>
    </a>
    <ul aria-expanded="false">
        <li><a href="{{ url('sarpras/persetujuan/alat', []) }}">Peminjaman Alat</a></li>
        <li><a href="{{ url('sarpras/persetujuan/aula', []) }}">Peminjaman Kelas</a></li>
    </ul>
</li>
<li>
    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
        <i class="flaticon-381-back"></i>
        <span class="nav-text">Laporan</span>
    </a>
    <ul aria-expanded="false">
        <li><a href="{{ url('#', []) }}">Pengajuan</a></li>
        <li><a href="{{ url('#', []) }}">Alat-Alat</a></li>
        <li><a href="{{ url('#', []) }}">Fasilitas</a></li>
    </ul>
</li>
