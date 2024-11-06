<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\VaccineReminderEmail;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Pet;

class SendVaccineReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vaccine:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder emails to users before 3 days of vaccine expiry date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiryDateThreshold = Carbon::now()->addDays(5)->toDateString();

        $pets = Pet::with(['users', 'vaccines' => function ($query) use ($expiryDateThreshold) {
            $query->whereNotNull('vaccine_expiry_date')
                ->where('vaccine_expiry_date', '<=', $expiryDateThreshold)
                ->where('send_mail_status', '=', 0);
        }])->whereHas('vaccines')->get();


        foreach ($pets as $pet) {
            if  ( count($pet->vaccines) > 0 ) {

                $user = $pet->users;
                $vaccines = $pet->vaccines;
                Mail::to($user->email)->send(new VaccineReminderEmail($user, $pet, $vaccines, true));

            }
        }
    }
}