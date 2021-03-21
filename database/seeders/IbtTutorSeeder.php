<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Modules\Assessments\Database\Seeders\AssessmentsSeeder;
use Modules\Communications\Database\Seeders\CommunicationsSeeder;
use Modules\Courses\Database\Seeders\CoursesSeeder;
use Modules\Users\Database\Seeders\UsersSeeder;

class IbtTutorSeeder extends Seeder
{
    /**
     * Run the app  database seeders.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Seed the users
         */
        $this->call(UsersSeeder::class);

        /**
         * Seed the courses after users , because courses module depends on the users module
         */
        $this->call(CoursesSeeder::class);

        /**
         * Seed the assessments module after courses and users
         */
        $this->call(AssessmentsSeeder::class);

        /**
         * The communications module only needs the users module
         */
        $this->call(CommunicationsSeeder::class);

    }


}
