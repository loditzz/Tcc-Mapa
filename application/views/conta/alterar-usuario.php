 <div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo 'Administrar '.$subtitulo ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                   <?php echo 'Adicionar novo '.$subtitulo ?>
               </div>
               <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                        echo validation_errors('<div class="alert alert-danger">', '</div>');
                            //abertura do formulário
                            //informo o controlador e o metodo que vai acessar o form
                        echo form_open('conta/usuario/salvar_alteracoes');

                        foreach($usuarios as $usuario){
                        ?>
                        <div class="form-group">
                            <label id="txt-nome">Nome do usuario</label>
                            <input type ="text" id="txt-nome" name ="txt-nome" class="form-control" placeholder="Digite o nome do usuario" value="<?php echo $usuario->nome ?>">

                        </div>
                        <div class="form-group">
                            <label id="txt-email">Email</label>
                            <input type ="text" id="txt-email" name ="txt-email" class="form-control" placeholder="Digite o email do usuario" value="<?php echo $usuario->email ?>">

                        </div> 
                        <div class="form-group">
                            <label id="txt-sexo">Sexo</label>
                            <select name="sexo" id="sexo" class ="form-control">
                                <option value ="Mulher Cis">Mulher Cisgenero</option>
                                <option value ="Mulher trans">Mulher transgenero</option>
                                <option value ="Homem Cis">Homem Cisgenero</option>
                                <option value ="Homem Trans">Homem Transgenero</option>
                                <option value ="Nao Binario">Não-Binário</option>
                            </select>
                        </div> 
                       
                        <div class="form-group">
                            <label id="txt-senha">Nova Senha</label>
                            <input type ="password" id="txt-senha" name ="txt-senha" class="form-control" placeholder="Digite a senha do usuario">
                        </div>  
                         <div class="form-group">
                            <label id="txt-confir-senha">Confirmar Nova Senha</label>
                            <input type ="password" id="txt-confir-senha" name ="txt-confir-senha" class="form-control" placeholder="Digite a senha do usuario">
                        </div>
                         <input type ="hidden" name="txt-id" id="txt-id" value="<?php echo $auxid=$this->session->userdata('userlogado')->id; ?>">
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