<?=$this->load->view('../../../../templates/header.html.php')?>

		<h1><?php echo $heading ?> <?php echo $title ?></h1>
		<?php if($objects): ?>
		<table>
			<thead>
				<tr>
					<th>Nome</th>

					<th>Editar</th>
					<th>Deletar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($objects as $object): ?>
				<tr>
					<td><?php echo $object->getNome() ?></td>

					<td><a href="<?php echo site_url($this->uri->segment(1) . '/campus/edit/' . $object->getIdCampus()) ?>">Editar</a></td>
					<td><a href="<?php echo site_url($this->uri->segment(1) . '/campus/delete/' . $object->getIdCampus()) ?>">Deletar</a></td>
				</tr>
				<?php endforeach ?>
			</tbody>
        </table>
        <?php else: ?>
        <h3>Nenhum resultado encontrado</h3>
		<?php endif ?>
        <p>
            <a href="<?php echo site_url($this->uri->segment(1) . '/campus/create/') ?>">Criar novo <?php echo strtolower($title);  ?></a>
        </p>

<?=$this->load->view('../../../../templates/footer.html.php')?>