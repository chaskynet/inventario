<?php
class Articulos_model extends CI_Model{
	public function lista_inventario(){
		//$this->db->where('estado_usuario', '1');
		$abreviacion = $this->session->userdata('abreviacion');
		$query = $this->db->query("SELECT * FROM `articulo` WHERE  unidad != '-' and procedencia != '-'order by cod_articulo");
		return $query->result();
	} 

	public function busca_articulo($articulo){

		$query = $this->db->query("SELECT id_articulo, cod_articulo, cod_almacen, descripcion, procedencia, unidad, empaque, inventario_inicial, cantidad_critica, saldo FROM articulo WHERE descripcion like '%$articulo%' and unidad != '-' and procedencia != '-'");
		return $query->result();
	}

	public function buscar_almacen_invi($almacen){
		$datos = json_decode($almacen);
		if ($datos->almacen =='todo' && $datos->valor != '') {
			$query = $this->db->query("SELECT id_articulo, cod_articulo, cod_almacen, descripcion, procedencia, unidad, empaque, inventario_inicial, cantidad_critica, saldo FROM articulo WHERE descripcion like '%$datos->valor%' and unidad != '-' and procedencia != '-'");
		} elseif($datos->almacen !='todo' && $datos->valor != ''){
			$query = $this->db->query("SELECT id_articulo, cod_articulo, cod_almacen, descripcion, procedencia, unidad, empaque, inventario_inicial, cantidad_critica, saldo FROM articulo WHERE cod_almacen = '$datos->almacen' and descripcion like '%$datos->valor%' and unidad != '-' and procedencia != '-'");
		} elseif($datos->almacen =='todo' && $datos->valor == ''){
			$query = $this->db->query("SELECT id_articulo, cod_articulo, cod_almacen, descripcion, procedencia, unidad, empaque, inventario_inicial, cantidad_critica, saldo FROM articulo WHERE unidad != '-' and procedencia != '-'");
		} elseif($datos->almacen !='todo' && $datos->valor == ''){
			$query = $this->db->query("SELECT id_articulo, cod_articulo, cod_almacen, descripcion, procedencia, unidad, empaque, inventario_inicial, cantidad_critica, saldo FROM articulo WHERE cod_almacen = '$datos->almacen' and unidad != '-' and procedencia != '-'");
		}
		return $query->result();
	}

	public function busca_articulo_invi($datos){
		$datos = json_decode($datos);
		if ($datos->almacen =='todo') {
			$query = $this->db->query("SELECT id_articulo, cod_articulo, cod_almacen, descripcion, procedencia, unidad, empaque, inventario_inicial, cantidad_critica, saldo FROM articulo WHERE descripcion like '%$datos->valor%' and unidad != '-' and procedencia != '-'");
		} else{

			$query = $this->db->query("SELECT id_articulo, cod_articulo, cod_almacen, descripcion, procedencia, unidad, empaque, inventario_inicial, cantidad_critica, saldo FROM articulo WHERE descripcion like '%$datos->valor%' and cod_almacen = '$datos->almacen' and unidad != '-' and procedencia != '-'");
		}
		return $query->result();
	}

	public function busca_articulo_conteo($valor, $almacen){
		if ($valor == "" && $almacen == "todo") {
			$query = $this->db->query("SELECT id_articulo, cod_articulo, cod_almacen, descripcion, procedencia, unidad, empaque, inventario_inicial, cantidad_critica, saldo FROM articulo WHERE unidad != '-' and procedencia != '-'");
		} elseif ($valor != "" && $almacen == "todo") {
			$query = $this->db->query("SELECT id_articulo, cod_articulo, cod_almacen, descripcion, procedencia, unidad, empaque, inventario_inicial, cantidad_critica, saldo FROM articulo WHERE descripcion like '%$valor%' and unidad != '-' and procedencia != '-'");
		} elseif ($valor != "" && $almacen != "todo") {
			$query = $this->db->query("SELECT id_articulo, cod_articulo, cod_almacen, descripcion, procedencia, unidad, empaque, inventario_inicial, cantidad_critica, saldo FROM articulo WHERE descripcion like '%$valor%' and cod_almacen = '$almacen' and unidad != '-' and procedencia != '-'");
		} elseif ($valor == "" && $almacen != 'todo') {
			$query = $this->db->query("SELECT id_articulo, cod_articulo, cod_almacen, descripcion, procedencia, unidad, empaque, inventario_inicial, cantidad_critica, saldo FROM articulo WHERE cod_almacen = '$almacen' and unidad != '-' and procedencia != '-'");
		}

		return $query->result();
	}

	public function busca_articulo_existencias($articulo){
		$datos = json_decode($articulo);
		if ($datos->almacen == 'todo') {
			$query = $this->db->query("SELECT id_articulo, cod_articulo, cod_almacen, descripcion, procedencia, unidad, empaque, inventario_inicial, cantidad_critica, saldo FROM articulo WHERE descripcion like '%$datos->valor%' and unidad != '-' and procedencia != '-'");
		}else{
			$query = $this->db->query("SELECT id_articulo, cod_articulo, cod_almacen, descripcion, procedencia, unidad, empaque, inventario_inicial, cantidad_critica, saldo FROM articulo WHERE descripcion like '%$datos->valor%' and cod_almacen = '$datos->almacen' and unidad != '-' and procedencia != '-'");
		}
		
		return $query->result();
	}

	public function busca_articulo_almacen($almacen){
		if ($almacen == 'todo') {
			$query = $this->db->query("SELECT id_articulo, cod_articulo, cod_almacen, descripcion, procedencia, unidad, empaque, inventario_inicial, cantidad_critica, saldo FROM articulo WHERE unidad != '-' and procedencia != '-'");
		}else{
			$query = $this->db->query("SELECT id_articulo, cod_articulo, cod_almacen, descripcion, procedencia, unidad, empaque, inventario_inicial, cantidad_critica, saldo FROM articulo WHERE cod_almacen = '$almacen' and unidad != '-' and procedencia != '-'");
		}
		return $query->result();
	}

	public function lista_notas_salida(){
		$abreviacion = $this->session->userdata('abreviacion');
		$query = $this->db->query("SELECT distinct(numero_nota) as numero_nota FROM `inventario` where tipo_movimiento = 'S' ORDER BY 1");
		return $query->result();
	}

	public function lista_notas_entrada(){
		$abreviacion = $this->session->userdata('abreviacion');
		$query = $this->db->query("SELECT distinct(numero_nota) as numero_nota FROM `inventario` where tipo_movimiento = 'E' ORDER BY 1");
		return $query->result();
	}

	public function numero_nota($tipo){
		$abreviacion = $this->session->userdata('abreviacion');
		$query = $this->db->query("SELECT IFNULL(max(numero_nota)+1,1) as numero_nota from inventario where tipo_movimiento = '$tipo'");
		return $query->result();
	}

	public function guarda_nota_salida($data, $modo_edicion){
		$abreviacion = $this->session->userdata('abreviacion');
		$tempo = json_decode($data);
		$tempo1 = json_decode($data, true);
		
		 $query1 = $this->db->query("DELETE from inventario where numero_nota='".$tempo1[0]['numero_nota']."' AND tipo_movimiento='S'");
		foreach ($tempo as $key) 
		{
			if ($modo_edicion == 'false') {
				$para_saldo = $this->db->query("UPDATE articulo set saldo = (saldo - $key->cantidad) WHERE cod_articulo = '$key->codigo'");
			}

			$query = $this->db->query("INSERT into inventario (id_inventario, numero_nota, cod_articulo, cod_almacen, tipo_movimiento, cantidad, saldo, fecha, id_usuario) values ('','".$key->numero_nota."', '".$key->codigo."', '$key->almacen', 'S', '".$key->cantidad."', (SELECT a1.saldo FROM articulo a1 WHERE a1.cod_articulo = '".$key->codigo."'), curdate(), '".$key->vendedor."')");
		}
		return $query;
	}

	public function guarda_nota_entrada($data, $modo_edicion){
		$abreviacion = $this->session->userdata('abreviacion');
		$tempo = json_decode($data);
		$tempo1 = json_decode($data, true);
		
		 $query1 = $this->db->query("DELETE from inventario where numero_nota='".$tempo1[0]['numero_nota']."' AND tipo_movimiento='E'");
		foreach ($tempo as $key) 
		{
			if ($modo_edicion == 'false') {
				$para_saldo = $this->db->query("UPDATE articulo set saldo = (saldo + $key->cantidad) WHERE cod_articulo = '$key->codigo'");
			}

			$query = $this->db->query("INSERT into inventario (id_inventario, numero_nota, cod_articulo, cod_almacen, tipo_movimiento, cantidad, saldo, fecha, id_usuario) values ('','".$key->numero_nota."', '".$key->codigo."', '$key->almacen', 'E', '".$key->cantidad."', (SELECT a1.saldo FROM articulo a1 WHERE a1.cod_articulo = '".$key->codigo."'), curdate(), '".$key->vendedor."')");
		}
		return $query;
	}

	public function trae_nota_salida($id_nota){
		$abreviacion = $this->session->userdata('abreviacion');
		//$query = $this->db->query("SELECT * FROM inventario where numero_nota = $id_nota and tipo_movimiento = 'S'");
		$query = $this->db->query("SELECT DATE_FORMAT(i.fecha, '%d-%m-%Y') AS fecha, i.cod_articulo, i.cod_almacen, (select articulo.descripcion from articulo where articulo.cod_articulo = i.cod_articulo) as descripcion, (select articulo.procedencia FROM articulo where articulo.cod_articulo = i.cod_articulo) as procedencia, (select articulo.unidad from articulo where articulo.cod_articulo = i.cod_articulo) as unidad, i.cantidad FROM `inventario` i where  i.numero_nota= $id_nota and i.tipo_movimiento = 'S'");
		return $query->result();
	}

	public function trae_nota_entrada($id_nota){
		$abreviacion = $this->session->userdata('abreviacion');
		$query = $this->db->query("SELECT DATE_FORMAT(i.fecha, '%d-%m-%Y') AS fecha, i.cod_articulo, i.cod_almacen, (select articulo.descripcion from articulo where articulo.cod_articulo = i.cod_articulo) as descripcion, (select articulo.procedencia FROM articulo where articulo.cod_articulo = i.cod_articulo) as procedencia, (select articulo.unidad from articulo where articulo.cod_articulo = i.cod_articulo) as unidad, i.cantidad FROM `inventario` i where  i.numero_nota= $id_nota and i.tipo_movimiento = 'E'");
		return $query->result();
	}

	public function eliminina_art_editada($data){
		$abreviacion = $this->session->userdata('abreviacion');
		$tempo = json_decode($data);
		if ($tempo->tabla == 'entrada') {
			$query = $this->db->query("UPDATE articulo SET saldo = (saldo - $tempo->cantidad) WHERE cod_articulo = '$tempo->codigo'");
		} else{
			$query = $this->db->query("UPDATE articulo SET saldo = (saldo + $tempo->cantidad) WHERE cod_articulo = '$tempo->codigo'");
		}
		return $query;
	}

	public function inserta_articulos($datos){
		$abreviacion = $this->session->userdata('abreviacion');
     	$this->db->query("truncate articulo_temporal");
		foreach ($datos['valores'] as $key ) {
         	$query_temporal = $this->db->query('INSERT INTO articulo_temporal (cod_articulo, cod_almacen, descripcion, unidad, empaque, procedencia, inventario_inicial, saldo, cantidad_critica, fecha) values("'.$key['A'].'","'.$key["B"] .'","'.addslashes($key['C']).'","'.$key['D'].'","'.$key['E'].'","'.$key['F'].'","'.$key['G'].'","'.$key['G'].'","'.$key['H'].'", now())');
         }
         
         $query_duples = $this->db->query("SELECT tmp.cod_articulo, tmp.descripcion from articulo_temporal as tmp where tmp.cod_articulo in (select distinct(a.cod_articulo) from articulo as a)");
         //$query_duples = $this->db->query("SELECT DISTINCT articulo_tmp.cod_articulo, articulo_tmp.descripcion FROM articulo_temporal as articulo_tmp LEFT JOIN articulo USING (cod_articulo)");
         //$query_duples = $this->db->query("SELECT DISTINCT articulo.cod_articulo, articulo.descripcion FROM articulo as articulo LEFT JOIN articulo_temporal USING (cod_articulo)");
         
         if ($query_duples->num_rows() == 0) {
         	$query_inserta_articulos = $this->db->query("INSERT INTO articulo (cod_articulo, cod_almacen, descripcion, unidad, empaque, procedencia, inventario_inicial, saldo, cantidad_critica, fecha) SELECT cod_articulo, cod_almacen, descripcion, unidad, empaque, procedencia, inventario_inicial, saldo, cantidad_critica, fecha from articulo_temporal");
         }
         return $query_duples;
	}

	public function actualiza_repetidos($datos){
		$abreviacion = $this->session->userdata('abreviacion');
		$articulo = json_decode($datos);
		
		foreach ($articulo as $key) {
			$query = $this->db->query("UPDATE articulo AS art, articulo_temporal AS art_tmp SET art.cod_articulo = art_tmp.cod_articulo, art.cod_almacen = art_tmp.cod_almacen, art.descripcion = art_tmp.descripcion, art.unidad = art_tmp.unidad, art.empaque = art_tmp.empaque, art.procedencia = art_tmp.procedencia, art.inventario_inicial = art_tmp.inventario_inicial, art.fecha = art_tmp.fecha WHERE art.cod_articulo = art_tmp.cod_articulo and art_tmp.cod_articulo = '$key'");
		}
		return $query;
	}

	public function borra_temporal(){
		
		$query = $this->db->query("TRUNCATE articulo_temporal");
		return $query;
	}

	public function nuevo_articulo($datos){
		$key = json_decode($datos);
         $query = $this->db->query('INSERT INTO articulo (cod_articulo, cod_almacen, descripcion, unidad, empaque, procedencia, inventario_inicial, saldo, cantidad_critica, fecha) values(UPPER("'.$key->cod_articulo.'"),"'.$key->cod_almacen.'","'.addslashes($key->descripcion).'","'.$key->unidad.'","'.$key->empaque.'","'.$key->procedencia.'","'.$key->inventario_inicial.'","'.$key->inventario_inicial.'","'.$key->cantidad_critica.'", now())');
        return $query;
	}

	public function elimina_articulo($id_articulo){
		$query = $this->db->query("DELETE FROM articulo where id_articulo = $id_articulo");
		return $query;
	}

	public function carga_datos_articulo($id_articulo){
		$this->db->where('id_articulo', $id_articulo);
		$query = $this->db->get('articulo');
		return $query->result();
	}

	public function actualizar_articulo($articulo){
		$nuevo_articulo = json_decode($articulo);
		$abreviacion = $this->session->userdata('abreviacion');
		$query = $this->db->query("UPDATE articulo SET  cod_articulo = UPPER('".$nuevo_articulo->cod_articulo."'), cod_almacen = '".$nuevo_articulo->cod_almacen."', descripcion = '".$nuevo_articulo->descripcion."', unidad = '".$nuevo_articulo->unidad."', empaque = '".$nuevo_articulo->empaque."', procedencia = '".$nuevo_articulo->procedencia."', inventario_inicial ='". $nuevo_articulo->inventario_inicial."' WHERE id_articulo =". $nuevo_articulo->id_articulo);
		return $query;
	}

	/*
	* Desc: Cuadra Inventario
	*
	*/
	public function cuadra_inventario(){
		$abreviacion = $this->session->userdata('abreviacion');
		$query_1 = $this->db->query("UPDATE articulo SET saldo = inventario_inicial");

		$query_2 = $this->db->query("SELECT numero_nota, cod_articulo, saldo, cantidad FROM inventario WHERE tipo_movimiento = 'E' ORDER BY inventario.numero_nota");
		$resultado = $query_2->result();
		foreach ($resultado as $key) {
			$query_3 = $this->db->query("UPDATE inventario, articulo 
										SET inventario.saldo = articulo.saldo + $key->cantidad,
											articulo.saldo = articulo.saldo + $key->cantidad 
											WHERE inventario.cod_articulo = articulo.cod_articulo
												and inventario.cod_articulo= '$key->cod_articulo'
												and inventario.tipo_movimiento = 'E'
												and inventario.numero_nota = $key->numero_nota
											");
		}

		$query_4 = $this->db->query("SELECT numero_nota, cod_articulo, saldo, cantidad FROM inventario WHERE tipo_movimiento = 'S' ORDER BY inventario.numero_nota");
		$resultado = $query_4->result();
		foreach ($resultado as $key) {
			$query_5 = $this->db->query("UPDATE inventario, articulo 
										SET inventario.saldo = articulo.saldo - $key->cantidad,
											articulo.saldo = articulo.saldo - $key->cantidad 
											WHERE inventario.cod_articulo = articulo.cod_articulo
												and inventario.cod_articulo= '$key->cod_articulo'
												and inventario.tipo_movimiento = 'S'
												and inventario.numero_nota = $key->numero_nota
											");
		}
		
		return $query_5;
	}

	public function paraconteo_fisico(){
		$abreviacion = $this->session->userdata('abreviacion');
		$query = $this->db->query("SELECT * FROM articulo WHERE unidad != '-' and procedencia != '-'");

		return $query->result();
	}

	public function movimiento_inventario(){
		$abreviacion = $this->session->userdata('abreviacion');
		$query = $this->db->query("SELECT distinct(inv.cod_articulo), (select art.descripcion from articulo art where art.cod_articulo = inv.cod_articulo) as descripcion, (select art.cod_almacen from articulo art where art.cod_articulo = inv.cod_articulo) as almacen, (select art.unidad from articulo art where art.cod_articulo = inv.cod_articulo) as unidad, (select art.empaque from articulo art where art.cod_articulo = inv.cod_articulo) as empaque, (select art.procedencia from articulo art where art.cod_articulo = inv.cod_articulo) as procedencia, (select art.inventario_inicial from articulo art where art.cod_articulo = inv.cod_articulo) as inv_inicial, (select IFNULL (SUM(inve.cantidad),0) from inventario inve where inve.cod_articulo = inv.cod_articulo and inve.tipo_movimiento = 'E') as entradas, (select IFNULL (SUM(inve.cantidad),0) from inventario inve where inve.cod_articulo = inv.cod_articulo and inve.tipo_movimiento = 'S') as salidas, (select art.saldo from articulo art where art.cod_articulo = inv.cod_articulo) as saldo from inventario inv");
		return $query->result();
	}

	public function busca_almacen_movimiento($almacen){
		if ($almacen == 'todo') {
			$query = $this->db->query("SELECT distinct(inv.cod_articulo), (select art.cod_almacen from articulo art where art.cod_articulo = inv.cod_articulo) as almacen, (select art.descripcion from articulo art where art.cod_articulo = inv.cod_articulo) as descripcion, (select art.unidad from articulo art where art.cod_articulo = inv.cod_articulo) as unidad, (select art.empaque from articulo art where art.cod_articulo = inv.cod_articulo) as empaque, (select art.procedencia from articulo art where art.cod_articulo = inv.cod_articulo) as procedencia, (select art.inventario_inicial from articulo art where art.cod_articulo = inv.cod_articulo) as inv_inicial, (select IFNULL (SUM(inve.cantidad),0) from inventario inve where inve.cod_articulo = inv.cod_articulo and inve.tipo_movimiento = 'E') as entradas, (select IFNULL (SUM(inve.cantidad),0) from inventario inve where inve.cod_articulo = inv.cod_articulo and inve.tipo_movimiento = 'S') as salidas, (select art.saldo from articulo art where art.cod_articulo = inv.cod_articulo) as saldo from inventario inv WHERE inv.cod_articulo in (SELECT art.cod_articulo FROM articulo art)");
		}else{
			$query = $this->db->query("SELECT distinct(inv.cod_articulo), (select art.cod_almacen from articulo art where art.cod_articulo = inv.cod_articulo) as almacen, (select art.descripcion from articulo art where art.cod_articulo = inv.cod_articulo) as descripcion, (select art.unidad from articulo art where art.cod_articulo = inv.cod_articulo) as unidad, (select art.empaque from articulo art where art.cod_articulo = inv.cod_articulo) as empaque, (select art.procedencia from articulo art where art.cod_articulo = inv.cod_articulo) as procedencia, (select art.inventario_inicial from articulo art where art.cod_articulo = inv.cod_articulo) as inv_inicial, (select IFNULL (SUM(inve.cantidad),0) from inventario inve where inve.cod_articulo = inv.cod_articulo and inve.tipo_movimiento = 'E') as entradas, (select IFNULL (SUM(inve.cantidad),0) from inventario inve where inve.cod_articulo = inv.cod_articulo and inve.tipo_movimiento = 'S') as salidas, (select art.saldo from articulo art where art.cod_articulo = inv.cod_articulo) as saldo from inventario inv WHERE inv.cod_articulo in (SELECT art.cod_articulo FROM articulo art where art.cod_almacen = '$almacen')");
			
		}
		return $query->result();
	}

	public function busca_articulo_movimiento($articulo){
		$datos = json_decode($articulo);
		if ($datos->almacen == 'todo') {
			$query = $this->db->query("SELECT distinct(inv.cod_articulo), (select art.cod_almacen from articulo art where art.cod_articulo = inv.cod_articulo) as almacen, (select art.descripcion from articulo art where art.cod_articulo = inv.cod_articulo) as descripcion, (select art.unidad from articulo art where art.cod_articulo = inv.cod_articulo) as unidad, (select art.empaque from articulo art where art.cod_articulo = inv.cod_articulo) as empaque, (select art.procedencia from articulo art where art.cod_articulo = inv.cod_articulo) as procedencia, (select art.inventario_inicial from articulo art where art.cod_articulo = inv.cod_articulo) as inv_inicial, (select IFNULL (SUM(inve.cantidad),0) from inventario inve where inve.cod_articulo = inv.cod_articulo and inve.tipo_movimiento = 'E') as entradas, (select IFNULL (SUM(inve.cantidad),0) from inventario inve where inve.cod_articulo = inv.cod_articulo and inve.tipo_movimiento = 'S') as salidas, (select art.saldo from articulo art where art.cod_articulo = inv.cod_articulo) as saldo from inventario inv WHERE inv.cod_articulo in (SELECT art.cod_articulo FROM articulo art where art.descripcion like '%$datos->valor%')");
			
		}else{
			$query = $this->db->query("SELECT distinct(inv.cod_articulo), (select art.cod_almacen from articulo art where art.cod_articulo = inv.cod_articulo) as almacen, (select art.descripcion from articulo art where art.cod_articulo = inv.cod_articulo) as descripcion, (select art.unidad from articulo art where art.cod_articulo = inv.cod_articulo) as unidad, (select art.empaque from articulo art where art.cod_articulo = inv.cod_articulo) as empaque, (select art.procedencia from articulo art where art.cod_articulo = inv.cod_articulo) as procedencia, (select art.inventario_inicial from articulo art where art.cod_articulo = inv.cod_articulo) as inv_inicial, (select IFNULL (SUM(inve.cantidad),0) from inventario inve where inve.cod_articulo = inv.cod_articulo and inve.tipo_movimiento = 'E') as entradas, (select IFNULL (SUM(inve.cantidad),0) from inventario inve where inve.cod_articulo = inv.cod_articulo and inve.tipo_movimiento = 'S') as salidas, (select art.saldo from articulo art where art.cod_articulo = inv.cod_articulo) as saldo from inventario inv WHERE inv.cod_articulo in (SELECT art.cod_articulo FROM articulo art where art.descripcion like '%$datos->valor%' and art.cod_almacen = '$datos->almacen')");
		}
		return $query->result();
	}

	public function busca_articulo_movimiento_pdf($valor, $almacen){
		if ($valor == "" && $almacen == "todo") {
			$query = $this->db->query("SELECT distinct(inv.cod_articulo), (select art.cod_almacen from articulo art where art.cod_articulo = inv.cod_articulo) as almacen, (select art.descripcion from articulo art where art.cod_articulo = inv.cod_articulo) as descripcion, (select art.unidad from articulo art where art.cod_articulo = inv.cod_articulo) as unidad, (select art.empaque from articulo art where art.cod_articulo = inv.cod_articulo) as empaque, (select art.procedencia from articulo art where art.cod_articulo = inv.cod_articulo) as procedencia, (select art.inventario_inicial from articulo art where art.cod_articulo = inv.cod_articulo) as inv_inicial, (select IFNULL (SUM(inve.cantidad),0) from inventario inve where inve.cod_articulo = inv.cod_articulo and inve.tipo_movimiento = 'E') as entradas, (select IFNULL (SUM(inve.cantidad),0) from inventario inve where inve.cod_articulo = inv.cod_articulo and inve.tipo_movimiento = 'S') as salidas, (select art.saldo from articulo art where art.cod_articulo = inv.cod_articulo) as saldo from inventario inv WHERE inv.cod_articulo in (SELECT art.cod_articulo FROM articulo art)");
		} elseif ($valor != "" && $almacen == "todo") {
			$query = $this->db->query("SELECT distinct(inv.cod_articulo), (select art.cod_almacen from articulo art where art.cod_articulo = inv.cod_articulo) as almacen, (select art.descripcion from articulo art where art.cod_articulo = inv.cod_articulo) as descripcion, (select art.unidad from articulo art where art.cod_articulo = inv.cod_articulo) as unidad, (select art.empaque from articulo art where art.cod_articulo = inv.cod_articulo) as empaque, (select art.procedencia from articulo art where art.cod_articulo = inv.cod_articulo) as procedencia, (select art.inventario_inicial from articulo art where art.cod_articulo = inv.cod_articulo) as inv_inicial, (select IFNULL (SUM(inve.cantidad),0) from inventario inve where inve.cod_articulo = inv.cod_articulo and inve.tipo_movimiento = 'E') as entradas, (select IFNULL (SUM(inve.cantidad),0) from inventario inve where inve.cod_articulo = inv.cod_articulo and inve.tipo_movimiento = 'S') as salidas, (select art.saldo from articulo art where art.cod_articulo = inv.cod_articulo) as saldo from inventario inv WHERE inv.cod_articulo in (SELECT art.cod_articulo FROM articulo art where art.descripcion like '%$valor%')");
		} elseif ($valor != "" && $almacen != "todo") {
			$query = $this->db->query("SELECT distinct(inv.cod_articulo), (select art.cod_almacen from articulo art where art.cod_articulo = inv.cod_articulo) as almacen, (select art.descripcion from articulo art where art.cod_articulo = inv.cod_articulo) as descripcion, (select art.unidad from articulo art where art.cod_articulo = inv.cod_articulo) as unidad, (select art.empaque from articulo art where art.cod_articulo = inv.cod_articulo) as empaque, (select art.procedencia from articulo art where art.cod_articulo = inv.cod_articulo) as procedencia, (select art.inventario_inicial from articulo art where art.cod_articulo = inv.cod_articulo) as inv_inicial, (select IFNULL (SUM(inve.cantidad),0) from inventario inve where inve.cod_articulo = inv.cod_articulo and inve.tipo_movimiento = 'E') as entradas, (select IFNULL (SUM(inve.cantidad),0) from inventario inve where inve.cod_articulo = inv.cod_articulo and inve.tipo_movimiento = 'S') as salidas, (select art.saldo from articulo art where art.cod_articulo = inv.cod_articulo) as saldo from inventario inv WHERE inv.cod_articulo in (SELECT art.cod_articulo FROM articulo art where art.descripcion like '%$valor%' and art.cod_almacen = '$almacen')");
		} elseif ($valor == "" && $almacen != 'todo') {
			$query = $this->db->query("SELECT distinct(inv.cod_articulo), (select art.cod_almacen from articulo art where art.cod_articulo = inv.cod_articulo) as almacen, (select art.descripcion from articulo art where art.cod_articulo = inv.cod_articulo) as descripcion, (select art.unidad from articulo art where art.cod_articulo = inv.cod_articulo) as unidad, (select art.empaque from articulo art where art.cod_articulo = inv.cod_articulo) as empaque, (select art.procedencia from articulo art where art.cod_articulo = inv.cod_articulo) as procedencia, (select art.inventario_inicial from articulo art where art.cod_articulo = inv.cod_articulo) as inv_inicial, (select IFNULL (SUM(inve.cantidad),0) from inventario inve where inve.cod_articulo = inv.cod_articulo and inve.tipo_movimiento = 'E') as entradas, (select IFNULL (SUM(inve.cantidad),0) from inventario inve where inve.cod_articulo = inv.cod_articulo and inve.tipo_movimiento = 'S') as salidas, (select art.saldo from articulo art where art.cod_articulo = inv.cod_articulo) as saldo from inventario inv WHERE inv.cod_articulo in (SELECT art.cod_articulo FROM articulo art where art.cod_almacen = '$almacen')");
		}
		return $query->result();
	}

	public function kardex_articulo($cod_articulo){
		$abreviacion = $this->session->userdata('abreviacion');
		
		$query = $this->db->query("SELECT inv.id_inventario, inv.fecha, inv.tipo_movimiento, inv.numero_nota, (select art.descripcion from articulo art where art.cod_articulo = inv.cod_articulo) as descripcion, (select art.inventario_inicial from articulo art where art.cod_articulo = inv.cod_articulo) as invini, (IFNULL (inv.cantidad,0)) as entradas, (0) as salidas, inv.saldo as saldo from inventario inv where inv.cod_articulo = '$cod_articulo' and inv.tipo_movimiento = 'E' UNION SELECT inv.id_inventario, inv.fecha, inv.tipo_movimiento, inv.numero_nota, (select art.descripcion from articulo art where art.cod_articulo = inv.cod_articulo) as descripcion, (select art.inventario_inicial from articulo art where art.cod_articulo = inv.cod_articulo) as invini, (0) as entradas, (IFNULL (inv.cantidad,0)) as salidas, inv.saldo as saldo from inventario inv where inv.cod_articulo = '$cod_articulo' and inv.tipo_movimiento = 'S' ORDER BY 3,4");
		return $query->result();
	}

	public function kardex_articulo_desc($cod_articulo){
		$abreviacion = $this->session->userdata('abreviacion');
		$query = $this->db->query("SELECT cod_articulo, descripcion, inventario_inicial FROM articulo WHERE cod_articulo = '$cod_articulo'");
		return $query->result();
	}

	public function valida_cantidad($data){
		$datos = json_decode($data);
		$abreviacion = $this->session->userdata('abreviacion');
		$query = $this->db->query("SELECT (saldo - $datos->cantidad) as valida FROM articulo WHERE cod_articulo = '$datos->cod_articulo'");
		//$cantidad = "SELECT (saldo - $datos->cantidad) as valida FROM articulo WHERE cod_articulo = '$datos->cod_articulo'";
		return $query->result();
	}
}
