<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Producto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Usuarios con contraseñas hasheadas (Bcrypt)
        DB::table('users')->updateOrInsert(
            ['email' => 'sam@gmail.com'],
            [
                'id' => 1,
                'name' => 'Sam',
                'role' => 'admin',
                'password' => '$2y$12$cqk0N/71MQ9S0FpLVd1szuGXzphn0wnCW1sqIE2vEKh1Gy1APW.gO', // sam123
                'created_at' => '2026-10-15 07:47:07',
                'updated_at' => '2026-10-15 07:47:07',
            ]
        );

        DB::table('users')->updateOrInsert(
            ['email' => 'nadia@gmail.com'],
            [
                'id' => 3,
                'name' => 'Nadia',
                'role' => 'cliente',
                'password' => '$2y$12$EiQtUlL5YEUiZIgoJJzdzevaxxumiDPrcrXokgHO50.3.DAS2JZQK',
                'created_at' => '2026-10-15 21:57:50',
                'updated_at' => '2026-10-15 21:57:50',
            ]
        );

        // 2. Productos oficiales de la Cafetería JJK con Soft Delete
        $productos = [
            [
                'id' => 5,
                'nombre' => 'Latte Infinito de Gojo',
                'descripcion' => 'Un café con leche perfectamente texturizado, cubierto con una capa de espuma ligera y un toque de color azul brillante simulando el Vainilla-Menta. Tan dulce y abrumador que parece no tener fin.',
                'precio' => 35.00,
                'categoria' => 'Bebidas',
                'imagen' => 'img/productos/prod_6ad1729b081b0.jpg',
                'activo' => 1,
            ],
            [
                'id' => 6,
                'nombre' => 'Técnica de la Rosa',
                'descripcion' => 'Una delicada infusión de té verde orgánico con notas de jazmín y pétalos de rosa comestibles. Ideal para calmar los nervios después de un largo día combatiendo maldiciones de grado especial.',
                'precio' => 45.00,
                'categoria' => 'Bebidas',
                'imagen' => 'img/productos/prod_6ad173156cf04.jpg',
                'activo' => 1,
            ],
            [
                'id' => 7,
                'nombre' => 'El Rey de las Sombras',
                'descripcion' => 'Una bebida fría y cremosa a base de té matcha ceremonial con leche de almendras y un remolino de jarabe de mora azul oscura en las paredes del vaso, representando el poder del Sukuna.',
                'precio' => 23.00,
                'categoria' => 'Bebidas',
                'imagen' => 'img/productos/prod_6ad173752fdd5.jpg',
                'activo' => 1,
            ],
            [
                'id' => 8,
                'nombre' => 'Vacío Púrpura',
                'descripcion' => 'Delicioso chocolate semi-amargo humeante coronado con malvaviscos tostados y un toque secreto de jarabe de lavanda que le otorga un tono violáceo único.',
                'precio' => 35.00,
                'categoria' => 'Bebidas',
                'imagen' => 'img/productos/prod_6ad173ede21a3.jpg',
                'activo' => 1,
            ],
            [
                'id' => 9,
                'nombre' => 'Rika',
                'descripcion' => 'Inspirado en el imponente espíritu maldito de Rika Orimoto. Es un pastel denso y húmedo de triple chocolate oscuro, relleno de ganache de avellana y decorado con un glaseado brillante que evoca su enorme presencia.',
                'precio' => 35.00,
                'categoria' => 'Postres',
                'imagen' => 'img/productos/prod_6ad174381617b.jpg',
                'activo' => 1,
            ],
            [
                'id' => 10,
                'nombre' => 'Prisión Confinada',
                'descripcion' => 'Un cremoso pastel de queso al estilo Nueva York cubierto por una mermelada espesa de frutos rojos (fresa y zarzamora) que simula el sello de la Prisión Confinada. ¡Tan adictivo que no querrás escapar!',
                'precio' => 38.00,
                'categoria' => 'Postres',
                'imagen' => 'img/productos/prod_6ad174906f648.jpg',
                'activo' => 1,
            ],
            [
                'id' => 11,
                'nombre' => 'Dedos Malditos',
                'descripcion' => 'Un muffin de vainilla y chispas de chocolate horneado con una forma alargada muy peculiar, acompañado de una jeringa de jarabe de chocolate espeso para simular un "Dedo Maldito" comestible.',
                'precio' => 28.00,
                'categoria' => 'Postres',
                'imagen' => 'img/productos/prod_6ad174fa3276b.jpg',
                'activo' => 1,
            ],
            [
                'id' => 12,
                'nombre' => 'Inumaki',
                'descripcion' => 'Un suave y esponjoso mochi japonés relleno de pasta de frijol dulce (anko) y una fresa entera en su interior. ¡Salmón y hojuelas! Una explosión de sabor tradicional.',
                'precio' => 30.00,
                'categoria' => 'Postres',
                'imagen' => 'img/productos/prod_6ad1756848721.jpg',
                'activo' => 1,
            ],
            [
                'id' => 13,
                'nombre' => 'Técnica de Sombras de Diez Megumi',
                'descripcion' => 'Dos waffles belgas crujientes en forma de cuadrícula, acompañados de helado de vainilla artesanal, plátano en rodajas y un chorro de cajeta espesa que simula los animales de sombra emergiendo del plato.',
                'precio' => 40.00,
                'categoria' => 'Especiales',
                'imagen' => 'img/productos/prod_6ad175b4e4320.jpg',
                'activo' => 1,
            ],
            [
                'id' => 14,
                'nombre' => 'Juicio de Higuruma',
                'descripcion' => 'Torre de tres panqueques esponjosos bañados en miel de maple pura, acompañados de frutos frescos y una pequeña balanza de chocolate amargo comestible sobre la cima. ¡Declarados culpables de querer repetir!',
                'precio' => 35.00,
                'categoria' => 'Especiales',
                'imagen' => 'img/productos/prod_6ad17611d7aa4.jpg',
                'activo' => 0, // Demuestra el borrado lógico en la base de datos
            ],
            [
                'id' => 15,
                'nombre' => 'Vacío Inconmensurable',
                'descripcion' => 'Una malteada hiper-cremosita de galleta Oreo con helado de vainilla, decorada con crema batida azul, polvo de estrellas comestible y un borde de jarabe de chocolate oscuro.',
                'precio' => 38.00,
                'categoria' => 'Especiales',
                'imagen' => 'img/productos/prod_6ad1766806ab6.jpg',
                'activo' => 1,
            ]
        ];

        foreach ($productos as $p) {
            DB::table('productos')->updateOrInsert(
                ['id' => $p['id']],
                array_merge($p, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
