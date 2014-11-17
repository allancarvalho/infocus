<div class="row">
    <h1>Editar usuário</h1>
    <div id="infoMessage"><?php echo $message;?></div>

    <?php echo form_open(uri_string());?>


    <p>
        Skype <br />
        <?php echo form_input($skype);?>
    </p>

    <p>
        Nascimento <br />
        <?php echo form_input($nascimento);?>
    </p>
    <p>
        Telefone <br />
        <?php echo form_input($telefone);?>
    </p>
    <p>
        Numero <br />
        <?php echo form_input($numero);?>
    </p>
    <p>
        Complemento <br />
        <?php echo form_input($complemento);?>
    </p>
    <p>
        Bairro <br />
        <?php echo form_input($bairro);?>
    </p>
    <p>
        Cidade <br />
        <?php echo form_input($cidade);?>
    </p>
    <p>
        UF <br />
        <?php echo form_input($uf);?>
    </p>
    <p>
        Pais <br />
        <?php echo form_input($pais);?>
    </p>


    <p>
        <?php echo lang('edit_user_password_label', 'password');?> <br />
        <?php echo form_input($password);?>
    </p>

    <p>
        <?php echo lang('edit_user_password_confirm_label', 'password_confirm');?><br />
        <?php echo form_input($password_confirm);?>
    </p>
    <p>
        <?php 
        echo "<h3>Questions</h3>";
        $questions = json_decode($questions);
        for($i=0; $i<count($questions); $i++) {
            if($i == 0) {
                echo "<strong>O que o leva a estudar inglês?<br></strong>";
                echo join(", ", $questions[$i]);
                echo "<br><br>";
            }
            if($i == 1) {
                echo "<strong>Quais as áreas descritas abaixo que considera que mais precise melhorar no idioma (assinalar por ordem de prioridade) ?<br></strong>";
                // print_r($questions[$i]);
// usort($questions[$i], array($this->job_model, "sortJobs")); 



                // for($i=1; $i<=sizeof($questions[$i]); $i++) {
                //     foreach($questions[$i] as $value) {
                //         if($value == $i) {
                //             echo $i . " - " .$value;
                //         } 
                //     }
                // }


                // echo ($questions[$i]);
                $o = 1;
                foreach ($questions[$i] as $key => $question) {
                    $o++;
                }
                for($u = 1; $u<$o; $u++) {

                    foreach ($questions[$i] as $key => $question) {
                        if($question == $u) {
                            echo '( '.$question.' ) - ' .  $key ."<br>";
                        }
                    }                    
                }




                echo "<br><br>";
            }
            if($i == 2) {
                echo "<strong>Quais as situações em que você mais precisa usar o inglês?<br></strong>";
                echo join(", ", $questions[$i]);
            }

        }
        ?>
    </p>
    <p>
        <?php 
        echo "<h3>Pontos</h3>";

        echo $points;
        ?>
    </p>
    <?php if ($this->ion_auth->is_admin()): ?>

    <h3>Grupo do usuário</h3>
    <?php foreach ($groups as $group):?>
    <label class="checkbox">
        <?php
        $gID=$group['id'];
        $checked = null;
        $item = null;
        foreach($currentGroups as $grp) {
            if ($gID == $grp->id) {
                $checked= ' checked="checked"';
                break;
            }
        }
        ?>
        <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
        <?php echo $group['name'];?>
    </label>
<?php endforeach?>

<?php endif ?>

<?php echo form_hidden('id', $user->id);?>
<?php echo form_hidden($csrf); ?>

<p><?php 
echo form_submit('submit', lang('edit_user_submit_btn'), "class='button small'");?></p>

<?php echo form_close();?>
</div>
