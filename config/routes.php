<?php  if ( ! defined('BASEPATH')) { exit('No direct script access allowed');}
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = 'home/home_ctr';
$route['404_override'] = 'login/login_ctr/erro_404';
/*
$route['home'] = 'home/home_ctr';


// Home
$route['home/vefificar_cpf/(:any)'] = 'home/home_ctr/verificar_cpf/$1';

// Login
$route['login'] = 'login/login_ctr';
$route['logout'] = 'login/login_ctr/logout';


// Inscrições
$route['home/verificar_cpf/(:any)'] = 'home/home_ctr/verificar_cpf/$1';
//$route[''] = '';

// Usuário
$route['usuario'] = 'usuario/usuario_ctr';

// Autor
$route['autor/inscricao/(:any)'] = 'usuario/autor_ctr/inscricao/$1';
$route['usuario/autor/fazer_inscricao'] = 'usuario/autor_ctr/fazer_inscricao';
$route['autor'] = 'usuario/autor_ctr';

// Curso
$route['curso'] = 'instituicao/curso';
$route['curso/create'] = 'instituicao/curso/create';
$route['curso/update'] = 'instituicao/curso/update';

// Organizador
$route['organizador'] = 'usuario/organizador';
$route['organizador/index'] = 'usuario/organizador/index';
$route['organizador/categoria'] = 'usuario/organizador/categoria';
$route['organizador/modalidade'] = 'usuario/organizador/modalidade';
$route['organizador/area_tematica'] = 'usuario/organizador/area_tematica';
$route['organizador/area_tematica/inserir_area_tematica'] = 'usuario/organizador/inserir_area_tematica';
$route['organizador/modalidade/inserir_modalidade'] = 'usuario/organizador/inserir_modalidade';
$route['organizador/categoria/inserir_categoria'] = 'usuario/organizador/inserir_categoria';
$route['organizador/categoria/delete'] = 'usuario/organizador/delete_categoria';
$route['organizador/modalidade/delete'] = 'usuario/organizador/delete_modalidade';
$route['organizador/area_tematica/delete'] = 'usuario/organizador/delete_area_tematica';

// Campus
$route['instituicao/campus'] = 'instituicao/campus_ctr';
$route['instituicao/campus/create'] = 'instituicao/campus_ctr/create';
$route['instituicao/campus/edit/(:num)'] = 'instituicao/campus_ctr/edit/$1';
$route['instituicao/campus/delete/(:num)'] = 'instituicao/campus_ctr/delete/$1';
$route['instituicao/campus/save'] = 'instituicao/campus_ctr/save';

*/
/* End of file routes.php */
/* Location: ./application/config/routes.php */
