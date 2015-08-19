<?php

$save_template = "<html>
	<head>
        <meta http-equiv=\"Content-Type\" content=\"text/html;charset=utf-8\" />
		<title><?php echo \$heading ?> <?php echo \$title ?></title>
	</head>
	<body>
		<h1><?php echo \$heading ?> <?php echo \$title ?></h1>
        <?php if(\$msg): ?>
        <p><?php echo \$msg ?></p>
        <?php endif ?>
        <?php include('form_campus.html.php') ?>
        <p>
            <?php echo anchor(\$this->uri->segment(1), 'Back') ?>
        </p>
	</body>
</html>
";
