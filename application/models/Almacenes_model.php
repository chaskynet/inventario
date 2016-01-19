<?php
class Almacenes_model extends CI_Model{

	public function lista_almacenes(){
		$query = $this->db->get('almacen');
		return $query->result();
	}

	public function nuevo_almacen($almacen){
		$nuevo_almacen = json_decode($almacen);
		$query_almacen = $this->db->query("INSERT INTO almacen (id_almacen, nombre_almacen, abreviacion, fecha) values ('', '$nuevo_almacen->nombre_almacen', '$nuevo_almacen->abreviacion', now())");
		$query_articulo = $this->db->query ("CREATE TABLE IF NOT EXISTS `articulo_$nuevo_almacen->abreviacion` (
			  `id_articulo` int(11) NOT NULL,
			  `cod_articulo` varchar(40) NOT NULL,
			  `descripcion` varchar(100) NOT NULL,
			  `unidad` varchar(30) NOT NULL,
			  `empaque` varchar(50) NOT NULL,
			  `procedencia` varchar(100) NOT NULL,
			  `inventario_inicial` int(11) NOT NULL,
			  `cantidad_critica` int(11) NOT NULL,
			  `saldo` decimal(10,0) NOT NULL,
			  `fecha` datetime NOT NULL
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8;");
		$query_inventario = $this->db->query ("CREATE TABLE IF NOT EXISTS `inventario_$nuevo_almacen->abreviacion` (
			  `id_inventario` int(11) NOT NULL,
			  `numero_nota` int(11) NOT NULL,
			  `cod_articulo` varchar(40) NOT NULL,
			  `tipo_movimiento` varchar(3) NOT NULL,
			  `cantidad` int(11) NOT NULL,
			  `saldo` int(11) NOT NULL,
			  `fecha` date NOT NULL,
			  `id_usuario` varchar(50) NOT NULL
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8;");

		$query_alter1 = $this->db->query("ALTER TABLE `articulo_$nuevo_almacen->abreviacion`
  							ADD PRIMARY KEY (`id_articulo`);");

		$query_alter2 = $this->db->query("ALTER TABLE `inventario_$nuevo_almacen->abreviacion`
  							ADD PRIMARY KEY (`id_inventario`);");

		$query_alter3 = $this->db->query("ALTER TABLE `articulo_$nuevo_almacen->abreviacion`
  							MODIFY `id_articulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;");

		$query_alter4 = $this->db->query("ALTER TABLE `inventario_$nuevo_almacen->abreviacion`
  							MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;");
		return $query_alter4;
	}

	public function carga_datos_almacen($id_almacen){
		$this->db->where('id_almacen', $id_almacen);
		$query = $this->db->get('almacen');
		return $query->result();
	}

	public function actualizar_almacen($almacen){
		$nuevo_almacen = json_decode($almacen);
		$query = $this->db->query("UPDATE almacen SET  nombre_almacen = '$nuevo_almacen->nombre_almacen', abreviacion = '$nuevo_almacen->abreviacion' WHERE id_almacen = $nuevo_almacen->id_almacen");

		$query_articulo = $this->db->query("RENAME TABLE articulo_$nuevo_almacen->abreviacion_old TO articulo_$nuevo_almacen->abreviacion ");

		$query_inventario = $this->db->query("RENAME TABLE inventario_$nuevo_almacen->abreviacion_old TO inventario_$nuevo_almacen->abreviacion ");
		return $query;
	}

	public function almacen($abreviacion){
		$query = $this->db->query("SELECT nombre_almacen FROM almacen where abreviacion = '$abreviacion'");
		return $query->row()->nombre_almacen;
	}
}
