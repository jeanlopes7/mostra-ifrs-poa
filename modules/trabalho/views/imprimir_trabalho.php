<?php
include("../../../config/database.php");
//include("../funcoes.php");
// Função para converter o título para maiúsculo 20110911

function converte_maiuscula($texto)
{
   $tamanho_total = strlen($texto);
   $contador = 0;
   $flag_contar = "s";
   $caractere_final="";
   $texto__maiusculo="";
   while ($contador<$tamanho_total)
      {
	     if (substr($texto,$contador,1)=="<")
            {
                $texto__maiusculo=$texto__maiusculo.substr($texto,$contador,1);
				$contador++;
			    $caractere_final=">";
                $flag_contar = "n";
			}		 
	     if (substr($texto,$contador,1)=="&")
            {
                $texto__maiusculo=$texto__maiusculo.substr($texto,$contador,1);
                $contador++;
				$texto__maiusculo=$texto__maiusculo.strtoupper(substr($texto,$contador,1));
				$contador++;
			    $caractere_final=";";
                $flag_contar = "n";
			}		 
	     if ($flag_contar == "s")
            {
                $texto__maiusculo=$texto__maiusculo.strtoupper(substr($texto,$contador,1));
			}		 
		 else
            {
                $texto__maiusculo=$texto__maiusculo.substr($texto,$contador,1);
			}		 
        $contador++;
	     if (substr($texto,$contador,1)==$caractere_final)
            {
                $texto__maiusculo=$texto__maiusculo.substr($texto,$contador,1);
                $contador++;
                $flag_contar = "s";
			}		 
	  } 
   $texto__maiusculo=str_replace("&Nbsp;", " ",$texto__maiusculo); // Atualizado em 20111010 por CRM
   return $texto__maiusculo;
}

$id_trabalho=$_REQUEST['id_trabalho'];

$var_html="<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'><style> p {  text-align: justify; } </style></head><body>";


//<<<<<<<<<<<<<<<<<<<???????????????????? Trabalho onde usa??????????????????
//$sql= "SELECT trabalho.* FROM trabalho WHERE (ativo=0) AND (aceito=1) AND (id_trabalho=".$id_trabalho.") ";
$sql= "SELECT t.id_trabalho, t.fk_modalidade, t.fk_area, t.fk_categoria, t.status, t.nivel, t.palavra1,
t.palavra2, t.palavra3, t.apoiadores, t.titulo, upper(t.titulo_ordenar) as titulo_ordenar, t.resumo  FROM trabalho t WHERE (t.id_trabalho=".$id_trabalho.") ";
$result = mysql_query($sql,$conexao) or die(mysql_error());
$num_reg = mysql_num_rows($result);
$linha = mysql_fetch_array($result); 

//Autores
$sql= "SELECT DISTINCT tac.email_trabalho, tac.fk_curso, tac.seq, u.nome  ".
      "FROM trabalho_autor_curso tac ".
      "INNER JOIN autor_curso ac ON ac.fk_autor=tac.fk_autor ".
      "INNER JOIN autor a ON a.fk_usuario=ac.fk_autor ".
      "INNER JOIN usuario u ON u.id_usuario=a.fk_usuario ".
      "WHERE tac.fk_trabalho=".$id_trabalho." ORDER BY tac.seq ";
$result = mysql_query($sql,$conexao) or die(mysql_error());
$num_reg = mysql_num_rows($result);
//$autores = mysql_fetch_array($result); 

$lista_do_grupo_nome="";
$lista_do_grupo_email="";
$virgula="";
$virgula2="";
$fk_curso = 0;
while($autores = mysql_fetch_array($result))
  {
     if (trim($autores['nome'])!="")
        { 
		   $lista_do_grupo_nome=$lista_do_grupo_nome.$virgula.$autores['nome'];
           $virgula=", ";
        }
     if (trim($autores['email_trabalho'])!="")
        { 
		   $lista_do_grupo_email=$lista_do_grupo_email.$virgula2.$autores['email_trabalho'];
           $virgula2=", ";
        }
     if (trim((int)$autores['seq'])==1)
        { 
           $fk_curso = (int)$autores['fk_curso'];
        }
  }

//Orientadores
$sql= "SELECT toc.email_trabalho, u.nome FROM trabalho_orientador_campus toc ".
      "INNER JOIN orientador_campus oc ON oc.fk_orientador=toc.fk_orientador ".
      "INNER JOIN orientador o ON o.fk_usuario=oc.fk_orientador ".
      "INNER JOIN usuario u ON u.id_usuario=o.fk_usuario ".
      "WHERE toc.fk_trabalho=".$id_trabalho." ORDER BY toc.seq";
//$result = mysql_query($sql,$conexao) or die(mysql_error());

$result = mysql_query($sql,$conexao);
$num_reg = mysql_num_rows($result);
//$orientadores = mysql_fetch_array($result); 

while($orientadores = mysql_fetch_array($result))
  {
     if (trim($orientadores['nome'])!="")
        { 
		   $lista_do_grupo_nome=$lista_do_grupo_nome.$virgula.$orientadores['nome']."(orient)";
           $virgula=", ";
        }
     if (trim($orientadores['email_trabalho'])!="")
        { 
		   $lista_do_grupo_email=$lista_do_grupo_email.$virgula2.$orientadores['email_trabalho'];
           $virgula2=", ";
        }
  }

//Curso
$sql1 = "SELECT * FROM curso WHERE (id_curso=".$fk_curso.") ";
$result1 = mysql_query($sql1,$conexao);
$num1 = mysql_num_rows($result1);
$linha1 = mysql_fetch_array($result1);

$fk_campus    = $linha1['fk_campus'];

$sql2 = "SELECT * FROM campus WHERE (id_campus=".$fk_campus.") ";
$result2 = mysql_query($sql2,$conexao);
$num2 = mysql_num_rows($result2);
$linha2 = mysql_fetch_array($result2);

$campus_nome = $linha2['nome'];
$fk_instituicao = $linha2['fk_instituicao'];

$sql3 = "SELECT * FROM instituicao WHERE (id_instituicao=".$fk_instituicao.") ";
$result3 = mysql_query($sql3,$conexao);
$num3 = mysql_num_rows($result3);
$linha3 = mysql_fetch_array($result3);

$instituicao_nome = $linha3['nome'];

$array_tematica = array();

$array_tematica[0]  = " - ";
$array_tematica[1]  = "Ambiente, Saúde e Segurança";
$array_tematica[2]  = "Ciências Humanas e Educação";
$array_tematica[3]  = "Controle e Processos Industriais";
$array_tematica[4]  = "Gestão e Negócios";
$array_tematica[5]  = "Hospitalidade e Lazer";
$array_tematica[6]  = "Informação e Comunicação";
$array_tematica[7]  = "Infraestrutura";
$array_tematica[8]  = "Militar";
$array_tematica[9]  = "Produção Alimentícia";
$array_tematica[10] = "Produção Cultural e Design";
$array_tematica[11] = "Produção Industrial";
$array_tematica[12] = "Recursos Naturais";

$array_categoria = array();

$array_categoria[0] = " - ";
$array_categoria[1] = "Relato de Experiência";
$array_categoria[2] = "Relato de Pesquisa";
$array_categoria[3] = "Revisão de Literatura/Ensaio";


$array_modalidade = array();

$array_modalidade[0] = " - ";
$array_modalidade[1] = "Apresentação Oral";
$array_modalidade[2] = "Apresentação de Pôster";

$array_palavra = array();

$array_palavra[0] = $linha['palavra1'];
$array_palavra[1] = $linha['palavra2'];
$array_palavra[2] = $linha['palavra3'];

$palavra_txt = "";
$virgula = "";
$contador = 0;
for ($contador = 0; $contador < 3; $contador++)
    {
        if (trim($array_palavra[$contador])!="")
           { 
		      $palavra_txt=$palavra_txt.$virgula.$array_palavra[$contador];
              $virgula=", ";
           }
	} 

	
$cabecalho_tabela = "<table width='500' border='0' cellpadding='3' cellspacing='0' align='center'>";
$var_html=$var_html.$cabecalho_tabela;
$var_html=$var_html."<tr><td align='left' bgcolor='#ffffff'><img src='Logo_IF_Campus_POA_2cm.png' border='0' align='left'><br><br></td><td align='right' valign='top' bgcolor='#ffffff' width='345' style='font-size: 10px;'>
Trabalho aceito para apresentação na 16ª Mostra de Pesquisa, Ensino e Extensão<br>
Instituto Federal de Educação, Ciência e Tecnologia do Rio Grande do Sul<br>
Câmpus Porto Alegre<br>
28 e 29 de setembro de 2015<br><br><br>
Trabalho Número: ".str_pad($id_trabalho, 2, STR_PAD_LEFT).
"</td></tr></table>";

//<td align='right' style='font-size: 10px;'>Trabalho Número: ".str_pad($id_trabalho, 3, "0", STR_PAD_LEFT)."</td></tr></table>";

$var_html=$var_html.$cabecalho_tabela;
//$var_html=$var_html."<tr><td align='center' bgcolor='#ffffff'><center><p style='text-align: center;'><b>".converte_maiuscula($linha['titulo'])."</b></p></center><br><br></td></tr>";

$var_html=$var_html."<tr><td align='center' valign='top' bgcolor='#ffffff'><b>".$linha['titulo_ordenar']."</b><br><br></td></tr>";

//$var_html=$var_html."<tr><td align='center' bgcolor='#ffffff'><center><p style='text-align: center;'><b>".$linha['titulo_ordenar']."</b></p></center><br><br></td></tr>";

//$lista_do_grupo_nome=montar_lista($id_trabalho,"f_nome",$conexao)."<br><br>";

$var_html=$var_html."<tr><td align='center' bgcolor='#ffffff' style='font-size:16px;'>".$lista_do_grupo_nome."</td></tr>";  

//$lista_do_grupo_email=montar_lista($id_trabalho,"f_email",$conexao)."<br><br>";

$var_html=$var_html."<tr><td align='center' bgcolor='#ffffff' style='font-size:16px;'>".$lista_do_grupo_email."<br><br></td></tr>";  

$var_html=$var_html."<tr><td align='center' bgcolor='#ffffff' style='font-size:16px;'>Instituição:&nbsp;".$instituicao_nome."</td></tr>";  
$var_html=$var_html."<tr><td align='center' bgcolor='#ffffff' style='font-size:16px;'>Câmpus:&nbsp;".$campus_nome."<br><br></td></tr></table>";  

//$palavra_txt
//$var_html=$var_html."<tr><td align='left' bgcolor='#ffffff' style='font-size:16px;'>Palavras-chave:&nbsp;".$linha['palavra1'].", ".$linha['palavra2'].", ".$linha['palavra3']."<br><br></td></tr>";  

$var_html=$var_html."<p style='padding: 20px;'>".$linha['resumo']."</p>";

$var_html=$var_html.$cabecalho_tabela."<tr><td align='left' bgcolor='#ffffff' style='font-size:16px;'>Palavras-chave:&nbsp;".$palavra_txt."<br></td></tr>";  

//$var_html=$var_html."<tr><td align='left' bgcolor='#ffffff' style='font-size:16px; text-align:justify;'><p>".$linha['f_resumo']."</p><br><br></td></tr>";  

/*
$var_html=$var_html."<table width='500' border='0' cellpadding='3' cellspacing='0' align='center'><tr><td align='left' bgcolor='#ffffff' style='font-size:16px;'>Temática:&nbsp;".$array_tematica[(int)$linha['tematica']]."<br><br></td></tr>";  
$var_html=$var_html."<tr><td align='left' bgcolor='#ffffff' style='font-size:16px;'>Categoria:&nbsp;".$array_categoria[(int)$linha['categoria']]."<br><br></td></tr>";  
$var_html=$var_html."<tr><td align='left' bgcolor='#ffffff' style='font-size:16px;'>Modalidade de apresentação:&nbsp;".$array_modalidade[(int)$linha['modalidade']]."<br><br></td></tr>";  
*/

$var_html=$var_html."<tr><td align='left' bgcolor='#ffffff' style='font-size:16px;'>Apoiadores:&nbsp;".$linha['apoiadores']."<br><br></td></tr></table></body></html>";  

//echo $var_html;


require_once("../dompdf6/dompdf_config.inc.php");

$local = array("::1", "127.0.0.1");
$is_local = in_array($_SERVER['REMOTE_ADDR'], $local);

if ( get_magic_quotes_gpc() )
   {
        $var_html = stripslashes($var_html);
   } 
  $dompdf = new DOMPDF();
  $dompdf->load_html($var_html);
  $dompdf->set_paper("a4","portrait");
  $dompdf->render();

  //$dompdf->stream("dompdf_out.pdf", array("Attachment" => true));
  //$dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
  
  $dompdf->stream("trab_".str_pad($id_trabalho, 3, "0", STR_PAD_LEFT).".pdf", array("Attachment" => false));

  exit(0);

?>