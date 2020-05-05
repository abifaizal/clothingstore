<?php 
  $kode_plg = @$_SESSION['kode_plg'];
  $query_krj = "SELECT * FROM tbl_keranjang INNER JOIN tbl_keranjangdetail ON tbl_keranjang.id_keranjang = tbl_keranjangdetail.id_keranjang INNER JOIN tbl_produk ON tbl_keranjangdetail.id_prd = tbl_produk.id_prd WHERE tbl_keranjang.kode_plg = '$kode_plg'";
  $sql_krj = mysqli_query($conn, $query_krj) or die ($conn->error);
  $rows = mysqli_num_rows($sql_krj);
  if($rows>0) {
 ?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="./">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
  </ol>
</nav>
<div class="kontainer-keranjang">
  <div class="table-responsive">
    <table class="table tabel-keranjang">
      <thead>
        <tr>
          <th>Gambar</th>
          <th>Produk</th>
          <th>Ukuran</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Total Harga</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
      <?php 
        $total = 0;
        // $baris = 0;
        while($data_krj = mysqli_fetch_array($sql_krj)) {
          // $baris++;
          $baris = $data_krj['id_krjdt'];
      ?>
        <tr>
          <td width="15%">
            <div class="foto-produk">
              <img src="img/produk/<?php echo $data_krj['gambar_prd']; ?>" class="card-img-top" alt="...">
            </div>
          </td>
          <td>
            <?php echo $data_krj['nama_prd']; ?>
          </td>
          <td>
            <?php 
              $id_prd = $data_krj['id_prd'];
              $id_ukuran = $data_krj['id_ukuran'];
              $query_ukuran = "SELECT * FROM tbl_ukuranprd WHERE id_prd = '$id_prd' AND stok_ukr > 0";
              $sql_ukuran = mysqli_query($conn, $query_ukuran) or die ($conn->error);
            ?>
            <select class="form-control form-control-sm pilih_ukuran" id="pilih_ukuran<?php echo $baris; ?>" name="pilih_ukuran" data-baris="<?php echo $baris; ?>">
            <?php 
              while($data_ukuran = mysqli_fetch_array($sql_ukuran)) {
            ?>
                <option value="<?php echo $data_ukuran['id_ukuran']; ?>" data-stok="<?php echo $data_ukuran['stok_ukr']; ?>" 
                  <?php if($id_ukuran == $data_ukuran['id_ukuran']) {
                    echo "selected";
                    $stok_prd = $data_ukuran['stok_ukr'];
                  } ?>>
                    <?php echo $data_ukuran['keterangan_ukr']; ?>
                </option>
            <?php } ?>
            </select>
          </td>
          <td>
            <?php 
              $harga_prd = $data_krj['harga_prd'];
              $diskon_prd = $data_krj['diskon_prd'];
              $harga_akhir = $harga_prd - ($harga_prd * ($diskon_prd / 100));
            ?>
            Rp <span id="harga_prd<?php echo $baris; ?>"><?php echo $harga_akhir; ?></span> <br>
            <?php if($data_krj['diskon_prd']) { ?>
              <span style="font-size: 10px;">(<del><?php echo number_format($harga_prd); ?></del>)</span>
            <?php } ?>
          </td>
          <td>
            <input class="form-control form-control-sm jml_prd" type="number" id="jml_prd<?php echo $baris; ?>" name="jml_prd" value="<?php echo $data_krj['jml_prd']; ?>" data-baris="<?php echo $baris; ?>">
            <small id="passwordHelpBlock" class="form-text text-muted">
              tersisa <span id="stok<?php echo $baris; ?>"> <?php echo $stok_prd; ?></span> buah
            </small>
          </td>
          <td>
            <?php 
              $jml_prd = $data_krj['jml_prd'];
              $subtotal = $harga_akhir * $jml_prd;
            ?>
            <b>Rp <span class="subtotal" id="subtotal<?php echo $baris; ?>"><?php echo $subtotal; ?></span></b>
          </td>
          <td>
            <button type="button" class="btn btn-danger btn-sm tmb_hapus" name="tmb_hapus" id="<?php echo $data_krj['id_krjdt']; ?>">hapus</button>
          </td>
          <?php 
            $total = $total + $subtotal;
          ?>
        </tr>
      <?php } ?>
      </tbody>
    </table>
  </div>
  <div class="total-belanja">
    <div class="total-semua">
      total belanja <span>Rp <span id="total_belanja"><?php echo $total; ?></span></span>
    </div>
    <!-- <div class="total-diskon">
      diskon 10% <span>Rp 20.000</span>
    </div> -->
    <div class="total-akhir">
      total akhir <span>Rp <span id="total_akhir"><?php echo $total; ?></span></span>
    </div>
    <a href="?page=pemesanan">
      <button type="button" class="btn btn-dark">Lanjutkan Pemesanan</button>
    </a>
  </div>
</div>

<script>
  $(".pilih_ukuran").change(function() {
    var baris = $(this).data('baris');
    var harga = Number($("#harga_prd"+baris).text());
    var id_ukuran = $(this).val();
    var stok = $(this).find(':selected').data('stok');
    $("#stok"+baris).text(stok);
    $("#jml_prd"+baris).val('1');
    $("#subtotal"+baris).text(harga);
    total();

    $.ajax({
      type: "POST",
      url: "usrajax/edit_keranjang.php?page=ukuran",
      data: "id_krjdt="+baris+"&id_ukuran="+id_ukuran,
      success: function(hasil_ukuran) {}
    });

    edit_jml(baris);
  })

  function subtotal(baris) {
    var harga = Number($("#harga_prd"+baris).text());
    var jml_beli = Number($("#jml_prd"+baris).val());
    var total = harga * jml_beli;
    $("#subtotal"+baris).text(total);
  }

  function total() {
    var sum = 0;
    $('.subtotal').each(function() {
      var num = $(this).text();
      if(num > 0) {
        sum += parseInt(num);
      }
    });
    $("#total_belanja").text(sum);
    $("#total_akhir").text(sum);
  }

  function cek_jumlah(baris) {
    var jml_beli = Number($("#jml_prd"+baris).val());
    var stok = Number($("#stok"+baris).text());
    if(jml_beli<=0) {
      $("#jml_prd"+baris).val('1');
    } else if(jml_beli>stok) {
      $("#jml_prd"+baris).val(stok);
    }
  }

  function edit_jml(baris) {
    var jml_beli = Number($("#jml_prd"+baris).val());
    $.ajax({
      type: "POST",
      url: "usrajax/edit_keranjang.php?page=jml_beli",
      data: "id_krjdt="+baris+"&jml_beli="+jml_beli,
      success: function(hasil_jumlah) {}
    });
  }

  $(".jml_prd").change(function() {
    var baris = $(this).data('baris');
    cek_jumlah(baris);
    subtotal(baris);
    total();
    edit_jml(baris);
  })
  $(".jml_prd").keyup(function() {
    var baris = $(this).data('baris');
    cek_jumlah(baris);
    subtotal(baris);
    total();
    edit_jml(baris);
  })

  $(".tmb_hapus").click(function() {
    var id_krjdt = $(this).attr('id');
    Swal.fire({
      title: 'Apakah Anda Yakin?',
      text: 'anda tidak dapat mengembalikan data yang telah dihapus',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya'
    }).then((hapus) => {
      if (hapus.value) {
        $.ajax({
          type: "POST",
          url: "usrajax/edit_keranjang.php?page=hapus",
          data: "id_krjdt="+id_krjdt,
          success: function(hasil_hapus) {
            location.reload();
          }
        }); 
      }
    })
  })
</script>

<?php } else { ?>
  <script>
    window.location="./";
  </script>
<?php } ?>