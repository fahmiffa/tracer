<section class="ftco-section bg-light">
	<div class="container">
		<div class="row">
			<?php if (!empty($lok)) {
				$n = 1;
				foreach ($lok as $row) {
					$n++; ?>
					<div class="col-md-6 col-lg-3 ftco-animate d-flex align-items-stretch">
						<a href="<?= base_url('loker/' . url_title(strtolower($row->loker_name))) ?>">
							<div class="staff">
								<div class="img-wrap d-flex align-items-stretch">
									<div class="img align-self-stretch" style="background-image: url(<?= base_url($row->loker_asset) ?>);"></div>
								</div>
								<div class="text pt-3">
									<h3><a href="instructor-details.html"><?= $row->loker_name ?></a></h3>
									<!-- <span class="position mb-2"><?= date_to_id($row->loker_date) ?></span> -->
									<div class="faded">
										<p>Lowongan Pekerjaan di buka : <?= date_to_id($row->loker_date) ?></p>
									</div>
								</div>
							</div>
						</a>
					</div>
			<?php }
			} ?>
		</div>
	</div>
</section>