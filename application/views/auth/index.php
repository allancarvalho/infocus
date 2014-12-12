<div class="large-11 large-centered columns">
<h1>Usuários</h1>

<div id="infoMessage"><?php echo $message;?></div>

<table cellpadding=0 cellspacing=10>
	<tr>
		
		<th>Usuário</th>
		<th><?php echo lang('index_email_th');?></th>
		<th>Skype</th>
		

		<th>Nascimento</th>
		<th>Telefone</th>
		<th>Endereco</th>



		<th><?php echo lang('index_groups_th');?></th>
		<th><?php echo lang('index_status_th');?></th>
		<th><?php echo lang('index_action_th');?></th>
		<th>Horas</th>
	</tr>
	<?php foreach ($users as $user):?>
		<tr>
			<td><?php echo $user->username;?></td>
			<td><?php echo $user->email;?></td>
			<td><?php echo $user->skype;?></td>


			<td><?php echo $user->nascimento;?></td>
			<td><?php echo $user->telefone;?></td>
			<td>
				<?php echo $user->endereco;?>,
				<?php echo $user->numero;?> - 
				<?php echo $user->complemento;?> <br>
				<?php echo $user->bairro;?> - 
				<?php echo $user->cidade;?> - 
				<?php echo $user->cep;?><br>
				<?php echo $user->uf;?>
				<?php echo $user->pais;?>
			</td>
			<td>
				<?php foreach ($user->groups as $group):?>
					<?php echo anchor("auth/edit_group/".$group->id, $group->name) ;?><br />
                <?php endforeach?>
			</td>
			<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
			<td><?php echo anchor("auth/edit_user/".$user->id, 'Edit') ;?> | <a class="DeleteUser" href="<?php echo base_url('auth/delete_user/'.$user->id) ?>">Deletar</a></td>
			<td><?php echo $user->points ;?></td>
		</tr>
	<?php endforeach;?>
</table>

<p><?php echo anchor('auth/create_user', lang('index_create_user_link'))?> | <?php echo anchor('auth/create_group', lang('index_create_group_link'))?></p>
</div>
