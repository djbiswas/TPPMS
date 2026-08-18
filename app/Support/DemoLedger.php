<?php

namespace App\Support;

class DemoLedger
{
    public static function rentAmount(): string
    {
        return (string) Company::get('rent_amount', '2375.00');
    }

    public static function dueDate(): string
    {
        return (string) Company::get('next_due_date', 'May 1, 2025');
    }

    /**
     * @return list<array{date:string,amount:string}>
     */
    public static function history(): array
    {
        $amount = number_format((float) self::rentAmount(), 2);

        return [
            ['date' => 'Apr 1, 2025', 'amount' => $amount],
            ['date' => 'Mar 1, 2025', 'amount' => $amount],
            ['date' => 'Feb 1, 2025', 'amount' => $amount],
            ['date' => 'Jan 1, 2025', 'amount' => $amount],
        ];
    }
}
