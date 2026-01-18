<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Chicken Dimsum',
            'description' => 'Bite-sized delights bursting with flavor! Our chicken dimsum is made with tender, juicy chicken and the freshest ingredients, wrapped to perfection. Each pack comes with 8 pieces, perfect for sharing—or keeping all to yourself! Whether steamed or fried, every bite promises happiness and satisfaction.',
            'category_id' => 1,
            'image' => 'products-images/MPJncr1y9VQeMNuvVvZFhea3awGtJyw7p5VQyMrW.jpg',
            'stock' => 0,
            'price' => 40000,
            'low_stock_threshold' => 10,
        ]);

        Product::create([
            'name' => 'Chicken Gyoza',
            'description' => 'Crispy on the outside, juicy on the inside! Our Chicken Gyoza is filled with tender, seasoned chicken and fresh vegetables, wrapped in a thin, delicate dumpling skin. Each pack contains 12 pieces—perfect for sharing or savoring as a tasty treat all to yourself!',
            'category_id' => 1,
            'image' => 'products-images/M61GU7XhnIJij7kD4oRvkwZHBLuYymBAB5hhhR72.jpg',
            'stock' => 0,
            'price' => 45000,
            'low_stock_threshold' => 10,
        ]);

        Product::create([
            'name' => 'Wonton Chilli Oil',
            'description' => 'A perfect blend of crispy, savory wontons and a spicy kick from our signature chili oil! Each bite is bursting with flavor and heat. Packed in sets of 8, these wontons are ideal for those who love a little spice in their life—whether enjoyed on their own or as an irresistible addition to any meal.',
            'category_id' => 1,
            'image' => 'products-images/nsWMYGRWqoYUz6zYTykg4duEEAxxyscWgtDAOapH.jpg',
            'stock' => 0,
            'price' => 40000,
            'low_stock_threshold' => 10,
        ]);

        Product::create([
            'name' => 'Chicken Dumplings',
            'description' => 'Delightfully soft and packed with juicy, seasoned chicken, these Chicken Dumplings are the perfect bite-sized treat! Each pack contains 12 pieces, making it great for sharing or enjoying all by yourself. Whether steamed or pan-fried, every dumpling delivers a burst of delicious flavor in every bite.',
            'category_id' => 1,
            'image' => 'products-images/0HuiYkyMoYIGiEQyTOf88t0gmad38gMFr11NRJFC.jpg',
            'stock' => 0,
            'price' => 45000,
            'low_stock_threshold' => 10,
        ]);

        Product::create([
            'name' => 'Wonton Soup',
            'description' => 'Warm, comforting, and full of flavor! Our Wonton Soup features delicate wontons filled with tender chicken, served in a flavorful, soothing broth. Each pack comes with 8 pieces of these savory treats—perfect for a cozy meal or a delightful snack. Savor the goodness in every spoonful!',
            'category_id' => 1,
            'image' => 'products-images/GVGTjxtusraPrOEV7tPtoY9zhEiCdLVCRG3kGrwQ.jpg',
            'stock' => 0,
            'price' => 35000,
            'low_stock_threshold' => 10,
        ]);

        Product::create([
            'name' => 'Ice Matcha Latte',
            'description' => 'Refreshing, creamy, and full of vibrant matcha flavor! Our Ice Matcha Latte combines smooth, chilled matcha with rich milk, creating the perfect balance of sweetness and earthiness. It\'s the ultimate cool treat for matcha lovers—refreshing and satisfying in every sip!',
            'category_id' => 2,
            'image' => 'products-images/v4hO1UvB12EQJDA6iymkIysUSZ4d8lu1wLrBDVeS.jpg',
            'stock' => 0,
            'price' => 17000,
            'low_stock_threshold' => 10,
        ]);

        Product::create([
            'name' => 'Orange Juice',
            'description' => 'Fresh, tangy, and oh-so-refreshing! Our Orange Juice is made from the juiciest, ripest oranges, giving you a burst of natural sweetness in every sip. It’s the perfect drink to brighten your day and complement any meal!',
            'category_id' => 2,
            'image' => 'products-images/8tnrd3gOIc3PKk2BgWI3GyQXCU3pOhnUr0Ho3KB9.jpg',
            'stock' => 0,
            'price' => 15000,
            'low_stock_threshold' => 10,
        ]);

        Product::create([
            'name' => 'Lemon Tea',
            'description' => 'Zesty, refreshing, and simply delightful! Our Lemon Tea combines the perfect balance of tangy lemon and soothing tea, making it the ideal drink to quench your thirst. Enjoy the burst of citrus in every sip, whether hot or iced—it’s a citrusy hug in a cup!',
            'category_id' => 2,
            'image' => 'products-images/5lsDAf4KR3Az135eDf3QsBH1PR5ByK7DAnAFAXbh.jpg',
            'stock' => 0,
            'price' => 15000,
            'low_stock_threshold' => 10,
        ]);

        Product::create([
            'name' => 'Dimsum Mentai',
            'description' => 'A delicious twist on your favorite dimsum! Our Dimsum Mentai is filled with tender chicken and topped with a rich, creamy mentai sauce that adds the perfect smoky, savory flavor. Each pack contains 8 pieces—perfect for sharing or enjoying all by yourself. Every bite is a delightful explosion of taste, making it the ultimate treat for dimsum lovers!',
            'category_id' => 1,
            'image' => 'products-images/yqm2fvyXPQMBpNYeM9PIX5WoeRiWsugfEM3Wgdc8.jpg',
            'stock' => 0,
            'price' => 45000,
            'low_stock_threshold' => 10,
        ]);

        Product::create([
            'name' => 'Chili Oil (20ml)',
            'description' => 'Add a spicy kick to your meal with our Chili Oil! Packed in a convenient 20ml bottle, this flavorful oil is perfect for drizzling over your favorite dishes to bring out that bold, smoky heat. Just a little goes a long way—turn up the flavor with every drop!',
            'category_id' => 1,
            'image' => 'products-images/k1grWO2ccyKbnUu1TD8tWSFsnlV4W6AMevtjyBSM.jpg',
            'stock' => 0,
            'price' => 10000,
            'low_stock_threshold' => 10,
        ]);
    }
}
