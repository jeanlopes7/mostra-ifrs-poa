
<?php
$already = "você já está cadastrado neste papel";
?>
<!-- Menu Área geral do usuário -->
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav pull-right">
        <li class="dropdown">
            
          <!-- Inscrições -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Inscrições <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">

            <?php if ($papeis["autor"]): ?>
              <li><a class="already" title="<?php echo $already; ?>" href="#">Autor</a></li>
            <?php else: ?>
              <li><a class="confirm_autor" href="#">Autor</a></li>
            <?php endif; ?>

            <?php if ($papeis["orientador"]): ?>
              <li><a class="already" title="<?php echo $already; ?>" href="#">Orientador</a></li>
            <?php else: ?>
              <li><a class="confirm_orientador" href="#">Orientador</a></li>
            <?php endif; ?>

            <?php if ($papeis["avaliador"]): ?>
              <li><a class="already" title="<?php echo $already; ?>" href="#">Avaliador</a></li>
            <?php else: ?>
              <li><a class="confirm_avaliador" href="#">Avaliador</a></li>
            <?php endif; ?>

            <?php if ($papeis["ouvinte"]): ?>
              <li><a class="already" title="<?php echo $already; ?>" href="#">Ouvinte</a></li>
            <?php else: ?>
              <li><a  href="<?=base_url()?>usuario/ouvinte_ctr/inscricao_incremental">Ouvinte</a></li>
            <?php endif; ?>
              
            <?php if ($papeis["voluntario"]): ?>
              <li><a class="already" title="<?php echo $already; ?>" href="#">Voluntário</a></li>
            <?php else: ?>
              <li><a href="<?=base_url()?>usuario/voluntario_ctr/inscricao_incremental" >Voluntário</a></li>
            <?php endif; ?>

          </ul>
        </li>
        
        <!-- Menu com os papéis -->
        <?php if ($mais_que_um_papel): ?>
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Áreas do usuário <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
              
              <?php if ($papeis["autor"]): ?>
                <li><a href="<?=base_url()?>usuario/autor_ctr">Autor</a></li>
              <?php endif; ?>
                
              <?php if ($papeis["orientador"]): ?>
                <li><a href="<?=base_url()?>usuario/orientador_ctr">Orientador</a></li>
              <?php endif; ?>
                
              <?php if ($papeis["avaliador"]): ?>
                <li><a href="<?=base_url()?>usuario/avaliador_ctr">Avaliador</a></li>
              <?php endif; ?>

              <?php if ($papeis["ouvinte"]): ?>
                <li><a href="<?=base_url()?>usuario/ouvinte_ctr">Ouvinte</a></li>
              <?php endif; ?>

              <?php if ($papeis["voluntario"]): ?>
                <li><a href="<?=base_url()?>usuario/voluntario_ctr">Voluntário</a></li>
              <?php endif; ?>

            
          </ul>
        </li>
        <?php endif; // if mais_que_um_papel ?>
        <?php /* ?> <li><a href="#">Alterar dados</a></li> <?php */ ?>
        <li><a href="<?=base_url()?>./login/login_ctr/logout" >Sair</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
    
  </div><!-- /.container-fluid -->
</nav>

<script type="text/javascript" src="<?=base_url()?>content/area_geral_usuario.js"></script> 

