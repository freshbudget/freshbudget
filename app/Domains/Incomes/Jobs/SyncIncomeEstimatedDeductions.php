<?php

namespace App\Domains\Incomes\Jobs;

use App\Domains\Incomes\Actions\UpdateIncomeDeductionEstimate;
use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeStatistic;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Stats\StatsWriter;

class SyncIncomeEstimatedDeductions implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        Income::query()->chunk(100, function ($incomes) {

            foreach ($incomes as $income) {
                (new UpdateIncomeDeductionEstimate($income))->execute();

                StatsWriter::for(IncomeStatistic::class, [
                    'income_id' => $income->id,
                    'name' => 'estimated_deductions_per_period',
                ])->set($income->estimated_deductions_per_period);
            }

        });
    }
}
