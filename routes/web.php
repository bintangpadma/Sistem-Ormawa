<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\MainController::class)->group(function () {
    Route::get('/', 'index')->name('main.index');
    Route::get('/{event}/recruitment', 'showRecruitment')->name('main.show-recruitment');
    Route::get('/{studentOrganization}/ormawa', 'showOrmawa')->name('main.show-ormawa');
    Route::get('/{event}/event', 'showEvent')->name('main.show-event');
    Route::get('/{news}/news', 'showNews')->name('main.show-news');
    Route::get('/info-panitia', 'showInfo')->name('main.show-info');
});

Route::controller(\App\Http\Controllers\EventRecruitmentController::class)->group(function () {
    Route::get('/event/{event}/recruitment', 'index')->name('event-recruitment.index');
    Route::get('/event/{event}/recruitment/create', 'create')->name('event-recruitment.create');
    Route::get('/event/{event}/recruitment/{eventRecruitment}', 'show')->name('event-recruitment.show');
    Route::post('/event/{event}/recruitment', 'store')->name('event-recruitment.store');
    Route::get('/event/{event}/recruitment/{eventRecruitment}/edit', 'edit')->name('event-recruitment.edit');
    Route::match(['put', 'patch'], '/event/{event}/recruitment/{eventRecruitment}', 'update')->name('event-recruitment.update');
    Route::delete('/event/{event}/recruitment/{eventRecruitment}', 'destroy')->name('event-recruitment.destroy');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'index'])->name('user.index');
    Route::post('/login', [UserController::class, 'store'])->name('user.store');
});

Route::middleware('auth')->group(function () {
    Route::controller(\App\Http\Controllers\ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile.index');
        Route::get('/profile/edit', 'edit')->name('profile.edit');
        Route::match(['put', 'patch'], '/profile/edit', 'update')->name('profile.update');
    });
    Route::resources(['dashboard' => \App\Http\Controllers\DashboardController::class]);
    Route::resources(['admin' => \App\Http\Controllers\AdminController::class]);
    Route::resources(['student-organization' => \App\Http\Controllers\StudentOrganizationController::class]);
    Route::controller(\App\Http\Controllers\StudentOrganizationVisionController::class)->group(function () {
        Route::get('/student-organization/{studentOrganization}/vision', 'index')->name('student-organization-vision.index');
        Route::get('/student-organization/{studentOrganization}/vision/{studentOrganizationVision}', 'show')->name('student-organization-vision.show');
        Route::post('/student-organization/{studentOrganization}/vision', 'store')->name('student-organization-vision.store');
        Route::match(['put', 'patch'], '/student-organization/{studentOrganization}/vision/{studentOrganizationVision}', 'update')->name('student-organization-vision.update');
        Route::delete('/student-organization/{studentOrganization}/vision/{studentOrganizationVision}', 'destroy')->name('student-organization-vision.destroy');
    });
    Route::controller(\App\Http\Controllers\StudentOrganizationMissionController::class)->group(function () {
        Route::get('/student-organization/{studentOrganization}/mission', 'index')->name('student-organization-mission.index');
        Route::get('/student-organization/{studentOrganization}/mission/{studentOrganizationMission}', 'show')->name('student-organization-mission.show');
        Route::post('/student-organization/{studentOrganization}/mission', 'store')->name('student-organization-mission.store');
        Route::match(['put', 'patch'], '/student-organization/{studentOrganization}/mission/{studentOrganizationMission}', 'update')->name('student-organization-mission.update');
        Route::delete('/student-organization/{studentOrganization}/mission/{studentOrganizationMission}', 'destroy')->name('student-organization-mission.destroy');
    });
    Route::controller(\App\Http\Controllers\StudentOrganizationProgramController::class)->group(function () {
        Route::get('/student-organization/{studentOrganization}/program', 'index')->name('student-organization-program.index');
        Route::get('/student-organization/{studentOrganization}/program/{studentOrganizationProgram}', 'show')->name('student-organization-program.show');
        Route::post('/student-organization/{studentOrganization}/program', 'store')->name('student-organization-program.store');
        Route::match(['put', 'patch'], '/student-organization/{studentOrganization}/program/{studentOrganizationProgram}', 'update')->name('student-organization-program.update');
        Route::delete('/student-organization/{studentOrganization}/program/{studentOrganizationProgram}', 'destroy')->name('student-organization-program.destroy');
    });
    Route::controller(\App\Http\Controllers\StudentOrganizationStructureController::class)->group(function () {
        Route::get('/student-organization/{studentOrganization}/structure', 'index')->name('student-organization-structure.index');
        Route::get('/student-organization/{studentOrganization}/structure/{studentOrganizationStructure}', 'show')->name('student-organization-structure.show');
        Route::post('/student-organization/{studentOrganization}/structure', 'store')->name('student-organization-structure.store');
        Route::match(['put', 'patch'], '/student-organization/{studentOrganization}/structure/{studentOrganizationStructure}', 'update')->name('student-organization-structure.update');
        Route::delete('/student-organization/{studentOrganization}/structure/{studentOrganizationStructure}', 'destroy')->name('student-organization-structure.destroy');
    });
    Route::controller(\App\Http\Controllers\StudentOrganizationAchievementController::class)->group(function () {
        Route::get('/student-organization/{studentOrganization}/achievement', 'index')->name('student-organization-achievement.index');
        Route::get('/student-organization/{studentOrganization}/achievement/{studentOrganizationAchievement}', 'show')->name('student-organization-achievement.show');
        Route::post('/student-organization/{studentOrganization}/achievement', 'store')->name('student-organization-achievement.store');
        Route::match(['put', 'patch'], '/student-organization/{studentOrganization}/achievement/{studentOrganizationAchievement}', 'update')->name('student-organization-achievement.update');
        Route::delete('/student-organization/{studentOrganization}/achievement/{studentOrganizationAchievement}', 'destroy')->name('student-organization-achievement.destroy');
    });
    Route::resources(['student-activity-unit' => \App\Http\Controllers\StudentActivityUnitController::class]);
    Route::resources(['news' => \App\Http\Controllers\NewsController::class]);
    Route::resources(['event' => \App\Http\Controllers\EventController::class]);
    Route::controller(\App\Http\Controllers\EventDivisionController::class)->group(function () {
        Route::get('/event/{event}/division', 'index')->name('event-division.index');
        Route::get('/event/{event}/division/{eventDivision}', 'show')->name('event-division.show');
        Route::post('/event/{event}/division', 'store')->name('event-division.store');
        Route::match(['put', 'patch'], '/event/{event}/division/{eventDivision}', 'update')->name('event-division.update');
        Route::delete('/event/{event}/division/{eventDivision}', 'destroy')->name('event-division.destroy');
    });
    Route::controller(\App\Http\Controllers\EventTrackRecordController::class)->group(function () {
        Route::get('/event/{event}/track-record', 'index')->name('event-track-record.index');
        Route::get('/event/{event}/track-record/{eventTrackRecord}', 'show')->name('event-track-record.show');
        Route::post('/event/{event}/track-record', 'store')->name('event-track-record.store');
        Route::match(['put', 'patch'], '/event/{event}/track-record/{eventTrackRecord}', 'update')->name('event-track-record.update');
        Route::delete('/event/{event}/track-record/{eventTrackRecord}', 'destroy')->name('event-track-record.destroy');
    });
    Route::resources(['evaluation' => \App\Http\Controllers\EvaluationController::class]);
    Route::get('/evaluation/{eventRecruitment}/create', [\App\Http\Controllers\EvaluationController::class, 'create'])->name('evaluation.create-form');
    Route::resources(['activity-report' => \App\Http\Controllers\ActivityReportController::class]);
    Route::resources(['info-committee' => \App\Http\Controllers\InfoCommitteeController::class]);
    Route::controller(\App\Http\Controllers\InfoCommitteeDivisionController::class)->group(function () {
        Route::get('/info-committee/{infoCommittee}/division', 'index')->name('info-committee-division.index');
        Route::get('/info-committee/{infoCommittee}/division/{infoCommitteeDivision}', 'show')->name('info-committee-division.show');
        Route::post('/info-committee/{infoCommittee}/division', 'store')->name('info-committee-division.store');
        Route::match(['put', 'patch'], '/info-committee/{infoCommittee}/division/{infoCommitteeDivision}', 'update')->name('info-committee-division.update');
        Route::delete('/info-committee/{infoCommittee}/division/{infoCommitteeDivision}', 'destroy')->name('info-committee-division.destroy');
    });
    Route::controller(\App\Http\Controllers\InfoCommitteeDivisionTaskController::class)->group(function () {
        Route::get('/info-committee/{infoCommittee}/division/{infoCommitteeDivision}/task', 'index')->name('info-committee-division-task.index');
        Route::get('/info-committee/{infoCommittee}/division/{infoCommitteeDivision}/task/{infoCommitteeDivisionTask}', 'show')->name('info-committee-division-task.show');
        Route::post('/info-committee/{infoCommittee}/division/{infoCommitteeDivision}/task', 'store')->name('info-committee-division-task.store');
        Route::match(['put', 'patch'], '/info-committee/{infoCommittee}/division/{infoCommitteeDivision}/task/{infoCommitteeDivisionTask}', 'update')->name('info-committee-division-task.update');
        Route::delete('/info-committee/{infoCommittee}/division/{infoCommitteeDivision}/task/{infoCommitteeDivisionTask}', 'destroy')->name('info-committee-division-task.destroy');
    });
    Route::get('/activity-report/{activityReport}/download', [\App\Http\Controllers\ActivityReportController::class, 'download'])->name('activity-report.download');
    Route::resources(['administrative-document' => \App\Http\Controllers\AdministrativeDocumentController::class]);
    Route::get('/administrative-document/{administrativeDocument}/download', [\App\Http\Controllers\AdministrativeDocumentController::class, 'download'])->name('administrative-document.download');
    Route::post('/logout', [UserController::class, 'delete'])->name('user.delete');
});
