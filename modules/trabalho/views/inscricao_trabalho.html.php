<?= $this->load->view('../../../templates/header.html.php') ?>
<?php /*?=modules::run('usuario/usuario_ctr/principal')*/?>
<?php /* echo set_breadcrumb();  */?>

<?php
/* @var $trabalho \Entity\Trabalho */
?>
<div class="tela_inscricao_trabalho">
<div class="text-center">
    <h4><?=$titulo_janela?></h4>
</div>

<form name="form_trabalho" id="form_trabalho" action="<?=$action_inscricao_edicao_trabalho?>" method="POST" class="form-horizontal" role="form">


  <input type="hidden" name="ctitulo" id="ctitulo" value="">
  <input type="hidden" name="cresumo" id="cresumo" value="">

  <div class="form-group">
          <label class="col-sm-2 control-label" for="titulo">Título</label>
          <div class="col-sm-10">
            <p class="info_inscr_trab">Apenas as formatações disponibilizadas nesta interface (negrito, itálico, subscrito e sobrescrito) são permitidas.</p>
                  <input type="text"  name="titulo" id="titulo" required="required" class="form-control" maxlength="250"  placeholder="Título do trabalho" autofocus value="">
          </div>
  </div>

</br>
  <div class="form-group">
          <label class="col-sm-2 control-label" for="resumo">Resumo</label>
          <div class="col-sm-10">
            <p class="info_inscr_trab">O resumo deverá ser escrito na forma de texto corrido, em único parágrafo, com até 3.000 caracteres
(incluindo os espaços), sem recuo de parágrafo no início das linhas, sem tabulações, sem marcadores ou
numeradores, sem timbre, cabeçalho ou rodapé, sem descrição das referências, sem inclusão de tabelas,
equações, desenhos e figuras.</p>
            <p class="info_inscr_trab">Apenas as formatações disponibilizadas nesta interface (negrito, itálico, subscrito e sobrescrito) são permitidas.</p>
                  <textarea name="resumo" id="resumo" class="form-control" rows="10" cols="30" required="required" ></textarea>	
          </div>		
  </div>	
  <!--
  <div class="form-group">
     
    <label for="palavras_chave" class="col-sm-2 control-label">Palavras-Chave</label>
  </div> -->

  <div class="form-group">
  <p class="p_chave">Palavras-Chave</p> 
    <label class="col-sm-2 control-label" for="palavra1">Palavra 1</label>
    <div class="col-sm-10">
      <input type="text" name="palavra1" id="palavra1" class="form-control" value="<?=$trabalho->getPalavra1()?>" />
    </div>

    <label class="col-sm-2 control-label" for="palavra2">Palavra 2</label>
    <div class="col-sm-10">
      <input type="text" name="palavra2" id="palavra2" class="form-control" value="<?=$trabalho->getPalavra2()?>"/>
    </div>

    <label class="col-sm-2 control-label" for="palavra3">Palavra 3</label>
    <div class="col-sm-10">
      <input type="text" name="palavra3" id="palavra3" class="form-control" value="<?=$trabalho->getPalavra3()?>"/>
    </div>

  </div>	

  <div class="form-group">
    <label class="col-sm-2 control-label" for="curso">Curso do autor principal: </label>
    <div class="col-sm-10">
      <select required class="form-control" id="id_curso_autor_principal" name="id_curso_autor_principal">
        <option value="">Selecione</option>
        <?php
        foreach ($cursos_autor_principal as $curso) {
          if ($curso->fk_curso == $id_curso_autor_principal) {
            $select = "selected";
          }
          else {
            $select = "";
          }
          echo "<option value='" . $curso->fk_curso . "' $select>" . $curso->nome_curso . "</option>";
        }
        ?>        
      </select>
    </div>
  </div>

  <div class="form-group">
   <label class="col-sm-2 control-label" for="email">E-mail a ser publicado no trabalho</label>
   <div class="col-sm-10">
   <input type="text" name="email_trabalho_autor_principal" required="required" class="form-control" value="<?php echo $email_trabalho_autor_principal;?>" />
   </div>
  </div>

  <div class="form-group">
    <label for="id_area" class="col-sm-2 control-label">Área tematica</label>
    <div class="col-sm-10">
      <select name="id_area" id="id_area" class="form-control" required="required">
        <option value="">Selecione um item da lista</option>
        <option value="1" <?php if ($trabalho->getArea()->getIdArea()==1) echo "SELECTED";?> >Ciências Exatas e da Terra</option>
        <option value="2" <?php if ($trabalho->getArea()->getIdArea()==2) echo "SELECTED";?> >Ciências Biológicas</option>
        <option value="3" <?php if ($trabalho->getArea()->getIdArea()==3) echo "SELECTED";?> >Engenharias</option>
        <option value="4" <?php if ($trabalho->getArea()->getIdArea()==4) echo "SELECTED";?> >Ciências da Saúde</option>
        <option value="5" <?php if ($trabalho->getArea()->getIdArea()==5) echo "SELECTED";?> >Ciências Agrárias</option>
        <option value="6" <?php if ($trabalho->getArea()->getIdArea()==6) echo "SELECTED";?> >Ciências Sociais Aplicadas</option>
        <option value="7" <?php if ($trabalho->getArea()->getIdArea()==7) echo "SELECTED";?> >Ciências Humanas</option>
        <option value="8" <?php if ($trabalho->getArea()->getIdArea()==8) echo "SELECTED";?> >Lingüística, Letras e Artes</option>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="id_categoria" class="col-sm-2 control-label">Categoria</label>
    <div class="col-sm-10">
      <select name="id_categoria" id="id_categoria" class="form-control" required="required">
        <option value="">Selecione um item da lista</option>
        <option value="1" <?php if ($trabalho->getCategoria()->getIdCategoria()==1) echo "SELECTED";?> >Relato de Experiência</option>
        <option value="2" <?php if ($trabalho->getCategoria()->getIdCategoria()==2) echo "SELECTED";?> >relato de Pesquisa</option>
        <option value="3" <?php if ($trabalho->getCategoria()->getIdCategoria()==3) echo "SELECTED";?> >Revisão de Literatura/Ensaio</option>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="id_modalidade" class="col-sm-2 control-label">Modalidade</label>
    <div class="col-sm-10">
      <select name="id_modalidade" id="id_modalidade" class="form-control" required="required">
        <option value="">Selecione um item da lista</option>
        <option value="1" <?php if ($trabalho->getModalidade()->getIdModalidade()==1) echo "SELECTED";?> >Oral</option>
        <option value="2" <?php if ($trabalho->getModalidade()->getIdModalidade()==2) echo "SELECTED";?> >Pôster</option>
      </select>
    </div>
  </div>	

  <div class="form-group">
    <label for="apoiadores" class="col-sm-2 control-label">Apoiadores</label>
    <div class="col-sm-10">
      <input type="text" name="apoiadores" id="apoiadores" class="form-control" value="<?=$trabalho->getApoiadores()?>" />
    </div>
  </div>


  <div class="form-group">

    <!-- <label for="turnos" class="col-sm-2 control-label">Turnos</label> -->
    <p class="info_turno">Turnos preferenciais para apresentação do trabalho (escolha três turnos diferentes):</p>
    <table class="inscr_trab_turno">
      <div class="col-sm-10">
      <tr>
         <td class="titulo_turno">Primeira preferência:</td>
         <td class="radio_turno"><input name="turno1" type="radio" value="M" <?php echo $trabalho->getTurno1()=='M'?"checked":""; ?>>Manhã</td>
         <td class="radio_turno"><input name="turno1" type="radio" value="T" <?php echo $trabalho->getTurno1()=='T'?"checked":""; ?>>Tarde</td>
         <td class="radio_turno"><input name="turno1" type="radio" value="N" <?php echo $trabalho->getTurno1()=='N'?"checked":""; ?>>Noite</td>
      </tr>

      <tr>         
         <td class="titulo_turno">Segunda preferência:</td>
         <td class="radio_turno"><input name="turno2" type="radio" value="M" <?php echo $trabalho->getTurno2()=='M'?"checked":""; ?>>Manhã</td>
         <td class="radio_turno"><input name="turno2" type="radio" value="T" <?php echo $trabalho->getTurno2()=='T'?"checked":""; ?>>Tarde</td>
         <td class="radio_turno"><input name="turno2" type="radio" value="N" <?php echo $trabalho->getTurno2()=='N'?"checked":""; ?>>Noite</td>
      </tr>
      <tr>         
         <td class="titulo_turno">Terceira preferência:</td>
         <td class="radio_turno"><input name="turno3" type="radio" value="M" <?php echo $trabalho->getTurno3()=='M'?"checked":""; ?>>Manhã</td>
         <td class="radio_turno"><input name="turno3" type="radio" value="T" <?php echo $trabalho->getTurno3()=='T'?"checked":""; ?>>Tarde</td>
         <td class="radio_turno"><input name="turno3" type="radio" value="N" <?php echo $trabalho->getTurno3()=='N'?"checked":""; ?>>Noite</td>
      </tr>

      </div>
    </table>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="form-group">
        
      <label class="col-sm-2 control-label" for="coautor">Coautores</label>
      <div class="col-sm-5">
        
        <!--Este campo contém o ID do autor principal do trabalho. É necessário para evitar que o próprio autor principal seja inserido como coautor.  -->
        <input id="autor_principal_id_aux" name="autor_principal_id_aux" type="text" style="display:none;" value="<?php echo $autor_principal_id_aux;?>"  />
        
        <?php
        $display_coautor[] = array();
        $total_coautores = 0;
        for ($i=0; $i<5; $i++) {
          if ($coautores_do_trabalho[$i] != '') {
             $display_coautor[$i]="visible";
             $total_coautores++;
          }
          else {
          $display_coautor[$i]="none";
          }
        }
        ?>

        <table class="alinha_caixas">
        <?php for ($i=0; $i<4; $i++): ?>
          <tr class="tr_co">
          <td class="caixa_co">
            <input id="coautor_nome<?=$i?>" type="text" style="display:<?=$display_coautor[$i]?>;" class="form-control" maxlength="250" readonly placeholder="coautor_nome1 opcional" value="<?=$coautores_do_trabalho[$i]->nome_usuario?>"/>
          </td>
          <input type="hidden" id="coautor_id<?=$i?>" name="coautores_id[]" value="<?=$coautores_do_trabalho[$i]->fk_autor?>">
          <input type="hidden" id="coautor_curso_id<?=$i?>" name="coautores_curso_id[]" value="<?=$coautores_do_trabalho[$i]->fk_curso?>">
          <input type="hidden" id="coautor_email<?=$i?>" name="coautores_email[]" value="<?=$coautores_do_trabalho[$i]->email_trabalho?>">
          <td class="caixa_botao">
            <button class="btn btn-default botao_remover_coautor" id="botao_remover_coautor<?=$i?>" data="<?=$i?>" style="display:<?=$display_coautor[$i]?>;" type="button">Remover</button>
          </td>
          <span class="input-group-btn"></span>
          <br />
          </tr>
        <?php endfor; ?>
        </table>
        <button class="btn btn-default botao_inserir_coautor" type="button">Inserir coautor no trabalho...</button>

        <br />
      </div>

      </div>
    </div>
  </div>


  <div class="panel panel-default">
    <div class="panel-body">
      <div class="form-group">
        
      <label class="col-sm-2 control-label" for="orientador">Orientadores</label>
      <div class="col-sm-5">
        
        <?php
        $display_orientador[] = array();
        $total_orientadores = 0;
        for ($i=0; $i<3; $i++) {
          if ($orientadores_do_trabalho[$i] != '') {
             $display_orientador[$i]="visible";
             $total_orientadores++;
          }
          else {
          $display_orientador[$i]="none";
          }
        }
        ?>

        <table class="alinha_caixas">
        <?php for ($i=0; $i<2; $i++):?>
          <tr class="tr_co">
          <td class="caixa_co"><input id="orientador_nome<?=$i?>" type="text" style="display:<?=$display_orientador[$i]?>;" class="form-control" maxlength="250" readonly placeholder="orientador_nome1 opcional" value="<?=$orientadores_do_trabalho[$i]->nome_usuario?>"/></td>
          <td class="caixa_botao"><button class="btn btn-default botao_remover_orientador" id="botao_remover_orientador<?=$i?>" data="<?=$i?>" style="display:<?=$display_orientador[$i]?>;" type="button">Remover</button></td>
          
          <input type="hidden" id="orientador_id<?=$i?>" name="orientadores_id[]" value="<?=$orientadores_do_trabalho[$i]->fk_orientador?>">
          <input type="hidden" id="orientador_campus_id<?=$i?>" name="orientadores_campus_id[]" value="<?=$orientadores_do_trabalho[$i]->fk_campus?>">
          <input type="hidden" id="orientador_email<?=$i?>" name="orientadores_email[]" value="<?=$orientadores_do_trabalho[$i]->email_trabalho?>">
          <span class="input-group-btn"></span>
          <br />
          </tr>
        <?php endfor;?>
        </table>
        <button class="btn btn-default botao_inserir_orientador" type="button">Inserir orientador no trabalho...</button>

        <br />
      </div>

      </div>
    </div>
  </div>

  <div class="form-group text-right">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="button" onclick="history.back()" class="btn btn-danger">Voltar</button>
      <!--
      <button type="submit" class="btn btn-primary">Enviar</button>
      -->
      <input type="button" class="btn btn-primary" onclick="testaSalvarTrabalho(<?=$trabalho->getIdTrabalho()?>)" value="Salvar trabalho">
    </div>
  </div>
  
</form>
<script src="<?=base_url()?>procedural/ckeditor/ckeditor.js" charset="utf-8"></script>

<script type="text/javascript">

  var total_coautores = <?php echo $total_coautores;?>;
  var total_orientadores = <?php echo $total_orientadores;?>;
  
  //CKEDITOR.replace('titulo');

  //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
  $(document).ready(function() {
    //getTituloTrabalho('<?=$trabalho->getIdTrabalho()?>');
    //getResumoTrabalho('<?=$trabalho->getIdTrabalho()?>');
  });

  $(function()
  {


    //Aqui configura a textarea titulo para ser um CKEDITOR.
    CKEDITOR.replace('titulo',
      {
        height: 50,
        width: 600,
        toolbarCanCollapse: false,
        removePlugins: 'elementspath', //remove tags da barra inferior (barra de status)
        resize_enabled: false,
        //autoParagrahp: false,
        enterMode : CKEDITOR.ENTER_BR,
        //allowedContent: 'b i;',
        toolbar:
          [
            ['Bold', 'Italic', 'Subscript', 'Superscript', 'RemoveFormat'],
            ['UIColor']
          ],
        on:
          {
            instanceReady: function(ev)
            {
              //Output paragraphs as <p>Text</p>.
              this.dataProcessor.writer.setRules('p',
                      {
                        indent: false,
                        breakBeforeOpen: false,
                        breakAfterOpen: false,
                        breakBeforeClose: false,
                        breakAfterClose: false
                      });
            //Tem que ser aqui, senão de vez em quando não carrega.
            getTituloTrabalho('<?=$trabalho->getIdTrabalho()?>');
            }
          }
      });//CKEditor titulo


    //Aqui configura a textarea resumo para ser um CKEDITOR.
    CKEDITOR.replace('resumo',
      {
        height: 400,
        width: 600,
        toolbarCanCollapse: false,
        removePlugins: 'elementspath',
        resize_enabled: false,
        toolbar:
                [
                  ['Bold', 'Italic', 'Subscript', 'Superscript', 'RemoveFormat'],
                  ['UIColor']
                ],

        on:
                {
                  instanceReady: function(ev)
                  {
                    // Output paragraphs as <p>Text</p>.
                    this.dataProcessor.writer.setRules('p',
                            {
                              indent: false,
                              breakBeforeOpen: false,
                              breakAfterOpen: false,
                              breakBeforeClose: false,
                              breakAfterClose: false
                            });
                    //Tem que ser aqui, senão de vez em quando não carrega.
                    getResumoTrabalho('<?=$trabalho->getIdTrabalho()?>');
                  }
                }
      });////CKEditor resumo

  }); //function()

function testaSalvarTrabalho(id_trabalho) {


    if (!validaTrabalho()) {
      return;
    }

    var form = $("#form_trabalho").serialize(); 

    var titulo = CKEDITOR.instances.titulo.getData();
    var resumo = CKEDITOR.instances.resumo.getData();


    ctitulo = encodeURIComponent(titulo);
    cresumo = encodeURIComponent(resumo);
    
    var str = new Array();
    //Aciciona os itens do formulário no array de string.
    str.push(form);
    str.push("titulo_ajax=" + ctitulo);
    str.push("resumo_ajax=" + cresumo);

    //Junta todos os elementos do array em uma única string, separados por &
    var str_join = str.join("&");

    $.ajax({
      type: "POST",
      url: "<?=base_url()?>"+"trabalho/trabalho_ctr/validaSalvar/"+id_trabalho, //tem o ID ou nao, depende do caso.
      data: str_join,
      success: function(data) {
          if (data == "ok") {
            salvarTrabalho();
          }
          else {
            alert(data);
          }
        }//sucess
    });
}

function salvarTrabalho() {

            var ctitulo = CKEDITOR.instances.titulo.getData();
            var cresumo = CKEDITOR.instances.resumo.getData();

            $('#ctitulo').val(ctitulo);
            $('#cresumo').val(cresumo);
            $('#form_trabalho').submit();



/*
    //transforma os dados do formulário em uma string no tipo item=valor&item=valor&item=valor...
    var form = $("#form_trabalho").serialize(); 

    var ctitulo = encodeURIComponent(titulo);
    var cresumo = encodeURIComponent(resumo);
    var str = new Array();
    //Aciciona os itens do formulário no array de string.
    str.push(form);
    str.push("ctitulo=" + encodeURIComponent(titulo));
    str.push("cresumo=" + encodeURIComponent(resumo));


    //Junta todos os elementos do array em uma única string, separados por &
    var str_join = str.join("&");

    //Como fazer uma chamada POST sem ser por Ajax e sem ser usando o form.submit?
    //...???????
    
    //$.post(
    //  '<?=base_url()."trabalho/trabalho_ctr/salvar_edicao".$trabalho->id_trabalho?>',
    //  str.join("&")
    //  );
    
    $.ajax({
      type: "POST",
      url: "<?=$action_inscricao_edicao_trabalho?>", //tem o ID ou nao, depende do caso.
      data: str_join,
      success: function(data) {
          document.body.innerHTML=data;
        }
    });
    
    */

  }//salvarTrabalho()

  function validaTrabalho() {
    h = document.form_trabalho;

    var titulo = CKEDITOR.instances.titulo.getData();
    var resumo = CKEDITOR.instances.resumo.getData();
    
    if (titulo =="") {
      alert("Por favor, preencha o título.");
      return false;
    }
    
     if (resumo == "") {
       alert("Por favor, preencha o resumo.");
       return false;
     }
     
     if(h.palavra1.value == "") {
       alert('Por favor, preencha a primeira palavra-chave do trabalho.');
       h.palavra1.focus();
       return false;
     }
     
     if(h.palavra2.value == "") {
       alert('Por favor, preencha a segunda palavra-chave do trabalho.');
       h.palavra2.focus();
       return false;
     }
     
     if(h.palavra3.value == "") {
       alert('Por favor, preencha a terceira palavra-chave do trabalho.');
       h.palavra3.focus();
       return false;
     }

    if (h.id_curso_autor_principal.value == "") {
      alert('Por favor, selecione o Curso do autor principal.');
      //h.curso.focus();
      return false;
    }

    if (h.email_trabalho_autor_principal.value == "") {
      alert('Por favor, preencha o email do trabalho.');
      h.email_trabalho.focus();
      return false;
    }
    
    if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(h.email_trabalho_autor_principal.value))) {
      alert("Favor digitar um endereço de e-mail válido.");
      h.email_trabalho_autor_principal.focus();
      return false;
    }
    if (h.id_area.value == "") {
      alert('Por favor, selecione a área temática do trabalho.');
      h.id_area.focus();
      return false;
    }
    if (h.id_categoria.value == "") {
      alert('Por favor, selecione a categoria do trabalho.');
      h.id_categoria.focus();
      return false;
    }
    if (h.id_modalidade.value == "") {
      alert('Por favor, selecione a modalidade do trabalho.');
      h.id_modalidade.focus();
      return false;
    }
    
    turno1 = h.turno1[0].checked + h.turno1[1].checked*2 + h.turno1[2].checked*4;
    turno2 = h.turno2[0].checked + h.turno2[1].checked*2 + h.turno2[2].checked*4;
    turno3 = h.turno3[0].checked + h.turno3[1].checked*2 + h.turno3[2].checked*4;
    if ( (turno1 + turno2 + turno3) != 7 ) {
      alert('Você deve escolher obrigatoriamente três turnos diferentes para apresentação.');
      return false;
    }
    
    if (turno1 == 0) {
      alert('Por favor, selecione o primeiro turno preferencial.');
      h.turno1.focus();
      return false;
    }
    if (turno2 == 0) {
      alert('Por favor, selecione o segundo turno preferencial.');
      h.turno2.focus();
      return false;
    }
    if (turno3 == 0) {
      alert('Por favor, selecione o terceiro turno preferencial.');
      h.turno3.focus();
      return false;
    }
    
    /*
     if(h.apoiadores.value == "") {
     alert('Por favor, preencha o campo "apoiadores" do trabalho.');
     h.apoiadores.focus();
     return false;
     }
     */


    //Verifica se a modalidade é permitida.
    //???<<<<<<<<<<<<<<<<<<<<<<<
    
    return true;
  }//validaTrabalho()


  function getTituloTrabalho(id_trabalho){
    if (id_trabalho > 0) {
      $.ajax({
        type: "GET",
        url: "<?=base_url()?>"+"trabalho/trabalho_ctr/get_titulo/"+id_trabalho,
        success: function(data) {
          CKEDITOR.instances.titulo.setData(data);
        }
      });
    }//if
  }

  function getResumoTrabalho(id_trabalho){
    if (id_trabalho > 0) {
      $.ajax({
        type: "GET",
        url: "<?=base_url()?>"+"trabalho/trabalho_ctr/get_resumo/"+id_trabalho,
        success: function(data) {
          CKEDITOR.instances.resumo.setData(data);
        }
      });
    }//if
  }

</script>

<?=$this->load->view('./modal_buscar_coautor.html.php')?>
<?=$this->load->view('./modal_buscar_orientador.html.php')?>
<script src="<?=base_url()?>content/trabalho.js" type="text/javascript"></script>
</div>
<?=$this->load->view('../../../templates/footer.html.php')?>