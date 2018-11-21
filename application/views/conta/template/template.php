<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Navegação</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url() ?>">Mapa do Preconceito</a>
        </div>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="<?php echo base_url('conta/ocorrencia/adicionar')?>"><i class="fa fa-plus fa-fw"></i> Adicionar Ocorrencia</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('conta/ocorrencia')?>"><i class="fa fa-map-marker fa-fw"></i> Minhas Ocorrencias </a>
                    </li>
                    <li>
                        <a href="<?php $auxid=$this->session->userdata('userlogado')->id; echo base_url('conta/usuario/alterar/'.md5($auxid))?>"><i class="fa fa-wrench fa-fw"></i> Editar Conta</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('conta/usuario/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Sair do Sistema</a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>
