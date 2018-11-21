<!-- Page Content -->
<div class="container">

  <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">
     

<h1>Feedback</h1>
  <hr>
  <?php  if (!$this->session->userdata('logado')){  ?>
  <p>Você precisa estar logado para enviar feedback. <a href="<?php echo base_url('conta/login')?>">Faça login</a> ou <a href="<?php echo base_url('conta/usuario/pag_cad')?>"> cadastre-se</a>.</p> 
  <?php } else{ echo form_open('feedback/inserir') ?>
  <div class="form-group">
  <label id="txt-nome">Titulo</label>
  <input type ="text" id="titulo" name ="titulo" class="form-control" placeholder="Digite o titulo do comentario" value="<?php echo set_value('titulo')?>">

  </div>
  <div class="form-group">
  <label id="txt-feedback">Feedback</label>
  <textarea id="feedback" name ="feedback" class="form-control"><?php echo set_value('feedback')?></textarea>
</div>
<button type="submit" class="btn btn-default">Enviar Feedback</button> 


<?php echo form_close(); }?>

</div>
