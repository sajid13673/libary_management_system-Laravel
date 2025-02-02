<?php

namespace App\Console\Commands;

use App\Models\Borrowing;
use Illuminate\Console\Command;

class UpdateFines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-fines';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $borrowings = Borrowing::where('due_date','<',now())->where('status', true)->get();
        foreach ($borrowings as $borrowing) {
            $overdueDays = now()->diffInDays($borrowing->due_date);
            $amount = $overdueDays * config('library.fine_per_day'); // Assuming you have a fine per day config
            $borrowing->fine()->updateOrCreate(["borrowing_id" => $borrowing->id],["amount" => $amount, "member_id" => $borrowing->member_id, "days" => $overdueDays]);
        }
    }
}
