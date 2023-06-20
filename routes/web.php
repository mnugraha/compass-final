<?php

use App\Http\Controllers\BackendController;
use App\Http\Controllers\BackendController_en;
use App\Http\Controllers\EnglishController;
use App\Http\Controllers\UtamaController;
use App\Http\Controllers\User\ExamController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/loginAdmin', [BackendController::class, 'loginAdmin']);
Route::post('/login_prosesAdmin', [BackendController::class, 'login_proses']);
Route::group(['middleware' => 'akses-user:admin'], function () {
    Route::get('/user', [BackendController::class, 'user']);
    Route::post('/userSimpan', [BackendController::class, 'userSimpan']);
    Route::post('/userUpdate/{x}', [BackendController::class, 'userUpdate']);
    Route::post('/userUpdatePass/{x}', [BackendController::class, 'updatePass']);
    Route::post('/userDelete/{x}', [BackendController::class, 'userDelete']);
    Route::get('/Dkompetensi', [BackendController::class, 'kompetensi']);
    Route::post('/kompetensiSimpan', [BackendController::class, 'kompetensiSimpan']);
    Route::post('/kompetensiUpdate/{x}', [BackendController::class, 'kompetensiUpdate']);
    Route::post('/kompetensiDelete/{x}', [BackendController::class, 'kompetensiDelete']);
    Route::get('/Dlevel', [BackendController::class, 'level']);
    Route::post('/levelSimpan', [BackendController::class, 'levelSimpan']);
    Route::post('/levelUpdate/{x}', [BackendController::class, 'levelUpdate']);
    Route::post('/levelDelete/{x}', [BackendController::class, 'levelDelete']);
    Route::get('/Dvalue', [BackendController::class, 'value']);
    Route::post('/valueSimpan', [BackendController::class, 'valueSimpan']);
    Route::post('/valueUpdate/{x}', [BackendController::class, 'valueUpdate']);
    Route::post('/valueDelete/{x}', [BackendController::class, 'valueDelete']);
    Route::get('/Dperan', [BackendController::class, 'peran']);
    Route::post('/peranSimpan', [BackendController::class, 'peranSimpan']);
    Route::post('/peranUpdate/{x}', [BackendController::class, 'peranUpdate']);
    Route::post('/peranDelete/{x}', [BackendController::class, 'peranDelete']);
    Route::get('/Dstruktur', [BackendController::class, 'struktur']);
    Route::post('/strukturSimpan', [BackendController::class, 'strukturSimpan']);
    Route::post('/strukturUpdate/{x}', [BackendController::class, 'strukturUpdate']);
    Route::post('/strukturDelete/{x}', [BackendController::class, 'strukturDelete']);

    Route::get('/Dkompetensi_en', [BackendController_en::class, 'kompetensi_en']);
    Route::post('/kompetensiSimpan_en', [BackendController_en::class, 'kompetensiSimpan_en']);
    Route::post('/kompetensiUpdate_en/{x}', [BackendController_en::class, 'kompetensiUpdate_en']);
    Route::post('/kompetensiDelete_en/{x}', [BackendController_en::class, 'kompetensiDelete_en']);
    Route::get('/Dvalue_en', [BackendController_en::class, 'value_en']);
    Route::post('/valueSimpan_en', [BackendController_en::class, 'valueSimpan_en']);
    Route::post('/valueUpdate_en/{x}', [BackendController_en::class, 'valueUpdate_en']);
    Route::post('/valueDelete_en/{x}', [BackendController_en::class, 'valueDelete_en']);
    Route::get('/Dperan_en', [BackendController_en::class, 'peran_en']);
    Route::post('/peranSimpan_en', [BackendController_en::class, 'peranSimpan_en']);
    Route::post('/peranUpdate_en/{x}', [BackendController_en::class, 'peranUpdate_en']);
    Route::post('/peranDelete_en/{x}', [BackendController_en::class, 'peranDelete_en']);
    Route::get('/Dstruktur_en', [BackendController_en::class, 'struktur_en']);
    Route::post('/strukturSimpan_en', [BackendController_en::class, 'strukturSimpan_en']);
    Route::post('/strukturUpdate_en/{x}', [BackendController_en::class, 'strukturUpdate_en']);
    Route::post('/strukturDelete_en/{x}', [BackendController_en::class, 'strukturDelete_en']);
});

Route::get('/', [UtamaController::class, 'dashboard']);
Route::get('/profile', [UtamaController::class, 'profil']);
Route::get('/login', [UtamaController::class, 'login'])->name('login')->middleware('guest');
Route::get('/logout', [UtamaController::class, 'logout']);
Route::post('/login_proses', [UtamaController::class, 'login_proses']);
Route::get('/A', [UtamaController::class, 'A']);
Route::get('/B', [UtamaController::class, 'B']);
Route::get('/C', [UtamaController::class, 'C']);
Route::get('/D', [UtamaController::class, 'D']);
Route::get('/A1', [UtamaController::class, 'A1']);
Route::get('/A2', [UtamaController::class, 'A2']);
Route::get('/A3', [UtamaController::class, 'A3']);
Route::get('/B1', [UtamaController::class, 'B1']);
Route::get('/B2', [UtamaController::class, 'B2']);
Route::get('/B3', [UtamaController::class, 'B3']);
Route::get('/C1', [UtamaController::class, 'C1']);
Route::get('/C2', [UtamaController::class, 'C2']);
Route::get('/C3', [UtamaController::class, 'C3']);
Route::get('/D1', [UtamaController::class, 'D1']);
Route::get('/D2', [UtamaController::class, 'D2']);
Route::get('/D3', [UtamaController::class, 'D3']);
Route::get('/test', [UtamaController::class, 'underConstruction']);
Route::get('/book', [UtamaController::class, 'handbook']);
Route::get('/video', [UtamaController::class, 'video']);
Route::get('/kompetensi', [UtamaController::class, 'kompetensi']);
Route::post('/userUpdatePass1/{x}', [UtamaController::class, 'updatePass']);
Route::get('/faq', [UtamaController::class, 'faq']);

Route::get('/profile-en', [EnglishController::class, 'profil_en']);
Route::get('/en', [EnglishController::class, 'dashboard_en']);
Route::get('/A_en', [EnglishController::class, 'A_en']);
Route::get('/B_en', [EnglishController::class, 'B_en']);
Route::get('/C_en', [EnglishController::class, 'C_en']);
Route::get('/D_en', [EnglishController::class, 'D_en']);
Route::get('/A1_en', [EnglishController::class, 'A1_en']);
Route::get('/A2_en', [EnglishController::class, 'A2_en']);
Route::get('/A3_en', [EnglishController::class, 'A3_en']);
Route::get('/B1_en', [EnglishController::class, 'B1_en']);
Route::get('/B2_en', [EnglishController::class, 'B2_en']);
Route::get('/B3_en', [EnglishController::class, 'B3_en']);
Route::get('/C1_en', [EnglishController::class, 'C1_en']);
Route::get('/C2_en', [EnglishController::class, 'C2_en']);
Route::get('/C3_en', [EnglishController::class, 'C3_en']);
Route::get('/D1_en', [EnglishController::class, 'D1_en']);
Route::get('/D2_en', [EnglishController::class, 'D2_en']);
Route::get('/D3_en', [EnglishController::class, 'D3_en']);
Route::get('/book_en', [EnglishController::class, 'handbook']);
Route::get('/video_en', [EnglishController::class, 'video']);
Route::get('/kompetensi_en', [EnglishController::class, 'kompetensi_en']);
Route::post('/userUpdatePass1_en/{x}', [EnglishController::class, 'updatePass']);
Route::get('/faq_en', [EnglishController::class, 'faq']);

// ADMIN UJIAN

//prefix "admin"
Route::prefix('admin')->group(function () {

    //middleware "auth"
    Route::group(['middleware' => ['auth']], function () {

        //route resource exams
        Route::resource('/exams', \App\Http\Controllers\Admin\ExamController::class, ['as' => 'admin']);

        //custom route for create question exam
        Route::get('/exams/{exam}/questions/create', [\App\Http\Controllers\Admin\ExamController::class, 'createQuestion'])->name('admin.exams.createQuestion');

        //custom route for store question exam
        Route::post('/exams/{exam}/questions/store', [\App\Http\Controllers\Admin\ExamController::class, 'storeQuestion'])->name('admin.exams.storeQuestion');

        //custom route for edit question exam
        Route::get('/exams/{exam}/questions/{question}/edit', [\App\Http\Controllers\Admin\ExamController::class, 'editQuestion'])->name('admin.exams.editQuestion');

        //custom route for update question exam
        Route::put('/exams/{exam}/questions/{question}/update', [\App\Http\Controllers\Admin\ExamController::class, 'updateQuestion'])->name('admin.exams.updateQuestion');

        //custom route for destroy question exam
        Route::delete('/exams/{exam}/questions/{question}/destroy', [\App\Http\Controllers\Admin\ExamController::class, 'destroyQuestion'])->name('admin.exams.destroyQuestion');

        //route student import
        Route::get('/exams/{exam}/questions/import', [\App\Http\Controllers\Admin\ExamController::class, 'import'])->name('admin.exam.questionImport');

        //route student import
        Route::post('/exams/{exam}/questions/import', [\App\Http\Controllers\Admin\ExamController::class, 'storeImport'])->name('admin.exam.questionStoreImport');

        // upload file
        Route::post('/exams/questions/upload-image', [\App\Http\Controllers\Admin\ExamController::class, 'upload'])->name('admin.exams.upload-image');

        //route resource exam_sessions
        Route::resource('/exam_sessions', \App\Http\Controllers\Admin\ExamSessionController::class, ['as' => 'admin']);

        //custom route for enrolle create
        Route::get('/exam_sessions/{exam_session}/enrolle/create', [\App\Http\Controllers\Admin\ExamSessionController::class, 'createEnrolle'])->name('admin.exam_sessions.createEnrolle');

        //custom route for enrolle store
        Route::post('/exam_sessions/{exam_session}/enrolle/store', [\App\Http\Controllers\Admin\ExamSessionController::class, 'storeEnrolle'])->name('admin.exam_sessions.storeEnrolle');

        //custom route for enrolle destroy
        Route::delete('/exam_sessions/{exam_session}/enrolle/{exam_group}/destroy', [\App\Http\Controllers\Admin\ExamSessionController::class, 'destroyEnrolle'])->name('admin.exam_sessions.destroyEnrolle');

        //route index grade
        Route::get('/grade', [\App\Http\Controllers\Admin\GradeController::class, 'index'])->name('admin.grade.index');

        //route index reports grade
        Route::get('/grade/filter', [\App\Http\Controllers\Admin\GradeController::class, 'filter'])->name('admin.grade.filter');

        Route::get('/grade/export', [\App\Http\Controllers\Admin\GradeController::class, 'export'])->name('admin.grade.export');
    });
});

// USER UJIAN

//middleware "auth"
Route::group(['middleware' => ['auth']], function () {

    // route dashboard exam
    Route::get('/exam', App\Http\Controllers\User\DashboardController::class)->name('user.exam');

    //route exam confirmation
    Route::get('/exam-confirmation/{id}', [App\Http\Controllers\User\ExamController::class, 'confirmation'])->name('user.exams.confirmation');

    //route exam start
    Route::get('/exam-start/{id}', [App\Http\Controllers\User\ExamController::class, 'startExam'])->name('user.exams.startExam');

    //route exam show
    Route::get('/exam/{id}/{page}', [App\Http\Controllers\User\ExamController::class, 'show'])->name('user.exams.show');

    //route exam update duration
    Route::put('/exam-duration/update/{grade_id}', [App\Http\Controllers\User\ExamController::class, 'updateDuration'])->name('user.exams.update_duration');

    //route answer question
    Route::post('/exam-answer', [App\Http\Controllers\User\ExamController::class, 'answerQuestion'])->name('user.exams.answerQuestion');

    //route exam end
    Route::post('/exam-end', [App\Http\Controllers\User\ExamController::class, 'endExam'])->name('user.exams.endExam');

    //route exam result
    Route::get('/exam-result/{exam_group_id}', [App\Http\Controllers\User\ExamController::class, 'resultExam'])->name('user.exams.resultExam');

    Route::get('/grade/print-pdf/{id}', [ExamController::class, 'generatePDF'])->name('student.exam.print');
});

Route::get('/coba', function () {
    return view('pdf.grade');
});
