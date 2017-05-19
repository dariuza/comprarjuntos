<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Illuminate\Database\Seeder {
	
	public function run(){
		\DB::table('clu_category')->insert(array(
			'name'=>'Comida Rapida',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Fritos',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Azados',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Bebidas',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Lacteos',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Helados',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Frutas',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Verduras',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cereales',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Enlatados',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Condimentos',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Salsas',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Golosinas',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Postres',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Deporte',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Salud',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Aseo',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Belleza',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Electrodomesticos',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Electrònica',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Libros',
			'category_id'=> 0		
			)
		);				
		\DB::table('clu_category')->insert(array(
			'name'=>'Muebles',
			'category_id'=> 0		
			)
		);		
		\DB::table('clu_category')->insert(array(
			'name'=>'Herramienta',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Jueguetes',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Bebes',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Regalos',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Mascotas',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Bodas',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Moda',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Prendas de Vestir',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Ocio',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Vehiculos',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Plantas',
			'category_id'=> 0		
			)
		);

		//SUBCATEGORIAS
		//1 Comida rapida
		\DB::table('clu_category')->insert(array(
			'name'=>'Perros Calientes',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Quesadillas',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Hamburguesas',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Pizzas',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Sanduches',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cubanos',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Arepas',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Empanadas',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Papas',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Burritos',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Pasteles',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Papas Fritas',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Chuzos',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Albondigas',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Comida Casera',
			'category_id'=> 1		
			)
		);

		//2 Fritos
		\DB::table('clu_category')->insert(array(
			'name'=>'Pasteles',
			'category_id'=> 2		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Carnes',
			'category_id'=> 2		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Papas',
			'category_id'=> 2		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Donas',
			'category_id'=> 2		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Buñuelos',
			'category_id'=> 2		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Vegetales',
			'category_id'=> 2		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Arepas',
			'category_id'=> 2		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Chorizo',
			'category_id'=> 2		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Pollo',
			'category_id'=> 2	
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'pescado',
			'category_id'=> 2		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Shalchichas',
			'category_id'=> 2
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Costillas',
			'category_id'=> 2		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Chicharron',
			'category_id'=> 2		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Patacon',
			'category_id'=> 2		
			)
		);

		//3 Azados
		\DB::table('clu_category')->insert(array(
			'name'=>'Carnes',
			'category_id'=> 3		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Chorizo',
			'category_id'=> 3		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Pollo',
			'category_id'=> 3		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'pescado',
			'category_id'=> 3		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Shalchichas',
			'category_id'=> 3		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Costillas',
			'category_id'=> 3		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Tortas',
			'category_id'=> 3		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Galletas',
			'category_id'=> 3		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Pan',
			'category_id'=> 3		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Parva',
			'category_id'=> 3		
			)
		);


		//4 bebidas
		\DB::table('clu_category')->insert(array(
			'name'=>'Gaseosa',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Jugo natural en agua',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Jugo natural en leche',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Te',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cafe',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Chocolate',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Guarapo',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Claro',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Avena',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Milo',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Vino',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cerveza',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Aguardiente',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Ron',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Licores',
			'category_id'=>4		
			)
		);

		//5 Lacteos
		\DB::table('clu_category')->insert(array(
			'name'=>'Leche',
			'category_id'=>5		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Yogurt',
			'category_id'=>5		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Queso',
			'category_id'=>5		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cuajada',
			'category_id'=>5		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'kumis',
			'category_id'=>5		
			)
		);

		//6 helados
		\DB::table('clu_category')->insert(array(
			'name'=>'Conos',
			'category_id'=>6		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Conchas',
			'category_id'=>6		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Barquillos',
			'category_id'=>6		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Copas',
			'category_id'=>6		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Vasos',
			'category_id'=>6		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Galletas',
			'category_id'=>6		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Paletas',
			'category_id'=>6		
			)
		);

		//7 Frutas
		\DB::table('clu_category')->insert(array(
			'name'=>'Manzanas',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Peras',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Mangos',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Fresas',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Guanabanas',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Sandias',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Papaya',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Guallaba',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Uvas',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Ochua',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Mora',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Lulo',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Maracuya',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Banano',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Kiwi',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Naranjas',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Mandarinas',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Melones',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Melocotones',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Piña',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Pitalla',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Torombolo',
			'category_id'=> 7		
			)
		);

		//8 verduras
		\DB::table('clu_category')->insert(array(
			'name'=>'Papa',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Lechuga',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Zanahoria',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Coliflor',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Brocoli',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Repollo',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Pimenton',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Remolacha',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cebolla Larga',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cebolla de Huevo',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Peregil',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Pepino',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Apio',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Champiñones',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Tomate',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Yuca',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Platano',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Arracacha',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Jengibre',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cilantro',
			'category_id'=> 8		
			)
		);
		

		//19 Electrodomesticos
		\DB::table('clu_category')->insert(array(
			'name'=>'Lavadoras',
			'category_id'=> 19		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Neveras',
			'category_id'=> 19		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Secadoras',
			'category_id'=> 19		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Hornos',
			'category_id'=> 19		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cuidado Personal',
			'category_id'=> 19		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cafeteras',
			'category_id'=> 19		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Licuadoras',
			'category_id'=> 19		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Aspiradoras',
			'category_id'=> 19		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Planchas',
			'category_id'=> 19		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Ollas',
			'category_id'=> 19		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Batidoras',
			'category_id'=> 19		
			)
		);
		//20 Electronica
		\DB::table('clu_category')->insert(array(
			'name'=>'Televisores',
			'category_id'=> 20		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Computadoras',
			'category_id'=> 20		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Camaras Fotograficas',
			'category_id'=> 20		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Camaras de Video',
			'category_id'=> 20		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Tabletas',
			'category_id'=> 20		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Celulares',
			'category_id'=> 20		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Telefonos',
			'category_id'=> 20		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Accesorios',
			'category_id'=> 20		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Consolas de Videojuegos',
			'category_id'=> 20		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Reproductores de Musica',
			'category_id'=> 20		
			)
		);


	}
}
