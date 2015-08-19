<?=$this->load->view('../../../../templates/header.html.php')?>
		<h1><?php echo $heading ?> <?php echo $title ?></h1>
        <?php if($msg): ?>
        <p><?php echo $msg ?></p>
        <?php endif ?>
        <?php include('form_campus.html.php') ?>
        <p>
            <?php echo anchor($this->uri->segment(1).'/campus', 'Back') ?>
        </p>
<?=$this->load->view('../../../../templates/footer.html.php')?>