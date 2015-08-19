<?php

$field_name = $vars['first_field']->getName();

$delete_template = "<html>
	<head>
        <meta http-equiv=\"Content-Type\" content=\"text/html;charset=utf-8\" />
		<title><?php echo \$heading ?> <?php echo \$title ?></title>
	</head>
	<body>
		<h1><?php echo \$heading ?> <?php echo \$title ?></h1>
        <?php echo form_open(\$this->uri->uri_string(), 'post') ?>
        Are you sure you want to delete <?php echo \$object->$field_name ?>?
        <?php echo form_submit('agree', 'Yes') ?>
        <?php echo form_submit('disagree', 'No') ?>
        <?php echo form_close() ?>
        <p>
            <?php echo anchor(\$this->uri->segment(1), 'Back') ?>
        </p>
	</body>
</html>";
