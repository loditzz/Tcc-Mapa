 <div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo 'Administrar '.$subtitulo ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">


    <!-- /.col-lg-6 -->
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
             <?php echo 'Alterar '.$subtitulo.' existente' ?>
         </div>
         <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                  <?php 
                            //iniciando e dando heading a tabela
                  $this->table->set_heading("Título da Ocorrencia", "Alterar", "Excluir");

                  foreach ($ocorrencias as $ocorrencia) {
                    $nomeoco=$ocorrencia->name;
                    $alterar=anchor(base_url('conta/ocorrencia/alterar/'.md5($ocorrencia->id)), '<i class="fa fa-edit fa-fw"></i>Alterar');
                    $excluir=anchor(base_url('conta/ocorrencia/excluir/'.md5($ocorrencia->id)), '<i class="fa fa-remove fa-fw"></i>Excluir');

                    $this->table->add_row($nomeoco, $alterar, $excluir);

                }   
                            //setar o template de exibição da tabela
                $this->table->set_template(array (
                    'table_open' => '<table class="table table-striped">'
                ));
                            //imprimir a tabela
                echo $this->table->generate();

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