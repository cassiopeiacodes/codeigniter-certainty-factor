<?php if ($check===0): ?>
	<section class="col row justify-content-center align-items-center bg-light px-4 m-0">
		<div class="col text-center bg-transparent">
			<h1 class="display-4 text-uppercase">pemberitahuan !!!</h1>
			<blockquote class="blockquote text-center">
				<p class="mb-0">Data informasi tidak ditemukan. Hal ini terjadi karena belum dimasukkannya data-data terkait maupun tidak ditemukannya data tersebut.</p>
				<footer class="blockquote-footer bg-transparent">Oleh <cite title="Source Title">Admin</cite></footer>
			</blockquote>
		</div>
	</section>
<?php else: ?>
	<section class="bg-info col row justify-content-between align-items-center bg-light px-4 py-5 m-0">
		<div class="row justify-content-between w-100 m-0">
			<div class="col text-center mt-5">
				<h1 class="display-4 text-uppercase">informasi data</h1>
			</div>
			<div class="w-100 mb-5"></div>

			<?php foreach ( $info as $no => $val ): ?>

				<?php $color = $no%4===0 ? 'bg-primary' : ( $no%3 ===0 ? 'bg-success' : ( $no%2===0 ? 'bg-danger':'bg-warning text-dark') ); ?>
				<?php $img = $no%4===0 ? 'background-home.jpg' : ( $no%3 ===0 ? 'info-3.jpg' : ( $no%2===0 ? 'info-2.jpg':'info-1.jpg') ); ?>
				<?php list('penyakit_kode' => $penyakit_kode, 'penyakit_nama' => $penyakit_nama, 'penyakit_keterangan' => $penyakit_ket) = $val ?>
				<div class="col-sm-6 box-info">
					<div class="row">
						<div class="col img-box">
							<img class="img-box box-border <?php echo $img ?>" src="assets/images/<?php echo $img ?>">
						</div>

						<div class="w-100"></div>

						<div class="col m-4 p-0">
							<dl class="row m-4">
								<dt class="col-sm-3">Kode</dt>
								<dd class="col-sm-9"><?php echo $penyakit_kode ?></dd>

								<div class="w-100"></div>

								<dt class="col-sm-3">Nama</dt>
								<dd class="col-sm-9 h5"><?php echo $penyakit_nama ?></dd>

								<div class="w-100"></div>

								<dt class="col-sm-3">keterangan</dt>
								<dd class="col-sm-9"><?php echo $penyakit_ket ?></dd>

								<div class="w-100"></div>

								<dt class="col-sm-3">
									gejala
								</dt>
								<dd class="col-sm-9 list-unstyled">
									<dl class="row text-justify">
										<dd class="col-sm-12">Keterangan : </dd>

										<div class="w-100"></div>

										<dt class="col-sm-1">MB</dt>
										<dd class="col-sm-11"><i>Measure of Belief</i> (tingkat keyakinan), merupakan ukuran kepercayaan dari hipotesis <i>h</i> dipengaruhi oleh evidence (gejala) <i>e</i>.</dd>

										<div class="w-100"></div>

										<dt class="col-sm-1">MD</dt>
										<dd class="col-sm-11"><i>Measure of Disbelief</i> (tingkat ketidakyakinan), merupakan ukuran ketidakpercayaan dari hipotesis <i>h</i> dipengaruhi oleh gejala <i>e</i>.</dd>
									</dl>
								</dd>

								<div class="w-100 mb-3"></div>

								<div class="col-sm-12 table-responsive">
									<table class="table">
										<caption class="text-muted">Tabel informasi data pada penyakit <?php echo $penyakit_nama ?></caption>
										<thead>
											<tr>
												<th scope="col">Kode</th>
												<th scope="col">Keterangan</th>
												<th scope="col">MB</th>
												<th scope="col">MD</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($val['gejala_kode'] as $no => $kd): ?>
												<tr>
													<th scope="row"><?php echo $kd ?></th>
													<td><?php echo $val['gejala_nama'][$no] ?></td>
													<td><?php echo $val['mb'][$no] ?></td>
													<td><?php echo $val['md'][$no] ?></td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>

							</dl>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</section>
<?php endif; ?>
