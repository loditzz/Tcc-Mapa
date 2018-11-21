<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Navegação</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url() ?>">Mapa do Preconceito</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tipos de Preconceito <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <?php
                    foreach ($tipos as $tipo) {
                        ?>
                        <li><a href="<?php echo base_url('categoria/'.$tipo->id.'/'.limpar($tipo->nome)) ?>"><?php echo $tipo->nome ?></a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </li>
            <li>
                <a href="<?php echo base_url('conta/ocorrencia/adicionar') ?>">Cadastrar Ocorrencia</a>
            </li>
            <li>
                <a href="<?php 
                    //se o usuário estiver logado, seta o link para a conta. Se não, seta o link para cadastrar
                    if ($this->session->userdata('logado')){
                    echo base_url('conta');
                    }else{
                        echo base_url('conta/usuario/pag_cad');
                    }
                     ?>">
                     <?php //se o usuário estiver logado, aparece o botão de sair
                    if ($this->session->userdata('logado')){
                        echo "Minha conta";
                    }else{
                        echo "Cadastrar-se";
                    } ?></a>
                    }
            </li>
            <li>
                <a href="<?php 
                //se o usuario estiver logado, seta o link para logou. Se não estiver logado, seta o link para login
                if ($this->session->userdata('logado')){
                    echo base_url('conta/usuario/logout');
                    }else{
                        echo base_url('conta/login');
                    }
                    ?>">
                    <?php 
                    //se o usuário estiver logado, aparece o botão de sair
                    if ($this->session->userdata('logado')){
                        echo "Sair";
                    }else{
                        echo "Entrar";
                    } ?>
                </a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</div>
<!-- /.container -->
</nav>
