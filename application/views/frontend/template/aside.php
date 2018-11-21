<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

    <!-- Blog Search Well -->
   <!-- <div class="well">
        <h4>Busca no Blog</h4>
        <div class="input-group">
            <input type="text" class="form-control">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>-->
        <!-- /.input-group -->
   <!-- </div> -->

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Estatisticas</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                        foreach ($tipos as $tipo) {
                        ?>
                             <li><a href="<?php echo base_url('estatistica/'.$tipo->id.'/'); ?>"><?php echo $tipo->nome ?></a>
                            </li>
                        <?php
                        }
                    ?>
                   
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

</div>