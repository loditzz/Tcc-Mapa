 <div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo 'Administrar '.$subtitulo ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                 <?php echo 'Adicionar nova '.$subtitulo ?>
             </div>
             <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                        echo validation_errors('<div class="alert alert-danger">', '</div>');
                            //abertura do formulário
                            //informo o controlador e o metodo que vai acessar o form
                        echo form_open('admin/categoria/salvar_alteracoes');

                        foreach ($categorias as $categoria) {


                            ?>
                            <div class="form-group">

                                <label id="txt-categoria">Nome da categoria</label>
                                <input type ="text" id="txt-categoria" name ="txt-categoria" class="form-control" placeholder="Digite o nome da categoria" value = "<?php echo $categoria->titulo ?>" >

                            </div>
                            <input type="hidden" name="txt-id" id="txt-id" value="<?php echo $categoria->id ?>">
                            <button type="submit" class="btn btn-default">Alterar</button>
                            <?php
                        }
                        echo form_close();
                        ?>
                    </div>

                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>

    <!-- /.col-lg-6 -->


</div>
<!-- /.row -->


</div>
<!-- /#page-wrapper -->
</div>
<!--
<form role="form">
                                        
                                        <div class="form-group">
                                            <label>Foto Destaque</label>
                                            <input type="file">
                                        </div>
                                        <div class="form-group">
                                            <label>Conteúdo</label>
                                            <textarea class="form-control" rows="3"></textarea>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label>Selects</label>
                                            <select class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>

                                        <button type="reset" class="btn btn-default">Limpar</button>
                                    </form>