<?php

namespace App\Console\Commands;

use App\Mail\Mailer;
use App\Models\School;
use App\Models\Student;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class FixOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix Students order in school';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $schools = School::all();
        foreach ($schools as $school) {
            $studentsCount = $school->students->count();
            $studentsMax = $school->students->max('order');

            if ($studentsMax != $studentsCount) {
                $students = Student::where('school_id', $school->id)->orderBy('order', 'ASC')->get();
                $order = 1;
                foreach ($students as $student) {
                    $student->order = $order++;
                    $student->save();
                    Mail::to($student->email)->send(new Mailer($student->toArray()));
                }
            }
        }

        $this->info('Successfully sent order update to everyone.');
    }
}
