<?=$this->load->view('../../../templates/header.html.php')?>

<?=set_breadcrumb()?>
<!-- Menu -->
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
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav pull-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Trabalhos <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="organizador/categoria">Categoria</a></li>
            <li><a href="organizador/modalidade">Modalidade</a></li>
            <li><a href="organizador/area_tematica">Área temática</a></li>
          </ul>
        </li>
        <li><a href="#" data-toggle="modal" data-target="#modalLogin">Login</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<?=$this->load->view('../../login/views/login.html.php')?>
<?=$this->load->view('../../usuario/views/verificar_cpf.html.php')?>
<script type="text/javascript" src="<?=base_url()?>/content/organizador.js"></script>
<?=$this->load->view('../../../templates/footer.html.php')?>