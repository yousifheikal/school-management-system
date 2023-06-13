<?php

namespace App\Providers;

use App\Repository\FeesInterface;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(
            'App\Repository\StudentRepositoryInterface',
            'App\Repository\StudentRepository'
        );

        $this->app->bind(
            'App\Repository\TeacherRepositoryInterface',
            'App\Repository\TeacherRepository'
        );

        $this->app->bind(
            'App\Repository\StudentPromotionInterface',
            'App\Repository\StudentPromotion'
        );

        $this->app->bind(
            'App\Repository\StudentGraduateInterface',
            'App\Repository\StudentGraduate'
        );

        $this->app->bind(
            'App\Repository\FeesInterface',
            'App\Repository\Fees'
        );

        $this->app->bind(
            'App\Repository\FeeInvoicesInterface',
            'App\Repository\FeeInvoices'
        );

        $this->app->bind(
            'App\Repository\AttendanceStudent',
            'App\Repository\Attendance'
        );

        $this->app->bind(
            'App\Repository\SubjectInterface',
            'App\Repository\Subject'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
