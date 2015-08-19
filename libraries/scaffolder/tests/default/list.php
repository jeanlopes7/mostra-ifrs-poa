<?php

$list_template = "<html>
	<head>
        <meta http-equiv=\"Content-Type\" content=\"text/html;charset=utf-8\" />
		<title><?php echo \$heading ?> <?php echo \$title ?></title>
	</head>
	<body>
		<h1><?php echo \$heading ?> <?php echo \$title ?></h1>
		<?php if(\$objects): ?>
		<table>
			<thead>
				<tr>
					<th>Nome</th>
					<th>Alias</th>
					<th>Estado_id</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach(\$objects as \$object): ?>
				<tr>
					<td><?php echo \$object->nome ?></td>
					<td><?php echo \$object->alias ?></td>
					<td><?php echo \$object->estado_id ?></td>
					<td><a href=\"<?php echo site_url(\$this->uri->segment(1) . '/edit/' . \$object->id) ?>\">Edit</a></td>
					<td><a href=\"<?php echo site_url(\$this->uri->segment(1) . '/delete/' . \$object->id) ?>\">Delete</a></td>
				</tr>
				<?php endforeach ?>
			</tbody>
        </table>
        <?php else: ?>
        <h3>No results found</h3>
		<?php endif ?>
        <p>
            <a href=\"<?php echo site_url(\$this->uri->segment(1) . '/create/') ?>\">Create new <?php echo \$title ?></a>
        </p>
	</body>
</html>";
