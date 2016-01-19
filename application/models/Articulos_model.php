<?php
class Articulos_model extends CI_Model{
	public function lista_inventario(){
		//$this->db->where('estado_usuario', '1');
		$abreviacion = $this->session->userdata('abreviacion');
		$query = $this->db->query("SELECT * FROM `articulo_$abreviacion` WHERE  unidad != '-' and procedencia != '-'order by cod_articulo");
		return $query->result();
	} 

	public function busca_articulo($articulo){
		$abreviacion = $this->session->userdata('abreviacion');
		$query = $this->db->query("SELECT id_articulo, cod_articulo, descripcion, procedencia, unidad, empaque, inventario_inicial, cantidad_critica, saldo FROM articulo_$abreviacion WHERE descripcion like '%$articulo%' and unidad != '-' and procedencia != '-'");
		return $query->result();
	}

	public function lista_notas_salida(){
		$abreviacion = $this->session->userdata('abreviacion');
		$query = $this->db->query("SELECT distinct(numero_nota) as numero_nota FROM `inventario_$abreviacion` where tipo_movimiento = 'S' ORDER BY 1");
		return $query->result();
	}

	public function lista_notas_entrada(){
		$abreviacion = $this->session->userdata('abreviacion');
		$query = $this->db->query("SELECT distinct(numero_nota) as numero_nota FROM `inventario_$abreviacion` where tipo_movimiento = 'E' ORDER BY 1");
		return $query->result();
	}

	public function numero_nota($tipo){
		$abreviacion = $this->session->userdata('abreviacion');
		$query = $this->db->query("SELECT IFNULL(max(numero_nota)+1,1) as numero_nota from inventario_$abreviacion where tipo_movimiento = '$tipo'");
		return $query->result();
	}

	public function guarda_nota_salida($data){
		$abreviacion = $this->session->userdata('abreviacion');
		$tempo = json_decode($data);
		$tempo1 = json_decode($data, true);
		
		 $query1 = $this->db->query("delete from inventario_$abreviacion where numero_nota='".$tempo1[0]['numero_nota']."' AND tipo_movimiento='S'");
		foreach ($tempo as $key) 
		{
			$para_saldo = $this->db->query("UPDATE articulo_$abreviacion set saldo = (saldo - $key->cantidad) WHERE cod_articulo = '$key->codigo'");

			$query = $this->db->query("INSERT into inventario_$abreviacion (id_inventario, numero_nota, cod_articulo, tipo_movimiento, cantidad, saldo, fecha, id_usuario) values ('','".$key->numero_nota."', '".$key->codigo."', 'S', '".$key->cantidad."', (SELECT a1.saldo FROM articulo_$abreviacion a1 WHERE a1.cod_articulo = '".$key->codigo."'), curdate(), '".$key->vendedor."')");
		}
		return $query;
	}

	public function guarda_nota_entrada($data){
		$abreviacion = $this->session->userdata('abreviacion');
		$tempo = json_decode($data);
		$tempo1 = json_decode($data, true);
		
		 $query1 = $this->db->query("DELETE from inventario_$abreviacion where numero_nota='".$tempo1[0]['numero_nota']."' AND tipo_movimiento='E'");
		foreach ($tempo as $key) 
		{
			$para_saldo = $this->db->query("UPDATE articulo_$abreviacion set saldo = (saldo + $key->cantidad) WHERE cod_articulo = '$key->codigo'");
			$query = $this->db->query("INSERT into inventario_$abreviacion (id_inventario, numero_nota, cod_articulo, tipo_movimiento, cantidad, saldo, fecha, id_usuario) values ('','".$key->numero_nota."', '".$key->codigo."', 'E', '".$key->cantidad."', (SELECT a1.saldo FROM articulo_$abreviacion a1 WHERE a1.cod_articulo = '".$key->codigo."'), curdate(), '".$key->vendedor."')");
		}
		return $query;
	}

	public function trae_nota_salida($id_nota){
		$abreviacion = $this->session->userdata('abreviacion');
		//$query = $this->db->query("SELECT * FROM inventario_$abreviacion where numero_nota = $id_nota and tipo_movimiento = 'S'");
		$query = $this->db->query("SELECT DATE_FORMAT(i.fecha, '%d-%m-%Y') AS fecha, a.cod_articulo, a.descripcion, a.procedencia, a.unidad, a.empaque, i.cantidad FROM `inventario_$abreviacion` i, articulo_$abreviacion a where i.cod_articulo = a.cod_articulo and i.numero_nota= $id_nota and tipo_movimiento = 'S'");
		return $query->result();
	}

	public function trae_nota_entrada($id_nota){
		$abreviacion = $this->session->userdata('abreviacion');
		//$query = $this->db->query("SELECT * FROM inventario_$abreviacion where numero_nota = $id_nota and tipo_movimiento = 'S'");
		$query = $this->db->query("SELECT DATE_FORMAT(i.fecha, '%d-%m-%Y') AS fecha, a.cod_articulo, a.descripcion, a.procedencia, a.unidad, a.empaque, i.cantidad FROM `inventario_$abreviacion` i, articulo_$abreviacion a where i.cod_articulo = a.cod_articulo and i.numero_nota= $id_nota and tipo_movimiento = 'E'");
		return $query->result();
	}

	public function inserta_articulos($datos){
		$abreviacion = $this->session->userdata('abreviacion');
		foreach ($datos['valores'] as $key ) {
         	// $query = $this->db->query('INSERT INTO articulo_'.$this->session->userdata('abreviacion').' (cod_articulo, descripcion, unidad, empaque, procedencia, inventario_inicial, saldo, cantidad_critica, fecha) values("'.$key['A'].'","'.addslashes($key['B']).'","'.$key['C'].'","'.$key['D'].'","'.$key['E'].'","'.$key['F'].'","'.$key['F'].'","'.$key['G'].'", now())');
         	$query_temporal = $this->db->query('INSERT INTO articulo_temporal (cod_articulo, descripcion, unidad, empaque, procedencia, inventario_inicial, saldo, cantidad_critica, fecha) values("'.$key['A'].'","'.addslashes($key['B']).'","'.$key['C'].'","'.$key['D'].'","'.$key['E'].'","'.$key['F'].'","'.$key['F'].'","'.$key['G'].'", now())');
         }
         
         $query_duples = $this->db->query("SELECT DISTINCT articulo.cod_articulo, articulo.descripcion FROM articulo_$abreviacion as articulo LEFT JOIN articulo_temporal USING (cod_articulo)");
         
         if ($query_duples->num_rows() == 0) {
         	$query_inserta_articulos = $this->db->query("INSERT INTO articulo_$abreviacion (cod_articulo, descripcion, unidad, empaque, procedencia, inventario_inicial, saldo, cantidad_critica, fecha) SELECT cod_articulo, descripcion, unidad, empaque, procedencia, inventario_inicial, saldo, cantidad_critica, fecha from articulo_temporal");
         }
         return $query_duples;
	}

	public function actualiza_repetidos($datos){
		$abreviacion = $this->session->userdata('abreviacion');
		$articulo = json_decode($datos);
		foreach ($articulo as $key ) {
			$query = $this->db->query("UPDATE articulo_$abreviacion AS art, articulo_temporal AS art_tmp SET art.cod_articulo = art_tmp.cod_articulo, art.descripcion = art_tmp.descripcion, art.unidad = art_tmp.unidad, art.empaque = art_tmp.empaque, art.procedencia = art_tmp.procedencia, art.inventario_inicial = art_tmp.inventario_inicial, art.fecha = art_tmp.fecha WHERE art.cod_articulo = art_tmp.cod_articulo and art_tmp.cod_articulo = '$key->cod_articulo'");
		}
		return $query;
	}

	public function borra_temporal(){
		
		$query = $this->db->query("TRUNCATE articulo_temporal");
		return $query;
	}

	public function nuevo_articulo($datos){
		$key = json_decode($datos);
         $query = $this->db->query('INSERT INTO articulo_'.$this->session->userdata('abreviacion').' (cod_articulo, descripcion, unidad, empaque, procedencia, inventario_inicial, saldo, cantidad_critica, fecha) values(UPPER("'.$key->cod_articulo.'"),"'.addslashes($key->descripcion).'","'.$key->unidad.'","'.$key->empaque.'","'.$key->procedencia.'","'.$key->inventario_inicial.'","'.$key->inventario_inicial.'","'.$key->cantidad_critica.'", now())');
        return $query;
	}

	public function carga_datos_articulo($id_articulo){
		$this->db->where('id_articulo', $id_articulo);
		$query = $this->db->get('articulo_'.$this->session->userdata('abreviacion'));
		return $query->result();
	}

	public function actualizar_articulo($articulo){
		$nuevo_articulo = json_decode($articulo);
		$abreviacion = $this->session->userdata('abreviacion');
		$query = $this->db->query("UPDATE articulo_$abreviacion SET  cod_articulo = UPPER('".$nuevo_articulo->cod_articulo."'), descripcion = '".$nuevo_articulo->descripcion."', unidad = '".$nuevo_articulo->unidad."', empaque = '".$nuevo_articulo->empaque."', procedencia = '".$nuevo_articulo->procedencia."', inventario_inicial ='". $nuevo_articulo->inventario_inicial."'  WHERE id_articulo =". $nuevo_articulo->id_articulo);
		//$cadena = "INSERT INTO usuarios (id_usuario, uname, password, nombre, apaterno, amaterno, ci, estado, rol) values ('', '$nuevo_usuario->uname', md5('$nuevo_usuario->password'), '$nuevo_usuario->nombre', '$nuevo_usuario->apaterno', '$nuevo_usuario->amaterno', '$nuevo_usuario->ci', 1, '$nuevo_usuario->rol')";
		return $query;
	}

	public function paraconteo_fisico(){
		$abreviacion = $this->session->userdata('abreviacion');
		$query = $this->db->query("SELECT * FROM articulo_$abreviacion WHERE unidad != '-' and procedencia != '-'");

		return $query->result();
	}

	public function movimiento_inventario(){
		$abreviacion = $this->session->userdata('abreviacion');
		$query = $this->db->query("SELECT distinct(inv.cod_articulo), (select art.descripcion from articulo_$abreviacion art where art.cod_articulo = inv.cod_articulo) as descripcion, (select art.unidad from articulo_$abreviacion art where art.cod_articulo = inv.cod_articulo) as unidad, (select art.empaque from articulo_$abreviacion art where art.cod_articulo = inv.cod_articulo) as empaque, (select art.procedencia from articulo_$abreviacion art where art.cod_articulo = inv.cod_articulo) as procedencia, (select art.inventario_inicial from articulo_$abreviacion art where art.cod_articulo = inv.cod_articulo) as inv_inicial, (select IFNULL (SUM(inve.cantidad),0) from inventario_$abreviacion inve where inve.cod_articulo = inv.cod_articulo and inve.tipo_movimiento = 'E') as entradas, (select IFNULL (SUM(inve.cantidad),0) from inventario_$abreviacion inve where inve.cod_articulo = inv.cod_articulo and inve.tipo_movimiento = 'S') as salidas, (select art.saldo from articulo_$abreviacion art where art.cod_articulo = inv.cod_articulo) as saldo from inventario_$abreviacion inv");
		return $query->result();
	}

	public function busca_articulo_movimiento($articulo){
		$abreviacion = $this->session->userdata('abreviacion');
		$query = $this->db->query("SELECT distinct(inv.cod_articulo), (select art.descripcion from articulo_$abreviacion art where art.cod_articulo = inv.cod_articulo) as descripcion, (select art.unidad from articulo_$abreviacion art where art.cod_articulo = inv.cod_articulo) as unidad, (select art.empaque from articulo_$abreviacion art where art.cod_articulo = inv.cod_articulo) as empaque, (select art.procedencia from articulo_$abreviacion art where art.cod_articulo = inv.cod_articulo) as procedencia, (select art.inventario_inicial from articulo_$abreviacion art where art.cod_articulo = inv.cod_articulo) as inv_inicial, (select IFNULL (SUM(inve.cantidad),0) from inventario_$abreviacion inve where inve.cod_articulo = inv.cod_articulo and inve.tipo_movimiento = 'E') as entradas, (select IFNULL (SUM(inve.cantidad),0) from inventario_$abreviacion inve where inve.cod_articulo = inv.cod_articulo and inve.tipo_movimiento = 'S') as salidas, (select art.saldo from articulo_$abreviacion art where art.cod_articulo = inv.cod_articulo) as saldo from inventario_$abreviacion inv WHERE inv.cod_articulo in (SELECT art.cod_articulo FROM articulo_$abreviacion art where art.descripcion like '%$articulo%')");
		//$cadena = "SELECT distinct(inv.cod_articulo), (select art.descripcion from articulo_$abreviacion art where art.cod_articulo = inv.cod_articulo) as descripcion, (select art.unidad from articulo_$abreviacion art where art.cod_articulo = inv.cod_articulo) as unidad, (select art.empaque from articulo_$abreviacion art where art.cod_articulo = inv.cod_articulo) as empaque, (select art.procedencia from articulo_$abreviacion art where art.cod_articulo = inv.cod_articulo) as procedencia, (select art.inventario_inicial from articulo_$abreviacion art where art.cod_articulo = inv.cod_articulo) as inv_inicial, (select IFNULL (SUM(inve.cantidad),0) from inventario_$abreviacion inve where inve.cod_articulo = inv.cod_articulo and inve.tipo_movimiento = 'E') as entradas, (select IFNULL (SUM(inve.cantidad),0) from inventario_$abreviacion inve where inve.cod_articulo = inv.cod_articulo and inve.tipo_movimiento = 'S') as salidas, (select art.saldo from articulo_$abreviacion art where art.cod_articulo = inv.cod_articulo) as saldo from inventario_$abreviacion inv WHERE inv.cod_articulo in (SELECT art.cod_articulo FROM articulo_$abreviacion art where art.descripcion like '%$articulo%')";
		return $query->result();
	}

	public function kardex_articulo($cod_articulo){
		$abreviacion = $this->session->userdata('abreviacion');
		//$query = $this->db->query("SELECT inv.fecha, inv.tipo_movimiento, inv.numero_nota, (select art.descripcion from articulo_$abreviacion art where art.cod_articulo = inv.cod_articulo) as descripcion, (IFNULL (inv.cantidad,0)) as entradas, (0) as salidas, (select art.saldo from articulo_$abreviacion art where art.cod_articulo = inv.cod_articulo) as saldo from inventario_$abreviacion inv where inv.cod_articulo = '$cod_articulo' and inv.tipo_movimiento = 'E' UNION SELECT inv.fecha, inv.tipo_movimiento, inv.numero_nota, (select art.descripcion from articulo_$abreviacion art where art.cod_articulo = inv.cod_articulo) as descripcion, (0) as entradas, (IFNULL (inv.cantidad,0)) as salidas, (select art.saldo from articulo_$abreviacion art where art.cod_articulo = inv.cod_articulo) as saldo from inventario_$abreviacion inv where inv.cod_articulo = '$cod_articulo' and inv.tipo_movimiento = 'S' ");
		$query = $this->db->query("SELECT inv.id_inventario, inv.fecha, inv.tipo_movimiento, inv.numero_nota, (select art.descripcion from articulo_$abreviacion art where art.cod_articulo = inv.cod_articulo) as descripcion, (IFNULL (inv.cantidad,0)) as entradas, (0) as salidas, inv.saldo as saldo from inventario_$abreviacion inv where inv.cod_articulo = '$cod_articulo' and inv.tipo_movimiento = 'E' UNION SELECT inv.id_inventario, inv.fecha, inv.tipo_movimiento, inv.numero_nota, (select art.descripcion from articulo_$abreviacion art where art.cod_articulo = inv.cod_articulo) as descripcion, (0) as entradas, (IFNULL (inv.cantidad,0)) as salidas, inv.saldo as saldo from inventario_$abreviacion inv where inv.cod_articulo = '$cod_articulo' and inv.tipo_movimiento = 'S' ORDER BY 1");
		return $query->result();
	}

	public function kardex_articulo_desc($cod_articulo){
		$abreviacion = $this->session->userdata('abreviacion');
		$query = $this->db->query("SELECT cod_articulo, descripcion, inventario_inicial FROM articulo_$abreviacion WHERE cod_articulo = '$cod_articulo'");
		return $query->result();
	}

	public function valida_cantidad($data){
		$datos = json_decode($data);
		$abreviacion = $this->session->userdata('abreviacion');
		$query = $this->db->query("SELECT (saldo - $datos->cantidad) as valida FROM articulo_$abreviacion WHERE cod_articulo = '$datos->cod_articulo'");
		//$cantidad = "SELECT (saldo - $datos->cantidad) as valida FROM articulo_$abreviacion WHERE cod_articulo = '$datos->cod_articulo'";
		return $query->result();
	}
}
