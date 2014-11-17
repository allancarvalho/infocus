<?php if(sizeOf($result) > 0)  { ?>
<div class="row spacing">
	<h3>Aulas para confirmar (<?php echo sizeOf($result); ?>)</h3>
	<table>
		<thead>
			<th>Nome</th>
			<th>E-mail</th>
			<th>Data e Hora Início</th>
			<th>Data e Hora Fim</th>
			<th>Duração</th>
			<th></th>
		</thead>
		<tbody>
			<?php 
			foreach ($result as $value) {
				echo '<tr>';
				echo '<td>'.$value->username.'</td>';
				echo '<td>'.$value->email.'</td>';

				$time = new DateTime($value->hour_start);
				$hour_start = $time->format('d/m/Y H:i');


				$google_start_d = $time->format('Y-m-d');
				$google_start_h = $time->format('H:i:s');
				$google_start = $google_start_d . 'T' . $google_start_h. '-03:00';


				$time = new DateTime($value->hour_end);
				
				$hour_end = $time->format('d/m/Y H:i');
				$google_end_d = $time->format('Y-m-d');
				$google_end_h = $time->format('H:i:s');
				$google_end = $google_end_d . 'T' . $google_end_h. '-03:00';

				


				$output = (strtotime($value->hour_end) - strtotime($value->hour_start));

				echo '<td data-google-start="'.$google_start.'">'.$hour_start.'</td>';
				echo '<td data-google-end="'.$google_end.'">'.$hour_end.'</td>';
				echo '<td>'.($output / 60).' minutos</td>';
				?>
				<td>
					<ul class="button-group">
						<li>
							<button data-aula-id="<?php echo $value->id_aula ?>" class="confirmar_aula tiny">
								<span class="fi-check large"></span>
							</button>
						</li>
						<li>
							<button data-aula-id="<?php echo $value->id_aula ?>" class="recusar_aula tiny alert">
								<span class="fi-x"></span>
							</button>
							
						</li>
					</ul>
				</td>
				<?php
				echo '</tr>';
			} ?>

		</tbody>
	</table>
</div>
<div hidden>
	<div id="recusar"  title="Deseja recusar a aula?"></div>
</div>
<?php } ?>
<?php if(sizeOf($all) > 0)  { ?>
<div class="row spacing">
	<h3>Todas as aulas confirmadas (<?php echo sizeOf($all); ?>)</h3>
	<table>
		<thead>
			<th>Nome</th>
			<th>E-mail</th>
			<th>Data e Hora Início</th>
			<th>Data e Hora Fim</th>
			<th>Duração</th>
		</thead>
		<tbody>
			<?php 
			foreach ($all as $value) {
				echo '<tr>';
				echo '<td>'.$value->username.'</td>';
				echo '<td>'.$value->email.'</td>';

				$time = new DateTime($value->hour_start);
				$hour_start = $time->format('d/m/Y H:i');


				$google_start_d = $time->format('Y-m-d');
				$google_start_h = $time->format('H:i:s');
				$google_start = $google_start_d . 'T' . $google_start_h. '-03:00';


				$time = new DateTime($value->hour_end);
				
				$hour_end = $time->format('d/m/Y H:i');
				$google_end_d = $time->format('Y-m-d');
				$google_end_h = $time->format('H:i:s');
				$google_end = $google_end_d . 'T' . $google_end_h. '-03:00';

				


				$output = (strtotime($value->hour_end) - strtotime($value->hour_start));

				echo '<td data-google-start="'.$google_start.'">'.$hour_start.'</td>';
				echo '<td data-google-end="'.$google_end.'">'.$hour_end.'</td>';
				echo '<td>'.($output / 60).' minutos</td>';
				?>

				<?php
				echo '</tr>';
			} ?>

		</tbody>
	</table>
</div>
<div hidden>
	<div id="recusar"  title="Deseja recusar a aula?"></div>
</div>
<?php } ?>
<div class="row">
	<iframe src="https://www.google.com/calendar/embed?showTitle=0&amp;mode=WEEK&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=engikcn3m5gmclnnjuog1eml1k%40group.calendar.google.com&amp;color=%236B3304&amp;ctz=America%2FSao_Paulo" style=" border-width:0 " width="100%" height="600" frameborder="0" scrolling="no"></iframe>
</div>
