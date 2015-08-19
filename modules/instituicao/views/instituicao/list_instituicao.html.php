<?=$this->load->view('../../../../templates/header.html.php')?>
		<h1><?php echo $heading ?> <?php echo $title ?></h1>
		<?php if($objects): ?>
		<table class="table-bordered">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Sigla</th>
					<th>Cidade</th>
					<th>Estado</th>
					<th>Site</th>
					<th>Tipo</th>

					<th>Editar</th>
					<th>Deletar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($objects as $object): ?>
				<tr>
					<td><?php echo $object->getNome() ?></td>
					<td><?php echo $object->getSigla() ?></td>
					<td><?php echo $object->getCidade() ?></td>
					<td><?php echo $object->getEstado() ?></td>
					<td><?php echo $object->getSite() ?></td>
					<td><?php echo $object->getTipo() ?></td>

					<td><a href="<?php echo site_url($this->uri->segment(1) . '/edit/' . $object->getIdInstituicao()) ?>">Editar</a></td>
					<td><a href="<?php echo site_url($this->uri->segment(1) . '/delete/' . $object->getIdInstituicao()) ?>">Deletar</a></td>
				</tr>
				<?php endforeach ?>
			</tbody>
        </table>
        <?php else: ?>
        <h5>Nenhum resultado encontrado.</h5>
		<?php endif ?>
        <p>
            <a href="<?php echo site_url($this->uri->segment(1) . '/instituicao_ctr/create/') ?>">Criar nova <?php echo $title ?></a>
        </p>
<?=$this->load->view('../../../../templates/footer.html.php')?>