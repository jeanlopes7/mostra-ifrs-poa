<?=$this->load->view('../../../templates/header.html.php')?>

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
        <!------------ Menu Inscrições ------------>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Inscrições <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a data="autor" href="#" data-toggle="modal" data-target="#modalVerificarCPF">Autor</a></li>
            <li><a data="orientador" href="#" data-toggle="modal" data-target="#modalVerificarCPF">Orientador</a></li>
            <li><a data="avaliador" href="#" data-toggle="modal" data-target="#modalVerificarCPF">Avaliador</a></li>
            <li><a data="ouvinte" href="#" data-toggle="modal" data-target="#modalVerificarCPF">Ouvinte</a></li>
            <li><a data="voluntario" href="#" data-toggle="modal" data-target="#modalVerificarCPF" >Voluntário</a></li>
          </ul>
        </li>
        <!------------ Menu Login ------------>
        <li><a href="#" data-toggle="modal" data-target="#modalLogin">Login</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<?=$this->load->view('../../login/views/modal_login.html.php')?>
<?=$this->load->view('../../usuario/views/modal_verificar_cpf.html.php')?>

<script type="text/javascript" src="<?= base_url()?>content/home.js"></script>

<?=$this->load->view('../../../templates/footer.html.php')?>
