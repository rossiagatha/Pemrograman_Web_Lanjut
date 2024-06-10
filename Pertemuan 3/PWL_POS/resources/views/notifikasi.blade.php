<div class="dropdown-menu" aria-labelledby="navbarDropdown">
    <!-- Pengguna Belum Tervalidasi -->
    <h6 class="dropdown-header">Pengguna Belum Tervalidasi</h6>
    @foreach($members as $user)
        <a class="dropdown-item" href="#">{{ $user->username }} belum tervalidasi</a>
    @endforeach
</div>