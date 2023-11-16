<?php

use App\Http\Controllers\SchoolSetupController;
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
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.admin_dashboard');
    })->name('dashboard');
});

Route::get('/admin/logout', [AdminController::class, 'Logout'])->name('admin.logout');


Route::prefix('users')->group(function(){
    Route::get('view', [userController::class, 'UserView'])->name('user.view');
    Route::get('add', [userController::class, 'AddUser'])->name('user.add');
    Route::post('store', [userController::class, 'StoreUser'])->name('user.store');
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
    Route::get('school-classes', [SchoolClassController::class, 'SchoolClass'])->name('school-classes');
    Route::post('school.class.store', [SchoolClassController::class, 'StoreSchoolClass'])->name('school-class.store');

    // School Terms routes
    Route::get('school-terms', [SchoolTermController::class, 'SchoolTerm'])->name('school-terms');
    Route::post('school.term.store', [SchoolTermController::class, 'StoreSchoolTerm'])->name('school-term.store');

    Route::get('/', [SchoolSetupController::class, 'index'])->name('schoolsetup');
    Route::post('/', [SchoolSetupController::class, 'store'])->name('schoolsetup');
    Route::put('/', [SchoolSetupController::class, 'edit'])->name('schoolsetup');    
});

Route::prefix('Students')->group(function(){
    Route::get('StudentRegistation', [StudentAdmissionController::class, 'StudentAdmission'])->name('student-admission');
    Route::post('student.admission.store', [StudentAdmissionController::class, 'StoreStudentAdmission'])->name('student-admission.store');
    Route::get('student_list', [StudentAdmissionController::class, 'StudentAdmissionView'])->name('student_view');
    Route::get('ViewStudents', [StudentAdmissionController::class, 'ViewStudentByClass'])->name('view_student_by_class');
    Route::get('AdmissionLetter/{id}', [StudentAdmissionController::class, 'PrintAdmissionLetter'])->name('admission_letter');
    Route::get('StudentProfile/{id}', [StudentAdmissionController::class, 'ViewStudentProfile'])->name('view_student_profile');
    Route::get('edit_student_record/{id}', [StudentAdmissionController::class, 'EditStudentRecord'])->name('edit_student_record');
    Route::post('update_student_record/{id}', [StudentAdmissionController::class, 'UpdateStudentRecord'])->name('update_student_record');
    Route::get('delete_student_record/{id}', [StudentAdmissionController::class, 'DeleteStudentRecord'])->name('delete_student_record');
    Route::get('student_transfer', [StudentAdmissionController::class, 'StudentTransfer'])->name('student_transfer');
    Route::post('transfer_student', [StudentAdmissionController::class, 'TransferStudent'])->name('transfer_student');
    Route::get('StudentsHouses', [StudentAdmissionController::class, 'StudentHousesView'])->name('student_houses');
    Route::get('StudentPromotion', [StudentPromteController::class, 'Index'])->name('student_promotion_index');
    Route::get('StudentPromotionView', [StudentPromteController::class, 'ViewCurrentStudents'])->name('student_promotion_view');
    Route::post('StudentPromotion', [StudentPromteController::class, 'Promote'])->name('student_promotion');
});

Route::prefix('Academics')->group(function(){
    Route::get('school_subjects', [AcademicController::class, 'SchoolSubjects'])->name('school_subjects');
    Route::post('school.subjects.store', [AcademicController::class, 'StoreSchoolSubjects'])->name('school.subjects.store');
    Route::get('AssignSubject', [AcademicController::class, 'AssignSubject'])->name('assign_subject');
    Route::post('StoreAssingSubject', [AcademicController::class, 'StoreAssignedSubject'])->name('store_assigned_subject');
    Route::get('MarksGrade', [MarksGradeController::class, 'MarksGrades'])->name('marks_grades');
    Route::post('StoreMarksGrades', [MarksGradeController::class, 'StoreMarksGrades'])->name('store_marks_grades');
});

Route::prefix('/Examination')->group(function(){
    Route::get('ExamCard', [ExaminationController::class, 'Index'])->name('ExamCard');
    Route::get('ExamCardView', [ExaminationController::class, 'GenerateExamCard'])->name('GenerateExamCard');
    Route::get('Attendance', [ExaminationController::class, 'Attendance'])->name('exam_attendance');
    Route::get('ExamAttendanceView', [ExaminationController::class, 'AttendanceGenerate'])->name('exam_attendance_view');

    Route::get('ComputeResult', [ExaminationController::class, 'computeResult'])->name('compute_result');
    Route::post('StoreComputeResult', [ExaminationController::class, 'storeComputeResult'])->name('store_compute_result');
    
});


Route::prefix('/')->group(function(){
    Route::get('AssRegistration', [AssessmentController::class, 'Index'])->name('ass_registration');
    Route::post('AssStore', [AssessmentController::class, 'StoreAssessment'])->name('store_assessment_type');
    Route::get('AsignAssessment', [AssessmentController::class, 'AssIndex'])->name('asign_assessment');
    Route::post('AsingAssessmentStore', [AssessmentController::class, 'StoreAsignAssessment'])->name('store_asign_assessment');
    Route::get('ScoreSheet', [AssessmentController::class, 'ScoreSheetIndex'])->name('score_sheet_form');
    Route::get('ScoresheetView', [AssessmentController::class, 'ViewScoreSheet'])->name('score_sheet_view');
    Route::get('UploadCassScores', [CassScoresController::class, 'InputScoreIndex'])->name('input_cass_scores');
    Route::get('CassScoresForm', [CassScoresController::class, 'InputScoreForm'])->name('cass_scores_form');
    Route::post('StoreCassScores', [CassScoresController::class, 'StoreScores'])->name('store_scores');
    Route::get('CASSScores', [CassViewController::class, 'index'])->name('cass_scores');
    Route::get('ViewCassScores', [CassViewController::class, 'viewCass'])->name('view_cass_scores');

    Route::get('ResultSeummary', [CassViewController::class, 'resultSummary'])->name('result_summary');
    Route::get('ViewResultSeummary', [CassViewController::class, 'viewResultSummary'])->name('view_result_summary');
    
        
});


Route::prefix('Staff')->group(function(){
    Route::get('StaffEnrollment', [StaffController::class, 'StaffEnrollment'])->name('enrol_staff');
    Route::post('store_staff_enrollment', [StaffController::class, 'StoreStudentAdmission'])->name('store_staff_enrollment');
    Route::get('StaffList', [StaffController::class, 'StaffView'])->name('staff_view');    
    Route::get('EmploymentLetter/{id}', [StaffController::class, 'PrintAdmissionLetter'])->name('admission_letter');
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


Route::prefix('Reports')->group(function(){

    Route::get('/', [ReportController::class, 'index'])->name('reports');
    Route::get('ClassResult', [ReportController::class, 'classResult'])->name('class_result');
    Route::get('ReportCard', [ReportController::class, 'studentDossier'])->name('report_card');

});



    Route::get('FeesResponse/{id}', [GeneralController::class, 'SchoolFees'])->name('fees_response');
    Route::get('GetStudent/{id}', [GeneralController::class, 'StudentByClass'])->name('students');
    Route::get('FeesDue/{id}', [GeneralController::class, 'FeesDue'])->name('students');
    Route::get('GetClass/{id}', [GeneralController::class, 'getSubject'])->name('get_class');
    Route::get('GetLGA/{id}', [GeneralController::class, 'GetLGA'])->name('get_lgas');
