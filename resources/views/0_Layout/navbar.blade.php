<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a href="/" class="nav-link">
        <i class="nav-icon fas fa-shopping-cart"></i>
        <p>Input Penjualan</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('riwayat_penjualan.index') }}" class="nav-link">
        <i class="nav-icon fas fa-list-alt"></i>
        <p>Riwayat Penjualan</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('stok_barang.index') }}" class="nav-link">
        <i class="nav-icon fas fa-box-open"></i>
        <p>Stok Barang</p>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link customer">
        <i class="nav-icon fas fa-smile-beam"></i>
        <p>Data Customer</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('redeem_poin.index') }}" class="nav-link">
        <i class="nav-icon fas fa-gift"></i>
        <p>Redeem Poin</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('riwayat_redeem.index') }}" class="nav-link">
        <i class="nav-icon fas fa-list"></i>
        <p>Riwayat Redeem</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('stok_hadiah.index') }}" class="nav-link">
        <i class="nav-icon fas fa-heart"></i>
        <p>Stok Hadiah</p>
      </a>
    </li>
  </ul>
</nav>

<script>
  var customerElement = document.querySelector('.customer');

  customerElement.addEventListener('click', function() {
    var namaAnda = prompt('Masukkan password:');
  
    if (namaAnda === 'tokosususuhen') {
      window.location.href = '{{ route('data_customer.index') }}';
    } else {
      alert("Anda tidak memiliki akses");
      window.location.href = '/';
    }
  });
</script>