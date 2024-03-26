<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Shop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('shops')->insert([
        //     'name' => 'Parador Tilcara',
        //     'slogan' => 'Parador Tilcara',
        //     'phone' => '+54 9 38815263696',
        //     'email' => 'ptilcara@demo.com.ar',
        //     'address' => 'Ruta 9 - Km 456',
        //     'city' => 'Tilcara, Jujuy, Argentina',
        // ]);

        $shop = new Shop;
        $shop->name = 'Parador Tilcara';
        $shop->slogan = 'Parador Tilcara';
        $shop->phone = '+54 9 38815263696';
        $shop->email = 'ptilcara@demo.com.ar';
        $shop->address = 'Ruta 9 - Km 456';
        $shop->city = 'Tilcara, Jujuy, Argentina';
        $shop->save();

        $images = new Image;
        $images->url = 'shops/parador.jpg';
        $images->imageable_id = $shop->id;
        $images->imageable_type = 'App\Models\Shop';
        $images->save();


        // $data = [
        //     'name' => 'Parador Tilcara',
        //     'slogan' => 'Parador Tilcara',
        //     'phone' => '+54 9 38815263696',
        //     'email' => 'ptilcara@demo.com.ar',
        //     'address' => 'Ruta 9 - Km 456',
        //     'city' => 'Tilcara, Jujuy, Argentina',
        // ];
        // $user = DB::table('shops')->insert($data);

        // $data2 = [
        //     'url' => 'shops/parador.jpg',
        //     'imageable_id' => "USER->ID",
        //     'imageable_type' => 'App\Models\Shop',
        // ];
        // DB::table('images')->insert($data2);  
    }
}
