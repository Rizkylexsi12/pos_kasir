<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li class="nav-item">
      <a href="/" class="nav-link">
        <i class="nav-icon fas fa-shopping-cart"></i>
        <p>Input Penjualan</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/riwayat_penjualan" class="nav-link">
        <i class="nav-icon far fa-list-alt"></i>
        <p>Riwayat Penjualan</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/stok_barang" class="nav-link">
        <i class="nav-icon fas fa-box-open"></i>
        <p>Stok Barang</p>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link customer">
        <i class="nav-icon far fa-smile-beam"></i>
        <p>Data Customer</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/redeem_poin" class="nav-link">
        <i class="nav-icon fas fa-gift"></i>
        <p>Redeem Poin</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/riwayat_redeem_poin" class="nav-link">
        <i class="nav-icon fas fa-gift"></i>
        <p>Riwayat Redeem</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/stok_hadiah" class="nav-link">
        <i class="nav-icon fas fa-gift"></i>
        <p>Stok Hadiah</p>
      </a>
    </li>
  </ul>
</nav>

<script>
  var customerElement = document.querySelector('.customer');

  customerElement.addEventListener('click', function() {
    var namaAnda = prompt('Masukkan password:');
  
    if (namaAnda === 'lexsi') {
      window.location.href = '/data_customer';
    } else {
      alert("Anda tidak memiliki akses");
      window.location.href = '/';
    }
  });
</script>