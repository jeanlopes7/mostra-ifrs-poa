<?=$this->load->view('../../../../templates/header.html.php')?>


<h1><?php echo $heading ?> <?php echo $title ?></h1>
        <?php echo form_open($this->uri->uri_string(), 'post') ?>
        Are you sure you want to delete <?php echo $object->getNome() ?>?
        <?php echo form_submit('agree', 'Yes') ?>
        <?php echo form_submit('disagree', 'No') ?>
        <?php echo form_close() ?>
        <p>
            <?php echo anchor($this->uri->segment(1), 'Back') ?>
        </p>
<?=$this->load->view('../../../../templates/footer.html.php')?>