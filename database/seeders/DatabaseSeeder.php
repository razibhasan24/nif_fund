<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Member;
use App\Models\Fund;
use App\Models\Loan;
use App\Models\LoanRequest;
use App\Models\Installment;
use App\Models\Payment;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Users
        $users = User::factory()->count(5)->create([
            'password' => Hash::make('password'),
            'role' => 'member',
        ]);

        foreach ($users as $user) {
            // Create Member for each User
            $member = Member::create([
                'user_id' => $user->id,
                'phone' => fake()->phoneNumber(),
                'address' => fake()->address(),
                'join_date' => now(),
            ]);

            // Create some Funds
            Fund::factory()->count(3)->create([
                'member_id' => $member->id,
                'amount' => fake()->numberBetween(500, 2000),
                'month' => now()->format('Y-m-d'), // date column expects Y-m-d
            ]);

            // Create a Loan Request
            $loanRequest = LoanRequest::create([
                'member_id' => $member->id,
                'amount' => fake()->numberBetween(5000, 20000),
                'reason' => fake()->sentence(),
                'status' => 'pending',
            ]);

            // Approve one Loan
            $loan = Loan::create([
                'member_id' => $member->id,
                'amount' => $loanRequest->amount,
                'installments' => 5,
                'paid_amount' => 0,
                'status' => 'active',
            ]);

            // Create Installments for the Loan
            for ($i = 1; $i <= 5; $i++) {
                Installment::create([
                    'loan_id' => $loan->id,
                    'amount' => $loan->amount / 5,
                    'payment_date' => now()->addMonths($i),
                ]);
            }

            // Add Payments using Factory
            Payment::factory()->count(2)->create([
                'amount' => fake()->numberBetween(1000, 5000),
            ]);
        }

        $this->command->info('✅ Dummy data successfully seeded!');
    }

}
