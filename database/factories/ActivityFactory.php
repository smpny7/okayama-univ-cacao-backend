<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\Club;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Activity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $randomDate = $this->randomDate();
        return [
            'student_id' => sprintf("%08d", mt_rand(99999900, 99999999)),
            'club_id' => Club::query()->limit(5)->get()[rand(0, 4)]['id'],
            'body_temp' => 36.5,
            'physical_condition' => '良好',
            'stifling' => 'なし',
            'fatigue' => 'なし',
            'in_time' => $randomDate[0],
            'out_time' => $randomDate[1],
        ];
    }

    function randomDate(): array
    {
        $twoWeeksAgo = Carbon::today()->subDays(3);
        $today = Carbon::today();
        $timestamp = rand(strtotime($twoWeeksAgo), strtotime($today));
        $date_from = Carbon::parse(date('Y-m-d 00:00:00', $timestamp));
        $date_to = Carbon::parse(date('Y-m-d 00:00:00', $timestamp))->addDay();

        $randomTimestamp1 = rand($date_from->getTimestamp(), $date_to->getTimestamp());
        $randomDate1 = new DateTime();
        $randomDate1->setTimestamp($randomTimestamp1);
        $randomTimestamp2 = rand($date_from->getTimestamp(), $date_to->getTimestamp());
        $randomDate2 = new DateTime();
        $randomDate2->setTimestamp($randomTimestamp2);
        return $randomTimestamp1 < $randomTimestamp2 ? [$randomDate1, $randomDate2] : [$randomDate2, $randomDate1];
    }
}
