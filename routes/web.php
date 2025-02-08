<?php

use App\Http\Controllers\AdmissionsOfficer\AdmissionsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CheckResultController;
use App\Http\Controllers\SchoolSetupController;
use App\Http\Controllers\Staff\TeachersController;
use App\Models\SchoolSetup;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\userController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\backend\Setup\SchoolClassController;
use App\Http\Controllers\backend\Setup\SchoolTermController;
use App\Http\Controllers\backend\AcademicController;
use App\Http\Controllers\admin\StudentManagement\StudentAdmissionController;
use App\Http\Controllers\admin\Examination\ExaminationController;
use App\Http\Controllers\admin\Examination\AssessmentController;
use App\Http\Controllers\admin\Staff\StaffController;
use App\Http\Controllers\MarksGradeController;
use App\Http\Controllers\CassScoresController;
use App\Http\Controllers\FeesTypeController;
use App\Http\Controllers\AssignClassFeeController;
use App\Http\Controllers\FeesGroupController;
use App\Http\Controllers\SchoolFeesController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\FeesDiscountController;
use App\Http\Controllers\admin\Examination\CassViewController;
use App\Http\Controllers\admin\Reports\ReportController;
use App\Http\Controllers\StudentPromteController;
use App\Http\Controllers\StudentsClassController;
use App\Http\Controllers\backend\Setup\AcademicSessionController;
use App\Http\Controllers\backend\Setup\SchoolArmsController;

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

Route::get('/', function () {
    return view('auth/login');
})->name('main_login');

//Login Routes
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/admin/logout', [AdminController::class, 'Logout'])->name('admin.logout');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'super_admin'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.admin_dashboard');
    })->name('dashboard');
});

// Admission Officer Routes
Route::middleware(['admission_officer'])->group(function(){
    Route::get('/admissions_dashboard', function () {
        return view('Admission_Officer.dashboard');
    })->name('admissions_dashboard');

    Route::prefix('/Admissions')->group(function(){
        // Route::get('StudentEntrollment', [AdmissionsController::class, 'admission'])->name('admissions');
        Route::post('StudentEntrollment', [AdmissionsController::class, 'store_student_enrolment'])->name('store_student_enrolment');
        Route::get('', [AdmissionsController::class, 'admission_index'])->name('admissions');
        Route::get('Enroled', [AdmissionsController::class, 'admission_list'])->name('admissions_list');
        Route::get('AdmissionLetter/{student_id}', [AdmissionsController::class, 'admission_letter'])->name('student_admission_letter');
    });
});

//Teachers Routes
Route::middleware(['teachers'])->group(function(){
    Route::get('/Teacher', [TeachersController::class,'dashboard'])->name('Staff_Dashboard');
});

//Users Routes
Route::prefix('Users')->group(function(){
    Route::get('view', [userController::class, 'UserView'])->name('user.view');    
    Route::post('store', [userController::class, 'StoreUser'])->name('store_user');
    Route::get('edit/{id}', [userController::class, 'EditUser'])->name('user.edit');
    Route::get('delete/{id}', [userController::class, 'DeleteUser'])->name('user.delete');
    Route::get('profile/{id}', [userController::class, 'UserProfile'])->name('user.view_profile');
    Route::post('update/{id}', [userController::class, 'UpdateUser'])->name('user.update');

});

// User Profile and Change password
Route::prefix('Profile')->group(function(){
    Route::get('view', [ProfileController::class, 'ProfileView'])->name('user.view-profile');
});

Route::prefix('Setup')->group(function(){

    // School Classes routes
    Route::get('SchoolClass', [SchoolClassController::class, 'SchoolClass'])->name('school_class');
    Route::post('SchoolClass', [SchoolClassController::class, 'StoreSchoolClass'])->name('save_school_class');
    Route::get('ClassProfile', [SchoolClassController::class, 'ClassProfile'])->name('class_profile');
    Route::get('ClassConfiguration', [SchoolClassController::class, 'ClassConfiguration'])->name('class_configuration');

    // School Class Arms Routes
    Route::get('SchoolArm', [SchoolArmsController::class, 'SchoolArm'])->name('school_arm');
    Route::post('store_school_arm', [SchoolArmsController::class, 'StoreSchoolArm'])->name('store_school_arm');
    Route::post('store_class_arm', [SchoolArmsController::class, 'StoreClassArm'])->name('store_class_arm');

    // School Academic Session routes
    Route::get('AcademicSessionConfigurations', [AcademicSessionController::class, 'AcademicSession'])->name('academic_session');
    Route::post('store_academic_session', [AcademicSessionController::class, 'StoreAcademicSession'])->name('store_academic_session');
    Route::post('store_school_term', [SchoolTermController::class, 'StoreSchoolTerm'])->name('store_school_term');
    Route::put('TermConfigurations', [SchoolTermController::class, 'Update'])->name('update_term');
    Route::post('store_term_configurations', [AcademicSessionController::class, 'store_term_configurations'])->name('store_term_configurations');
    Route::get('term_configurations/{academic_id}', [AcademicSessionController::class, 'set_current_term'])->name('set_current_term');
    Route::get('session_configurations/{session_id}', [AcademicSessionController::class, 'set_current_session'])->name('set_current_session');

    Route::get('/', [SchoolSetupController::class, 'index'])->name('schoolsetup');
    Route::post('/', [SchoolSetupController::class, 'store'])->name('schoolsetup');
    Route::put('/', [SchoolSetupController::class, 'edit'])->name('schoolsetup');    
});

Route::prefix('Students')->middleware(['super_admin'])->group(function(){
    Route::get('StudentRegistation', [StudentAdmissionController::class, 'StudentAdmission'])->name('student-admission');
    Route::post('student.admission.store', [StudentAdmissionController::class, 'StoreStudentAdmission'])->name('student-admission.store');
    Route::get('student_list', [StudentAdmissionController::class, 'StudentAdmissionView'])->name('student_view');
    Route::get('ViewStudents', [StudentAdmissionController::class, 'ViewStudentByClass'])->name('view_student_by_class');
    Route::get('AdmissionLetter/{id}', [StudentAdmissionController::class, 'PrintAdmissionLetter'])->name('admission_letter');
    Route::get('StudentProfile/{id}', [StudentAdmissionController::class, 'ViewStudentProfile'])->name('view_student_profile');
    Route::get('edit_student_record/{id}', [StudentAdmissionController::class, 'EditStudentRecord'])->name('edit_student_record');
    Route::post('update_student_record/{id}', [StudentAdmissionController::class, 'UpdateStudentRecord'])->name('update_student_record');
    Route::get('delete_student_record/{id}', [StudentAdmissionController::class, 'DeleteStudentRecord'])->name('delete_student_record');   
    Route::get('StudentsHouses', [StudentAdmissionController::class, 'StudentHousesView'])->name('student_houses');
    Route::get('StudentPromotion', [StudentPromteController::class, 'Index'])->name('student_promotion_index');
    Route::get('StudentPromotionView', [StudentPromteController::class, 'ViewCurrentStudents'])->name('student_promotion_view');
    Route::post('StudentPromotion', [StudentPromteController::class, 'Promote'])->name('student_promotion');
    Route::get('GenerateRollNumber', [StudentsClassController::class, 'index'])->name('generate_reg_no');
    Route::post('GenerateRollNumber', [StudentsClassController::class, 'store_reg_no'])->name('store_reg_no');
    Route::patch('Suspend/{student_id}', [StudentsClassController::class, 'suspend_student'])->name('suspend_student');
    Route::get('/', [StudentPromteController::class, 'ReEnrol'])->name('re_enrol_student');
    Route::get('ReEnrol', [StudentPromteController::class, 'CreateReEnrol'])->name('create_re_enrol');
    Route::post('ReEnrol', [StudentPromteController::class, 'UpdateReEnrol'])->name('update_re_enrol');
});

Route::prefix('Academics')->group(function(){
    Route::get('SchoolSubjects', [AcademicController::class, 'SchoolSubjects'])->name('school_subjects');
    Route::post('SchoolSubjects', [AcademicController::class, 'storeSchoolSubjects'])->name('store_school_subject');    
    Route::post('ClassSubject', [AcademicController::class, 'storeClassSubjects'])->name('store_class_subject');
    Route::get('MarksGrade', [MarksGradeController::class, 'MarksGrades'])->name('marks_grades');
    Route::post('StoreMarksGrades', [MarksGradeController::class, 'StoreMarksGrades'])->name('store_marks_grades');
});

Route::prefix('/Examination')->group(function(){
    Route::get('ExamCard', [ExaminationController::class, 'Index'])->name('ExamCard');
    Route::get('ExamCardView', [ExaminationController::class, 'GenerateExamCard'])->name('GenerateExamCard');
    Route::get('Attendance', [ExaminationController::class, 'Attendance'])->name('exam_attendance');
    Route::get('ExamAttendanceView', [ExaminationController::class, 'AttendanceGenerate'])->name('exam_attendance_view');
});

Route::prefix('/')->group(function(){
    Route::get('AssRegistration', [AssessmentController::class, 'Index'])->name('ass_registration');
    Route::post('AssStore', [AssessmentController::class, 'StoreAssessment'])->name('store_assessment_type');
    Route::get('AsignAssessment', [AssessmentController::class, 'AssIndex'])->name('asign_assessment');
    Route::post('AsingAssessmentStore', [AssessmentController::class, 'StoreAsignAssessment'])->name('store_asign_assessment');
    Route::get('ScoreSheet', [AssessmentController::class, 'ScoreSheetIndex'])->name('score_sheet_form');
    Route::get('ScoresheetView', [AssessmentController::class, 'ViewScoreSheet'])->name('score_sheet_view');
    Route::get('ResultSeummary', [CassViewController::class, 'resultSummary'])->name('result_summary');
    Route::get('ViewResultSeummary', [CassViewController::class, 'viewResultSummary'])->name('view_result_summary');
});

Route::prefix('UploadResult')->group(function() {
    Route::get('/', [CassScoresController::class, 'upload'])->name('input_cass_scores');
    Route::get('Scores', [CassScoresController::class, 'uploadForm'])->name('cass_scores_form');
    Route::post('Scores', [CassScoresController::class, 'uploadScores'])->name('store_scores');
    Route::get('UpdateUploadedCass',[CassScoresController::class, 'updateUploadedCass'])->name('update_uploaded_cass');    
    Route::post('OfflineUpload',[CassScoresController::class, 'offlineUpload'])->name('upload_offline');
    Route::get('DownloadOffline',[CassScoresController::class, 'downloadOffline'])->name('download_offline');    
    Route::get('ViewUploadedResult', [CassViewController::class, 'viewCass'])->name('view_cass_scores');
});

Route::prefix('ResultManagement')->group(function() {
    Route::get('/', [ExaminationController::class, 'resultIndex'])->name('compute_result');
    Route::post('ComputeResult', [ExaminationController::class, 'storeComputeResult'])->name('store_compute_result'); 
    Route::get('Broadsheet',[CassViewController::class,'broadsheet'])->name('broadsheet');
    Route::get('ClassReportCards',[ReportController::class,'classReport'])->name('class_report_cards');
    Route::get('StudentReportCard',[ReportController::class,'studentReport'])->name('student_report_card');
});

Route::middleware('super_admin')->prefix('Staff')->group(function(){
    Route::get('/', [StaffController::class, 'Staff'])->name('staff');
    Route::post('store_staff_enrollment', [StaffController::class, 'StoreStudentAdmission'])->name('store_staff_enrollment');
    Route::get('EmploymentLetter/{id}', [StaffController::class, 'employmentLetter'])->name('employment_letter');
    Route::get('StaffProfile/{id}', [StaffController::class, 'StaffProfile'])->name('staff_profile');
    Route::get('EditStaffRecord/{id}', [StaffController::class, 'EditStaffRecord'])->name('edit_staff_record');
    Route::post('update_staff_record/{id}', [StaffController::class, 'UpdateStudentRecord'])->name('update_staff_record');
    Route::get('delete_staff_record/{id}', [StaffController::class, 'DeleteStudentRecord'])->name('delete_staff_record');    
});

Route::prefix('SchoolFees')->group(function(){
    //Fees Type Routes
    Route::get('FeesGroup', [FeesGroupController::class, 'feesGroup'])->name('feesgroup');
    Route::post('StoreFeesGroup', [FeesGroupController::class, 'storeFeesGroup'])->name('storefeesgroup');
    Route::get('EditFeesGroup/{id}', [FeesGroupController::class, 'editFeesGroup'])->name('editFeesGroup');
    Route::post('UpdateFeesGroup/{id}', [FeesGroupController::class, 'updateFeesGroup'])->name('updateFeesGroup');
    Route::get('DeleteFeesGroup/{id}', [FeesGroupController::class, 'destroyFeesGroup'])->name('deleteFeesGroup');

    Route::get('PayFees', [SchoolFeesController::class, 'PaySchoolFees'])->name('payfees');
    
    //Fees Type Routes
    Route::get('FeesType', [FeesTypeController::class, 'index'])->name('fees_type');
    Route::post('FeesType', [FeesTypeController::class, 'store'])->name('feestype_store');
    Route::get('EditFeesType/{id}', [FeesTypeController::class, 'edit'])->name('edit_fees_type');
    Route::post('UpdateFeesType/{id}', [FeesTypeController::class, 'update'])->name('update_fees_type');
    Route::get('DeleteFeesType/{id}', [FeesTypeController::class, 'destroy'])->name('delete_fees_type');

    //Assign Fee Amount Routes
    Route::get('AssignFees', [AssignClassFeeController::class, 'AssignFees'])->name('assign_class_fees');
    Route::post('StoreClassFees', [AssignClassFeeController::class, 'storeClassFees'])->name('store_class_fees');
    Route::get('ClassFees', [AssignClassFeeController::class, 'classFees'])->name('class_fees');
    Route::get('EditClassFees/{id}', [AssignClassFeeController::class, 'edit'])->name('edit_class_fees');
    Route::post('UpdateClassFees/{id}', [AssignClassFeeController::class, 'update'])->name('update_class_fees');
    Route::get('DeleteClassFees/{id}', [AssignClassFeeController::class, 'destroy'])->name('delete_class_fees');

    //Fees Discount Routes
    Route::get('FeesDiscount', [FeesDiscountController::class, 'feesDiscount'])->name('feesdiscount');
    Route::post('StoreFeesDiscount', [FeesDiscountController::class, 'storeFeesDiscount'])->name('storefeesdiscount');
    Route::get('ClassFees', [FeesDiscountController::class, 'classFees'])->name('class_fees');
    Route::get('EditClassFees/{id}', [FeesDiscountController::class, 'edit'])->name('edit_class_fees');
    Route::post('UpdateClassFees/{id}', [FeesDiscountController::class, 'update'])->name('update_class_fees');
    Route::get('DeleteClassFees/{id}', [FeesDiscountController::class, 'destroy'])->name('delete_class_fees');

    //Pay Fees Routes    
    Route::get('PayFees', [SchoolFeesController::class, 'PayFees'])->name('payfees');
    Route::post('StoreFeesPay', [SchoolFeesController::class, 'storeFeesPay'])->name('storefeespay');
    Route::get('SchoolFeesReceipts/{id}', [SchoolFeesController::class, 'showFeesReceipt'])->name('show_fees_receipt');

});

Route::prefix('CheckResult')->group(function(){
    Route::get('/',[CheckResultController::class, 'index']);
    Route::get('/Result',[CheckResultController::class, 'processResult'])->name('check_result');    
});

Route::get('FeesResponse/{id}', [GeneralController::class, 'SchoolFees'])->name('fees_response');
Route::get('GetStudent/{id}', [GeneralController::class, 'StudentByClass'])->name('students');
Route::get('FeesDue/{id}', [GeneralController::class, 'FeesDue'])->name('students');
Route::get('GetClass/{id}', [GeneralController::class, 'getSubject'])->name('get_class');
Route::get('GetLGA/{id}', [GeneralController::class, 'GetLGA'])->name('get_lgas');
Route::get('AdmittedStudents/{class_info}', [GeneralController::class, 'AdmittedStudents'])->name('number_of_admitted');
Route::get('GetStudents/{students}', [GeneralController::class, 'students']);
    
