<li>
    <a href="{{ url('akademik_kemahasiswaan/dashboard', []) }}">
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
        <li><a href="{{ url('akademik_kemahasiswaan/organisasi-mahasiswa', []) }}">Organisasi Mahasiswa</a></li>
        <li><a href="{{ url('akademik_kemahasiswaan/mahasiswa', []) }}">Mahasiswa</a></li>
        <li><a href="{{ url('akademik_kemahasiswaan/fasilitas', []) }}">Fasilitas</a></li>
    </ul>
</li>
<li>
    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
        <i class="flaticon-381-back"></i>
        <span class="nav-text">Pengajuan</span>
    </a>
    <ul aria-expanded="false">
        <li><a href="{{ url('#', []) }}">Surat Pengajuan</a></li>
        <li><a href="{{ url('#', []) }}">Peminjaman Alat</a></li>
        <li><a href="{{ url('#', []) }}">Peminjaman Fasilitas</a></li>
    </ul>
</li>
