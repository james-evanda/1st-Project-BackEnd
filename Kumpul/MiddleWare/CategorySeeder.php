namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = ['Electronics', 'Fashion', 'Food & Beverage', 'Home & Living'];
        
        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}