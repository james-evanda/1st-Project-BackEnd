<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Invoice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::inRandomOrder()->limit(10)->get();

        foreach ($users as $user) {
            Invoice::create([
                'invoice_number' => 'INV-' . strtoupper(Str::random(6)),
                'customer_name' => $user->name ?? 'Unknown Customer',
                'total_price' => rand(100000, 500000),
                'status' => ['Pending', 'Paid'][rand(0, 1)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
