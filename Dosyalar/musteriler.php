<?php 
include'header.php' 
?>

<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<style type="text/css" media="screen">
  @media only screen and (max-width: 700px) {
    .mobilgizle {
      display: none;
    }
    .mobilgizleexport {
      display: none;
    }
    .mobilgoster {
      display: block;
    }
  }
  @media only screen and (min-width: 700px) {
    .mobilgizleexport {
      display: flex;
    }
    .mobilgizle {
      display: block;
    }
    .mobilgoster {
      display: none;
    }
  }
</style>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- DataTales Giriş -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Müşteriler</h6>
    </div>
    <div class="card-body" style="width: 100%">
      <span class="dropdown no-arrow">
       <button data-toggle="dropdown" aria-expanded="false" type="button" id="aktarmagizleme" style="margin-left: 4px;" class="btn btn-sm btn-primary icon-split dropdown-toggle">
        <span class="icon text-white-65">
          <i class="fas fa-file-export"></i>
        </span>
        <span class="text">Dışa Aktar</span>
      </button>  

      <div class="dropdown-menu" aria-labelledby="aktarmagizleme">
        <a class="dropdown-item" href="#">
          <button type="button" onclick="fnAction('copy');" title="asdsad" attr="Tabloyu Kopyala" class="btn btn-sm icon-split btn-dark">
            <span class="icon text-white-65">
              <i class="fas fa-copy"></i>
            </span>
            <span class="text">Kopyala</span>
          </button>
        </a>

        <a class="dropdown-item" title="">
          <button type="button" onclick="fnAction('excel');" attr="Excel Formatında Dışa Aktar" class="btn btn-sm icon-split btn-success">
            <span class="icon text-white-65">
              <i class="fas fa-file-excel"></i>
            </span>
            <span class="text">Excel</span>
          </button>
        </a>

        <a class="dropdown-item" href="#">
          <button type="button" onclick="fnAction('pdf');" attr="PDF Formatında Dışa Aktar" class="btn btn-sm icon-split btn-danger"><span class="icon text-white-65">
            <i class="fas fa-file-pdf"></i>
          </span>
          <span class="text">PDF</span>
        </button>
      </a>

      <a class="dropdown-item" href="#">
        <button type="button" onclick="fnAction('csv');" attr="CSV Formatında Dışa Aktar" class="btn btn-sm icon-split btn-primary">
          <span class="icon text-white-65">
            <i class="fas fa-file-csv"></i>
          </span>
          <span class="text">CSV</span>
        </button>
      </a>
    </div>
  </span>
<!-- 
	Bu Script Aksoyhlc Tarafından Hazırlanmıştır "Ökkeş AKsoy | Aksoyhlc" 
	Ticari amaçla KULLANILAMAZ
	Satışı YAPILAMAZ
	Paylaşırken KAYNAK BELİRTMENİZ GEREKİYOR
	-->
  <a href="musteriekle.php">
   <button type="button" class="btn btn-sm btn-success icon-split">
    <span class="icon text-white-65">
      <i class="fas fa-plus"></i>
    </span>
    <span class="text">Ekle</span>           
  </button>
</a>

<div class="table-responsive mt-3">
  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr> 
        <th>No</th>
        <th>Müşteri Adı</th>             
        <th>Müşteri Telefon</th>
        <th>Müşteri Mail</th>
        <th>İşlem</th>
      </tr>
    </thead>
    <!--While döngüsü ile veritabanında ki verilerin tabloya çekilme işlemi giriş-->
    <tbody>
     <?php 
     $say=0;
     $musterisor=$db->prepare("SELECT * FROM musteri");
     $musterisor->execute();
     while ($mustericek=$musterisor->fetch(PDO::FETCH_ASSOC)) { $say++?>

       <tr>
        <td><?php echo $say; ?></td>
        <td><?php echo $mustericek['musteri_adi']; ?></td>            
        <td><?php echo $mustericek['musteri_telefon']; ?></td>
        <td><?php echo $mustericek['musteri_mail']; ?></td>
        <td>
         <div class="d-flex justify-content-center">
          <form action="musteriduzenle.php" method="POST">
            <input type="hidden" name="musteri_id" value="<?php echo $mustericek['musteri_id'] ?>">
            <button type="submit" name="duzenleme" class="btn btn-success btn-sm btn-icon-split">
              <span class="icon text-white-60">
                <i class="fas fa-edit"></i>
              </span>
            </button>
          </form>
          <form class="mx-1" action="islemler/islem.php" method="POST">
            <input type="hidden" name="musteri_id" value="<?php echo $mustericek['musteri_id'] ?>">
            <button type="submit" name="musterisilme" class="btn btn-danger btn-sm btn-icon-split">
              <span class="icon text-white-60">
                <i class="fas fa-trash"></i>
              </span>
            </button>
          </form>
          <form action="musteri" method="POST">
            <input type="hidden" name="musteri_id" value="<?php echo $mustericek['musteri_id'] ?>">
            <button type="submit" name="musteri_bak" class="btn btn-primary btn-sm btn-icon-split">
              <span class="icon text-white-60">
                <i class="fas fa-eye"></i>
              </span>
            </button>
          </form>
        </div>
      </td>
    </tr>
  <?php } ?>
</tbody>
<tfoot>
  <tr> 
    <th>No</th>
    <th>Müşteri Adı</th>
    <th>Müşteri Yetkilisi</th>
    <th>Müşteri Telefon</th>
    <th>Müşteri Mail</th>
  </tr>
</tfoot>
<!--While döngüsü ile veritabanında ki verilerin tabloya çekilme işlemi çıkış-->
</table>
</div>
</div>
</div>
<!--Datatables çıkış-->
</div>


<?php include'footer.php' ?>

<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/demo/datatables-demo.js"></script> 
<script src="vendor/datatables/dataTables.buttons.min.js"></script>
<script src="vendor/datatables/buttons.flash.min.js"></script>
<script src="vendor/datatables/jszip.min.js"></script>
<script src="vendor/datatables/pdfmake.min.js"></script>
<script src="vendor/datatables/vfs_fonts.js"></script>
<script src="vendor/datatables/buttons.html5.min.js"></script>
<script src="vendor/datatables/buttons.print.min.js"></script>

<script type="text/javascript">
  $("#aktarmagizleme").click(function(){
    $(".dt-buttons").toggle();
  });
</script>
<script type="text/javascript">
  $(".mobilgoster").click(function(){
    $(".gizlemeyiac").toggle();
  });
</script>
<script>
  var dataTables = $('#dataTable').DataTable({
    initComplete: function () {
      this.api().columns().every( function () {
        var column = this;
        var select = $('<select><option value=""></option></select>')
        .appendTo( $(column.footer()).empty() )
        .on( 'change', function () {
          var val = $.fn.dataTable.util.escapeRegex(
            $(this).val()
            );

          column
          .search( val ? '^'+val+'$' : '', true, false )
          .draw();
        });

        column.data().unique().sort().each( function ( d, j ) {
          select.append( '<option value="'+d+'">'+d+'</option>' )
        });
      });
    },
    "ordering": true,  //Tabloda sıralama özelliği gözüksün mü? true veya false
    "searching": true,  //Tabloda arama yapma alanı gözüksün mü? true veya false
    "lengthChange": true, //Tabloda öğre gösterilme gözüksün mü? true veya false
    "info": true,
    dom: "<'row '<'col-md-6'l><'col-md-6'f><'col-md-4 d-none d-print-block'B>>rtip",
    buttons: [
    {
      extend: 'copyHtml5', 
      className: 'kopyalama-buton',
      messageBottom: "Aksoyhlc İş Takip Sistemi Tarafından Üretilmiştir",
    },
    {
      extend: 'excelHtml5', 
      className: 'excel-buton',
      messageBottom: "Aksoyhlc İş Takip Sistemi Tarafından Üretilmiştir",
    },
    {
     extend: 'pdfHtml5',
     className: 'pdf-buton',
     messageBottom: "Aksoyhlc İş Takip Sistemi Tarafından Üretilmiştir",
   },
   {
    extend: 'csvHtml5',
    className: 'csv-buton',
    messageBottom: "Aksoyhlc İş Takip Sistemi Tarafından Üretilmiştir",
  }
  ]
});
  //Sonradan yapılan butona tıklandığında asıl dışa aktarma butonunun çalışması
  function fnAction(action) {
    switch (action) {
      case "excel":
      $('.excel-buton').trigger('click');
      break;
      case "pdf":
      $('.pdf-buton').trigger('click');
      break;
      case "copy":
      $('.kopyalama-buton').trigger('click');
      break;
      case "csv":
      $('.csv-buton').trigger('click');
      break;
    }
  }
  //Tablo filtreleme işlemleri
  $('#hepsi').on('click', function () {
    dataTables
    .columns()
    .search( '' )
    .columns( '.sold_out' )
    .search( 'YES' )
    .draw();
    dataTables.column(3).search("").draw();
  }); 
  $('#acil').on('click', function () {
    dataTables
    .columns()
    .search( '' )
    .columns( '.sold_out' )
    .search( 'YES' )
    .draw();
    dataTables.column(3).search("Acil").draw();
  }); 
  $('#normal').on('click', function () {
    dataTables
    .columns()
    .search( '' )
    .columns( '.sold_out' )
    .search( 'YES' )
    .draw();
    dataTables.column(3).search("Normal").draw();
  }); 
  $('#acelesiyok').on('click', function () {
    dataTables
    .columns()
    .search( '' )
    .columns( '.sold_out' )
    .search( 'YES' )
    .draw();
    dataTables.column(3).search("Acelesi Yok").draw();
  }); 
  $('#bitti').on('click', function () {
    dataTables
    .columns()
    .search( '' )
    .columns( '.sold_out' )
    .search( 'YES' )
    .draw();
    dataTables.column(4).search("Bitti").draw();
  }); 
  $('#devam').on('click', function () {
    dataTables
    .columns()
    .search( '' )
    .columns( '.sold_out' )
    .search( 'YES' )
    .draw();
    dataTables.column(4).search("Devam Ediyor").draw();
  }); 
  $('#yeni').on('click', function () {
    dataTables
    .columns()
    .search( '' )
    .columns( '.sold_out' )
    .search( 'YES' )
    .draw();
    dataTables.column(4).search("Yeni Başladı").draw();
  });
</script>

<?php if (@$_GET['durum']=="no")  {?>  
  <script>
    Swal.fire({
      type: 'error',
      title: 'İşlem Başarısız',
      text: 'Lütfen Tekrar Deneyin',
      showConfirmButton: true,
      confirmButtonText: 'Kapat'
    })
  </script>
<?php } ?>

<?php if (@$_GET['durum']=="ok")  {?>  
  <script>
    Swal.fire({
      type: 'success',
      title: 'İşlem Başarılı',
      text: 'İşleminiz Başarıyla Gerçekleştirildi',
      showConfirmButton: false,
      timer: 2000
    })
  </script>
<?php } ?>

<?php if (@$_GET['durum']=="hata")  {?>  
  <script>
    Swal.fire({
      type: 'error',
      title: 'İşlem Başarısız',
      text: 'Yapmamanız Gereken Şeyler Yapıyorsunuz!',
      showConfirmButton: false,
      timer: 3000
    })
  </script>
  <?php } ?>