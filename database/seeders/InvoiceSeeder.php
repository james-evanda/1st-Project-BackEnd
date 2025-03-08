<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Invoice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
            $user = User::first();
    
            if (!$user) {
                $user = User::create([
                    'name' => 'Test User',
                    'email' => 'testuser@gmail.com',
                    'password' => bcrypt('password123'),
                    'role' => 'user',
                    'phone' => '08123456789'
                ]);
            }
    
            Invoice::create([
                'user_id' => $user->id,
                'invoice_number' => 'INV-' . now()->timestamp,
                'shipping_address' => 'Jl. Merdeka No. 12, Jakarta',
                'postal_code' => '12345',
                'total_price' => 2000000,
            ]);
    }
}
