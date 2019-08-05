<?php 
include 'header.php';
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
<script type="text/javascript">
	var genislik = $(window).width()   
	if (genislik < 768) {
		function yenile(){
			$('#sidebarToggleTop').trigger('click');
		}
		setTimeout("yenile()",1);
	}
</script>
<div class="container-fluid p-2">
	
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Müşteriler</h6>
		</div>
		<div class="card-body" style="width: 100%">
			<!--Tablo filtreleme butonları mobilde gizlendiğinde gözükecek buton-->
			<div class="table-responsive">
				<table class="table table-bordered" id="musteritablosu" width="100%" cellspacing="0">
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
	<hr>

	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Domainler</h6>
		</div>
		<div class="card-body" style="width: 100%">
			<!--Tablo filtreleme butonları mobilde gizlendiğinde gözükecek buton-->
			<div class="table-responsive">
				<table class="table table-bordered" id="domaintablosu" width="100%" cellspacing="0">
					<thead>
						<tr> 
							<th>No</th>
							<th>Domain Adı</th>
							<th>Domain Müşteri</th>
							<th>Domain Bitiş</th>
							<th>Kalan Gün Sayısı</th>
							<th>İşlem</th>
						</tr>
					</thead>
					<!--While döngüsü ile veritabanında ki verilerin tabloya çekilme işlemi giriş-->
					<tbody>
						<?php 
						$say=0;
						$domainsor=$db->prepare("SELECT * FROM domain");
						$domainsor->execute();
						while ($domaincek=$domainsor->fetch(PDO::FETCH_ASSOC)) { $say++?>

							<tr>
								<td><?php echo $say; ?></td>
								<td><?php echo $domaincek['domain_adi']; ?></td>
								<td><?php 
								$musterisor=$db->prepare("SELECT * FROM musteri WHERE musteri_id=:musteri_id");
								$musterisor->execute(array(
									'musteri_id' => $domaincek['domain_musteri']
								));
								$mustericek=$musterisor->fetch(PDO::FETCH_ASSOC);
								echo $mustericek['musteri_adi'];
								?></td>
								<td><?php echo $domaincek['domain_bitis']; ?></td>
								<td><?php 
								$tarih1 = strtotime(date('d.m.Y'));
								$tarih2 = strtotime($domaincek['domain_bitis']);
								$fark = $tarih2 - $tarih1;
								echo $sonuc = floor($fark / (60 * 60 * 24));
								?></td>
								<td>
									<div class="d-flex justify-content-center">
										<form class="mr-1" action="yenile.php" method="POST">
											<input type="hidden" name="domain_id" value="<?php echo $domaincek['domain_id'] ?>">
											<button type="submit" name="yenile" class="btn btn-info btn-sm btn-icon-split">
												<span class="icon text-white-60">
													<i class="fas fa-sync-alt"></i>
												</span>
											</button>
										</form>
										<form action="domainduzenle.php" method="POST">
											<input type="hidden" name="domain_id" value="<?php echo $domaincek['domain_id'] ?>">
											<button type="submit" name="duzenleme" class="btn btn-success btn-sm btn-icon-split">
												<span class="icon text-white-60">
													<i class="fas fa-edit"></i>
												</span>
											</button>
										</form>
										<form class="mx-1" action="islemler/islem.php" method="POST">
											<input type="hidden" name="domain_id" value="<?php echo $domaincek['domain_id'] ?>">
											<button type="submit" name="domainsilme" class="btn btn-danger btn-sm btn-icon-split">
												<span class="icon text-white-60">
													<i class="fas fa-trash"></i>
												</span>
											</button>
										</form>
										<form action="domain" method="POST">
											<input type="hidden" name="domain_id" value="<?php echo $domaincek['domain_id'] ?>">
											<button type="submit" name="domain_bak" class="btn btn-primary btn-sm btn-icon-split">
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
							<th>Plaka</th>
							<th>Şase No</th>
							<th>Müşteri İsim</th>
							<th>Kalan Gün Sayısı</th>
						</tr>
					</tfoot>
					<!--While döngüsü ile veritabanında ki verilerin tabloya çekilme işlemi çıkış-->
				</table>
			</div>
		</div>
	</div>

</div>
<!--Projeler Çıkış-->

</div>


<?php 
include 'footer.php';
?>

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
	var dataTables = $('#musteritablosu').DataTable({
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
    "lengthMenu": [ 5, 10, 25, 50, 75, 100 ],
    dom: "<'row '<'col-md-6'l><'col-md-6'f><'col-md-4 d-none d-print-block'B>>rtip",
});
</script>

<script>
	var dataTables = $('#domaintablosu').DataTable({
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
    "lengthMenu": [ 5, 10, 25, 50, 75, 100 ],
    dom: "<'row '<'col-md-6'l><'col-md-6'f><'col-md-4 d-none d-print-block'B>>rtip",
});
</script>

<?php 
if (isset($_GET['durum'])) {?>
	<?php if ($_GET['durum']=="izinsiz")  {?>	
		<script>
			Swal.fire({
				type: 'error',
				title: 'İzniniz Yok',
				text: 'Girme İzniniz olmayan bir alana girmeye çalıştınız',
				showConfirmButton: false,
				timer: 2000
			})
		</script>
	<?php } ?>
	<?php if ($_GET['durum']=="ok")  {?>	
		<script>
			Swal.fire({
				type: 'success',
				title: 'İşlem Başarılı',
				text: 'İşleminiz Başarıyla Gerçekleştirildi',
				showConfirmButton: false,
				timer: 2000
			})
		</script>
	<?php } } ?>
