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
			'name'=>'Elados',
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
			'name'=>'Televisores',
			'category_id'=> 20		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Computadoras',
			'category_id'=> 20		
			)
		);


	}
}
