<?php

namespace App\Console\Commands;

use App\Models\Peminjaman;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class CheckAndDeleteExpiredPeminjaman extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-and-delete-expired-peminjaman';

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
        $expiredPeminjamans = Peminjaman::where('status', 'Dipinjam')
            ->where('update_at', '<=', Carbon::now()->subMinutes(5))
            ->get();

        foreach ($expiredPeminjamans as $peminjaman) {
            $peminjaman->update(['status' => 'Sudah Dikembalikan']);
            $peminjaman->delete();
        }

        $this->info('Expired peminjaman successfully processed.');
    }
}
