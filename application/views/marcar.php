<div class="row">
	<h1>Marcar aulas</h1>
	<form method="POST" class="marcar-form" action="<?php echo base_url('marcar/g') ?>">
		<div class="row">
			<div class="large-4 columns">
				<p>
					data
					<input type="text" class="datepicker" name="date" placeholder="dd/mm/aaaa">
				</p>
			</div>
			<div class="large-2 columns">
				
				<p>
					hora inicio
					<select name="hora_inicio">
						<?php for($i=0; $i<24; $i++) {
							if($i < 10) {
								$hora = '0'.$i;
							} else {
								$hora = $i;
							}
							echo '<option value="'.$hora.':00">'.$hora.':00</option>';
							echo '<option value="'.$hora.':30">'.$hora.':30</option>';
						} ?>
					</select>
				</p>
			</div>
			<div class="large-4 columns">
				<p>
					duração da aula
					<select name="duracao">
						<option value="60">60 minutos</option>
					</select>
				</p>
			</div>
			<div class="large-2 columns">
			</div>
		</div>
		<p>
			<input type="submit" value="Marcar">
		</p>
	</form>
	
	<iframe src="https://www.google.com/calendar/embed?showTitle=0&amp;mode=WEEK&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=engikcn3m5gmclnnjuog1eml1k%40group.calendar.google.com&amp;color=%236B3304&amp;ctz=America%2FSao_Paulo" style=" border-width:0 " width="100%" height="600" frameborder="0" scrolling="no"></iframe>
</div>