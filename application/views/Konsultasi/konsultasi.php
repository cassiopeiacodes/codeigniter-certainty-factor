
		<?php if ( $check==FALSE ): ?>
			<section class="col row m-0">

					<div class="col my-auto">
						<h1 class="display-4 text-center text-uppercase">pemberitahuan !!!</h1>
						<blockquote class="blockquote text-center">
							<p class="mb-0">Sistem konsultasi belum siap! Tidak ditemukan data gejala untuk memulai sesi konsultasi.</p>
							<footer class="blockquote-footer bg-transparent">Oleh <cite title="Source Title">Admin</cite></footer>
						</blockquote>
					</div>

			</section>


		<?php else: ?>
			<section class="col bg-darkcream">

			<?php
			$att = array(
				'class' => 'container col-sm-8 mx-auto row justify-content-center my-4',
			);
			echo form_open('Konsultasi/Hasil',$att);
			unset($att);
			?>
			<?php foreach ($gejala as $no => [ 'id'=>$id, 'kode'=>$kode, 'keterangan'=>$ket ]): ?>
				<div class="col p-4 bg-white">
					<dl class="row">
						<dt class="col-sm-3">Kode</dt>
						<dd class="col-sm-9"><?php echo $kode ?></dd>

						<div class="w-100"></div>

						<dt class="col-sm-3">Nama</dt>
						<dd class="col-sm-9"><?php echo $ket ?></dd>

						<div class="w-100"></div>

						<dt class="col-sm-3">Pilihan Anda</dt>
						<dd class="col-sm-9">
							<dl class="row my-1">
								<dt class="col-auto my-auto text-uppercase">tidak</dt>
								<dd class="col-auto my-auto">
									<label class="switch my-auto">
										<?php echo form_checkbox('pilihan[]', $id, FALSE) ?>
										<span class="slider round fas fa-check-circle text-primary text-center"></span>
									</label>
								</dd>
								<dt class="col-auto my-auto text-uppercase">ya</dt>
							</dl>
						</dd>
					</dl>
				</div>

				<div class="w-100 mb-4"></div>
				<?php endforeach; ?>

				<?php
				if (isset($att)) unset($att);

				$att = array(
					'name'          => 'submit',
	        'id'            => 'submit',
					'class'					=> 'btn btn-block btn-outline-dark my-1',
	        'type'          => 'submit',
	        'content'       => 'Hitung'
				);
				?>
				<div class="col p-0">
					<?php echo form_button($att); ?>
				</div>

				<?php echo form_close() ?>
			</section>
		<?php endif; ?>
