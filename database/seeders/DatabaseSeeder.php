<?php

namespace Database\Seeders;

use App\Models\Catalog;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /** Roles creation */
        $roles = array('customer', 'administrator', 'editor');
        for ($i = 0; $i < 3; $i++) {
            Role::factory()->create([
                    'role_name' => $roles[$i],
            ]);
        }

        /** Users creation */
        User::factory(20)->create();

        /** Profiles creation */
        Profile::factory(20)->create();

        /** Catalogs creation */
        for ($i = 'A'; $i < 'K'; $i++) {
            Catalog::factory()->create([
                    'catalog_name' => $i,
            ]);
        }

        /** Orders and Products creation */
        Order::factory(20)->has(Product::factory()->count(2))->create();

        /** Update pivot table */
        $products = Product::all();
        $orders = Order::all();
        foreach ($orders as $order) {
            foreach ($products as $product) {
                $product->orders()->updateExistingPivot($order->id, [
                    'sub_total' => 5000,
                    'quantity' => 5,
                ]);
            }
        }
    }
}
