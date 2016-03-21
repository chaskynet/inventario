<?php
defined ('BASEPATH') OR exit ('no direct scripts allowed');

/**
* 
*/
class Main extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Articulos_model');
	}

	/*************************************************************/
	public function index(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->view('main_view');
		} else{
			$this->login();
		}
	}

	/**
	*
	*
	**/
	public function login(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->view('main_view');
		} else{
			// $this->load->model('Almacenes_model');
			// $lista_almacenes['almacenes'] = $this->Almacenes_model->lista_almacenes();
			$this->load->view('login_view');
		}
	}

	public function principal(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->view('main_view');
		} else{
			redirect('main/restringido');
		}
	}

	public function restringido(){
		$this->load->view('restringido');
	}

	/**
	*
	*/
	public function login_validation(){
		
		$this->form_validation->set_rules('usuario', 'Usuario', 'required|trim|callback_validar_credenciales');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		if($this->form_validation->run()){
			$this->load->model('Usuarios_model');
			$this->load->model('Almacenes_model');
			$permisos = $this->Usuarios_model->permisos($this->input->post('usuario'), $this->input->post('password'));
			$almacen = $this->Almacenes_model->almacen($this->input->post('almacen'));
			$data = array('usuario' => $this->input->post('usuario'),
					'permisos' => $permisos, //json_encode($permisos),
					'is_logged_in' => 1
					);
			$this->session->set_userdata($data);
			redirect('main/principal');
		} else{
			
			$this->load->view('login_view');
		}
	}

	/**
	*
	*/
	public function validar_credenciales(){
		$this->load->model('Usuarios_model');

		if($this->Usuarios_model->puede_entrar() == 1 ){

			return true;
		} elseif($this->Usuarios_model->puede_entrar() == 2 ){
			$this->form_validation->set_message('validar_credenciales', 'Usuario Bloqueado!');
			return false;
		} elseif ($this->Usuarios_model->puede_entrar() == 3 ) {
			$this->form_validation->set_message('validar_credenciales', 'Usuario Inactivo');
			return false;
		}
		else{
			$this->form_validation->set_message('validar_credenciales', 'Usuario/Password incorrectos!');
			return false;
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('main/login');
	}
	//------------ Fin modulo Login y Logout ---

	public function cuerpo(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->view('cuerpo_view');
		} else{
			redirect('main/restringido');
		}
	}

	/**
	*
	*/
	public function carga_inventario(){
		if ($this->session->userdata('is_logged_in')){			
			$articulos['articulo'] = $this->Articulos_model->lista_inventario();
			$this->load->model('Almacenes_model');
			$articulos['almacenes'] = $this->Almacenes_model->codigo_almacen();
			$this->load->view('inventario_view', $articulos);
		} else{
			redirect('main/restringido');
		}
	}

	/**
	*
	*/
	public function carga_salida(){
		if ($this->session->userdata('is_logged_in')){
			$notas_salida['notas_salida'] = $this->Articulos_model->lista_notas_salida();
			$this->load->view('salidas_view', $notas_salida);
		} else{
			redirect('main/restringido');
		}
	}

	/**
	*
	*/
	public function carga_entrada(){
		if ($this->session->userdata('is_logged_in')){
			$notas_entrada['notas_entrada'] = $this->Articulos_model->lista_notas_entrada();
			$this->load->view('entradas_view', $notas_entrada);
		} else{
			redirect('main/restringido');
		}
	}

	/**
	* Desc: Sección para la creacion de Usuarios
	*/
	public function creacion_usuarios(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Usuarios_model');

			$lista_usuarios['usuarios'] = $this->Usuarios_model->lista_usuarios();
			$this->load->view('creacion_usuarios_view', $lista_usuarios);
		} else{
			redirect('main/restringido');
		}
	}

	public function nuevo_usuario(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Usuarios_model');
			$nuevo_usuario = $this->Usuarios_model->nuevo_usuario($_POST['data']);
			
			echo $nuevo_usuario;
			
		} else{
			redirect('main/restringido');
		}
	}

	public function carga_datos_usuario(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Usuarios_model');
			$nuevo_usuario = $this->Usuarios_model->carga_datos_usuario($_POST['data']);
			$lista_permisos = $this->Usuarios_model->carga_permisos_usuario($_POST['data']);
			$datos_usuario['datos_usuario'] = $nuevo_usuario;
			$datos_usuario['permisos'] = $lista_permisos;
			//echo json_encode($nuevo_usuario);
			echo json_encode($datos_usuario);
		} else{
			redirect('main/restringido');
		}
	}

	public function actualizar_usuario(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Usuarios_model');

			$actualizar_usuario = $this->Usuarios_model->actualizar_usuario($_POST['data']);
			echo json_encode($actualizar_usuario);
		} else{
			redirect('main/restringido');
		}
	}

	public function elimina_usuario(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Usuarios_model');

			$elimina_usuario = $this->Usuarios_model->elimina_usuario($_POST['data']);
			echo $elimina_usuario;
		} else{
			redirect('main/restringido');
		}
	}
	//********************************************

	/**
	*
	*/
	public function numero_nota(){
		if ($this->session->userdata('is_logged_in')){
			$numero_nota = $this->Articulos_model->numero_nota($_GET['data']);
			echo json_encode($numero_nota);
		} else{
			redirect('main/restringido');
		}
	}

	public function busca_articulo(){
		if ($this->session->userdata('is_logged_in')){
			$articulos = $this->Articulos_model->busca_articulo($_POST['data']);
			echo json_encode($articulos);
		} else{
			redirect('main/restringido');
		}
	}
	public function buscar_almacen_invi(){
		if ($this->session->userdata('is_logged_in')){
			$articulos = $this->Articulos_model->buscar_almacen_invi($_POST['data']);
			echo json_encode($articulos);
		} else{
			redirect('main/restringido');
		}
	}

	public function busca_articulo_invi(){
		if ($this->session->userdata('is_logged_in')){
			$articulos = $this->Articulos_model->busca_articulo_invi($_POST['data']);
			echo json_encode($articulos);
		} else{
			redirect('main/restringido');
		}
	}

	public function busca_articulo_existencias(){
		if ($this->session->userdata('is_logged_in')){
			$articulos = $this->Articulos_model->busca_articulo_existencias($_POST['data']);
			echo json_encode($articulos);
		} else{
			redirect('main/restringido');
		}
	}
	/**
	*
	*
	*/
	public function guarda_nota_salida(){
		if ($this->session->userdata('is_logged_in')){
			$guarda_nota_salida = $this->Articulos_model->guarda_nota_salida($_POST['data'], $_POST['modo_edicion']);
			echo $guarda_nota_salida;
		} else{
			redirect('main/restringido');
		}
		
	}

	/**
	*
	*
	*/
	public function trae_nota_salida(){
		if ($this->session->userdata('is_logged_in')){
			$trae_nota_salida = $this->Articulos_model->trae_nota_salida($_POST['data']);
			echo json_encode($trae_nota_salida);
		} else{
			redirect('main/restringido');
		}
	}

	/**
	*
	*
	*/
	public function trae_nota_entrada(){
		if ($this->session->userdata('is_logged_in')){
			$trae_nota_entrada = $this->Articulos_model->trae_nota_entrada($_POST['data']);
			echo json_encode($trae_nota_entrada);
		} else{
			redirect('main/restringido');
		}
	}

	/**
	*
	*
	*/
	public function guarda_nota_entrada(){
		if ($this->session->userdata('is_logged_in')){
			$guarda_nota_salida = $this->Articulos_model->guarda_nota_entrada($_POST['data'], $_POST['modo_edicion']);
			echo $guarda_nota_salida;
		} else{
			redirect('main/restringido');
		}
	}

	/**
	* Elimina articulo en Entradas y Salias actualiza las cantidades en Inventarios
	*
	*/
	public function eliminina_art_editada(){
		if ($this->session->userdata('is_logged_in')){
			$eliminina_art_editada = $this->Articulos_model->eliminina_art_editada($_POST['data']);
			echo $eliminina_art_editada;
		} else{
			redirect('main/restringido');
		}
	}

	/**
	*
	*
	*/
	public function to_pdf_nota_salida(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->library('MPDF53/Mpdf');
			ob_clean();
			$mpdf = new mPDF('utf-8', 'Letter');
			$data['num_nota_salida'] = $this->input->post('h_nota_salida');
			$data['usuario'] = $this->session->userdata('usuario');
			$data['fecha'] = date('d/m/Y');
			$data['datos_nota_salida'] = $this->Articulos_model->trae_nota_salida($this->input->post('h_nota_salida'));
			//
			$mpdf->setFooter('{PAGENO}');
			//
			$mpdf->WriteHTML($this->load->view('pdf_notas_salida', $data, true));
			$mpdf->Output();

		} else{
			redirect('main/restringido');
		}
	}

	/**
	*
	*
	*/
	public function to_pdf_nota_entrada($id_nota){
		if ($this->session->userdata('is_logged_in')){
			$this->load->library('MPDF53/Mpdf');
			$mpdf = new mPDF('utf-8', 'Letter');
			$data['num_nota_entrada'] = $this->input->post('h_nota_entrada');
			$data['usuario'] = $this->session->userdata('usuario');
			$data['fecha'] = date('d/m/Y');
			$data['datos_nota_entrada'] = $this->Articulos_model->trae_nota_entrada($this->input->post('h_nota_entrada'));
			//
			$mpdf->setFooter('{PAGENO}');
			//
			$mpdf->WriteHTML($this->load->view('pdf_notas_entrada', $data, true));
			ob_clean();
			$mpdf->Output();

		} else{
			redirect('main/restringido');
		}
	}

	/**
	*
	*
	*/
	public function to_pdf_main_search(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->library('MPDF53/Mpdf');
			$mpdf = new mPDF('utf-8', 'Letter');
			$data['usuario'] = $this->session->userdata('usuario');
			$data['fecha'] = date('d/m/Y');
			$data['datos_main_search'] = $this->Articulos_model->busca_articulo_conteo($this->input->post('buscar'),  $this->input->post('buscar_almacen'));
			$mpdf->setFooter('{PAGENO}');
			$mpdf->WriteHTML($this->load->view('pdf_main_search', $data, true));
			ob_clean();
			$mpdf->Output();

		} else{
			redirect('main/restringido');
		}
	}

	/**
	*
	*
	*/
	public function to_pdf_search_invini(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->library('MPDF53/Mpdf');
			$mpdf = new mPDF('utf-8', 'Letter');

			$data['usuario'] = $this->session->userdata('usuario');
			$data['fecha'] = date('d/m/Y');
			$data['datos_main_search'] = $this->Articulos_model->busca_articulo_conteo($this->input->post('buscar_invini'),  $this->input->post('buscar_almacen_invi'));
			$mpdf->setHeader('{PAGENO}');
			$mpdf->WriteHTML($this->load->view('pdf_search_invini', $data, true));
			ob_clean();
			$mpdf->Output();

		} else{
			redirect('main/restringido');
		}
	}

	/**
	*
	*
	*/
	public function to_pdf_search_conteo(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->library('MPDF53/Mpdf');
			$mpdf = new mPDF('utf-8', 'Letter');
			$data['usuario'] = $this->session->userdata('usuario');
			$data['fecha'] = date('d/m/Y');

			$data['datos_main_search'] = $this->Articulos_model->busca_articulo_conteo($this->input->post('buscar_para_conteo'),  $this->input->post('buscar_almacen_conteo'));
			$mpdf->setHeader('{PAGENO}');
			$mpdf->WriteHTML($this->load->view('pdf_search_conteo', $data, true));
			ob_clean();
			$mpdf->Output();

		} else{
			redirect('main/restringido');
		}
	}

	/**
	*
	*
	*/
	public function to_pdf_search_movimiento(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->library('MPDF53/Mpdf');
			$mpdf = new mPDF('utf-8', 'Letter');
			$data['usuario'] = $this->session->userdata('usuario');
			$data['fecha'] = date('d/m/Y');
			$data['datos_main_search'] = $this->Articulos_model->busca_articulo_movimiento_pdf($this->input->post('buscar_movimiento'), $this->input->post('buscar_almacen_kardex'));
			//
			$mpdf->setHeader('{PAGENO}');
			//
			$mpdf->WriteHTML($this->load->view('pdf_search_movimiento', $data, true));
			ob_clean();
			$mpdf->Output();

		} else{
			redirect('main/restringido');
		}
	}

	/**
	*
	*
	*/
	public function to_pdf_kardex(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->library('MPDF53/Mpdf');
			$mpdf = new mPDF('utf-8', 'Letter');
			$data['usuario'] = $this->session->userdata('usuario');
			$data['fecha'] = date('d/m/Y');
			$data['data_articulo'] = $this->Articulos_model->kardex_articulo_desc($this->input->post('buscar_para_kardex'));
			$data['datos_main_search'] = $this->Articulos_model->kardex_articulo($this->input->post('buscar_para_kardex'));
			
			$mpdf->setHeader('{PAGENO}');

			$mpdf->WriteHTML($this->load->view('pdf_kardex', $data, true));
			ob_clean();
			$mpdf->Output();

		} else{
			redirect('main/restringido');
		}
	}

	/**
	*
	*
	*/
	public function upload_file(){
		$status = "";
		$this->form_validation->set_rules('archivo', 'Archivo', 'required');

		$config['upload_path']          = './assets/files/uploads/';
        $config['allowed_types']        = 'xls|xlsx';
        $config['max_size']             = 150;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $config['remove_spaces']		= TRUE;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('archivo'))
        {
            //$error = array('error' => $this->upload->display_errors());
            $msg = $this->upload->display_errors();
            //$this->load->view('upload_form', $error);
        }
        else
        {
            $data = $this->upload->data();
            $datos = $this->importar_articulos($data['file_name']);
            if ($datos->num_rows() > 0) {
            	//$msg= "Existen ".$datos." registros repetidos!";
            	$msg = true;
            }else{
            	//$msg = "Archivo subido e Importado correctamente! ". $data['file_name'];
            	$msg = false;
            }
        }
		echo json_encode( array('status' => $status, 'msg' => $msg, 'archivo' => $data['file_name'], 'datos' => json_encode($datos->result())));
	}

	/**
    * Author: Jorge Anibal Zapata Agreda
    * Desc: Importacion de datos desde archivo Excel
    **/
    private function importar_articulos($file){

        $this->load->library('Excel');
        $objPhpExcel = PHPExcel_IOFactory::load('./assets/files/uploads/'.$file);
        $coleccion_celdas = $objPhpExcel->getActiveSheet()->getCellCollection();

        foreach ($coleccion_celdas as $celda) {
        	$columna = $objPhpExcel->getActiveSheet()->getCell($celda)->getColumn();
        	$fila = $objPhpExcel->getActiveSheet()->getCell($celda)->getRow();
        	$valor_celda = $objPhpExcel->getActiveSheet()->getCell($celda)->getValue();
        	if ($fila == 1) {
        		$header[$fila][$columna] = $valor_celda;
        	} else {
        		$dato[$fila][$columna] = $valor_celda;
        	}
        }
        $datos['cabecera'] = $header;
        $datos['valores'] = $dato;
        //print_r(json_encode($datos['valores']));
        $anade_articulos = $this->Articulos_model->inserta_articulos($datos);
        return $anade_articulos;
        // foreach ($datos['valores'] as $key ) {
        // 	echo $key['A'].'--'.$key['B'].'--'.$key['C'].'--'.$key['D'].'--'.$key['E'].'--'.$key['F'].'--'.$key['G'].'<br>';
        // }
    }

    /**
    * Author: Jorge Anibal Zapata Agreda
    * Desc: Actualiza articulos repetidos de la importacion
    **/
    public function actualiza_repetidos(){
    	if ($this->session->userdata('is_logged_in')){
			$actualiza_duple = $this->Articulos_model->actualiza_repetidos($_POST['data']);
			$elimina = $this->borra_temporal();
			echo $actualiza_duple;
		} else{
			redirect('main/restringido');
		}
    }

    public function borra_temporal(){
    	if ($this->session->userdata('is_logged_in')){
			$borra_temporal = $this->Articulos_model->borra_temporal();
			echo $borra_temporal;
		} else{
			redirect('main/restringido');
		}
    }

    public function carga_datos_articulo(){
    	if ($this->session->userdata('is_logged_in')){
    		$datos_articulo = $this->Articulos_model->carga_datos_articulo($_POST['data']);
   //  		$this->load->model('Almacenes_model');
			// $codigo_almacen = $this->Almacenes_model->codigo_almacen();
    		//$datos = array($datos_articulo, $codigo_almacen);
    		echo json_encode($datos_articulo);
    		//echo json_encode($datos);
    	} else{
    		redirect('main/restringido');
    	}
    }

    public function actualizar_articulo(){
		if ($this->session->userdata('is_logged_in')){
			$actualizar_articulo = $this->Articulos_model->actualizar_articulo($_POST['data']);
			echo $actualizar_articulo;
		} else{
			redirect('main/restringido');
		}
	}

	public function cuadra_inventario(){
		if ($this->session->userdata('is_logged_in')){
			$cuadra_inventario = $this->Articulos_model->cuadra_inventario();
			echo $cuadra_inventario;
		} else{
			redirect('main/restringido');
		}
	}

	public function crear_articulo(){
		if ($this->session->userdata('is_logged_in')){
			$nuevo_articulo = $this->Articulos_model->nuevo_articulo($_POST['data']);
			echo $nuevo_articulo;
		} else{
			redirect('main/restringido');
		}
	}

	public function elimina_articulo(){
		if ($this->session->userdata('is_logged_in')){
			$elimina_articulo = $this->Articulos_model->elimina_articulo($_POST['data']);
			echo $elimina_articulo;
		} else{
			redirect('main/restringido');
		}
	}

    //********************************************
    /**
    *
    * Desc: Seccion de Gestion de Almacenes
    **/

    public function creacion_almacenes(){
    	if ($this->session->userdata('is_logged_in')){
			$this->load->model('Almacenes_model');

			$lista_almacenes['almacenes'] = $this->Almacenes_model->lista_almacenes();
			$this->load->view('conf_almacenes_view', $lista_almacenes);
		} else{
			redirect('main/restringido');
		}
    }

    public function nuevo_almacen(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Almacenes_model');

			$nuevo_almacen = $this->Almacenes_model->nuevo_almacen($_POST['data']);
			echo json_encode($nuevo_almacen);
		} else{
			redirect('main/restringido');
		}
	}

	public function codigo_almacen(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Almacenes_model');
			$codigo_almacen = $this->Almacenes_model->codigo_almacen();
			echo json_encode($codigo_almacen);
		} else{
			redirect('main/restringido');
		}
	}

	public function carga_datos_almacen(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Almacenes_model');
			$nuevo_almacen = $this->Almacenes_model->carga_datos_almacen($_POST['data']);
			echo json_encode($nuevo_almacen);
		} else{
			redirect('main/restringido');
		}	
	}

	public function actualizar_almacen(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Almacenes_model');

			$actualizar_almacen = $this->Almacenes_model->actualizar_almacen($_POST['data']);
			echo json_encode($actualizar_almacen);
		} else{
			redirect('main/restringido');
		}
	}
	//********************************************
	
	/**
	*
	*
	**/
	public function rep_conteo_fisico(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Articulos_model');	
			$articulos['conteo'] = $this->Articulos_model->paraconteo_fisico();

			$this->load->model('Almacenes_model');
			$articulos['almacenes'] = $this->Almacenes_model->codigo_almacen();
			
			$this->load->view('para_conteo_fisico_view', $articulos);
		} else{
			redirect('main/restringido');
		}
	}

	public function buscar_almacen_conteo(){
		if ($this->session->userdata('is_logged_in')){
			$articulos = $this->Articulos_model->busca_articulo_almacen($_POST['data']);
			echo json_encode($articulos);
		} else{
			redirect('main/restringido');
		}
	}

	public function busca_articulo_conteo(){
		if ($this->session->userdata('is_logged_in')){
			$articulos = $this->Articulos_model->busca_articulo_existencias($_POST['data']);
			echo json_encode($articulos);
		} else{
			redirect('main/restringido');
		}
	}

	/**
	* Desc: Reporte Movimiento de inventarios
	*
	**/
	public function rep_mov_inv(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Articulos_model');
			$articulos['movimiento'] = $this->Articulos_model->movimiento_inventario();

			$this->load->model('Almacenes_model');
			$articulos['almacenes'] = $this->Almacenes_model->codigo_almacen();

			$this->load->view('movimiento_inventario_view', $articulos);
		} else{
			redirect('main/restringido');
		}
	}

	/**
	* Desc: Kardex Articulo
	*
	**/
	public function kardex_articulo(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Articulos_model');
			$kardex = $this->Articulos_model->kardex_articulo($_POST['data']);
			echo json_encode($kardex);
		} else{
			redirect('main/restringido');
		}
	}

	/**
	*
	*
	**/
	public function busca_articulo_movimiento(){
		if ($this->session->userdata('is_logged_in')){
			$articulos = $this->Articulos_model->busca_articulo_movimiento($_POST['data']);
			echo json_encode($articulos);
		} else{
			redirect('main/restringido');
		}
	}

	/**
	* Desc: Reporte Movimiento de inventarios
	*
	**/
	public function existencias(){
		if ($this->session->userdata('is_logged_in')){
			$data['existencias'] = $this->Articulos_model->lista_inventario();
			$this->load->model('Almacenes_model');
			$data['almacenes'] = $this->Almacenes_model->codigo_almacen();
			$this->load->view('existencias_view', $data);
		} else{
			redirect('main/restringido');
		}
	}

	public function busar_almacen(){
		if ($this->session->userdata('is_logged_in')){
			$articulos = $this->Articulos_model->busca_articulo_almacen($_POST['data']);
			echo json_encode($articulos);
		} else{
			redirect('main/restringido');
		}
	}

	/**
	*
	*
	**/
	public function busca_almacen_movimiento(){
		if ($this->session->userdata('is_logged_in')){
			$articulos = $this->Articulos_model->busca_almacen_movimiento($_POST['data']);
			echo json_encode($articulos);
		} else{
			redirect('main/restringido');
		}
	}

	/**
	*
	* Desc: Valida si la cantidad esta por debajo de la cantidad configurada
	*
	**/
	public function valida_cantidad(){
		if ($this->session->userdata('is_logged_in')){
			$validacion = $this->Articulos_model->valida_cantidad($_POST['data']);

			echo json_encode($validacion);
		} else{
			redirect('main/restringido');
		}
	}
}
