<div class="row">
	<p>redirecionando para o pagseguro...</p>
</div>
<?php 
    echo $this->pagseguro->get_button($config);
 ?>
 <script>
 document.forms["form_pagseguro"].submit();
 </script>
