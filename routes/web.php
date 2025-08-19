<?php

use App\Http\Controllers\AdmissionsOfficer\AdmissionsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CheckResultController;
use App\Http\Controllers\SchoolSetupController;
use App\Http\Controllers\Staff\TeachersController;
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

// Home Route
Route::get('/', fn() => view('auth.login'));

// Authentication Routes
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login.form');
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout');
});

// Admin Routes
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->name('admin_dashboard');
    Route::get('/admin/view', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');

    // Staff Management
    Route::prefix('admin/staff')->group(function () {
        // Staff Subject Assignment
        Route::get('/subjects', [StaffController::class, 'StaffSubjectAssignment'])->name('staff.subjects');
        Route::post('/subjects', [StaffController::class, 'storeStaffSubjectAssignments'])->name('staff.subjects.store');
        Route::put('/subjects/{id}', [StaffController::class, 'updateStaffSubjectAssignments'])->name('staff.subjects.update');

        // Staff Class Assignment
        Route::get('/classes', [StaffController::class, 'StaffClassAssignment'])->name('staff.classes');
        Route::post('/classes', [StaffController::class, 'storeStaffClassAssignments'])->name('staff.classes.store');
        Route::put('/classes/{id}', [StaffController::class, 'updateStaffClassAssignments'])->name('staff.classes.update');
        Route::delete('/classes/{id}', [StaffController::class, 'destroyStaffClassAssignments'])->name('staff.classes.delete');

        // Staff Routine Assignment
        Route::get('/routines', [StaffController::class, 'StaffRoutinesAssignment'])->name('staff.routines');
        Route::post('/routines', [StaffController::class, 'storeStaffRoutinesAssignments'])->name('staff.routines.store');
        Route::put('/routines', [StaffController::class, 'updateStaffRoutinesAssignments'])->name('staff.routines.update');
    });

    // Teacher Management
    Route::prefix('admin/teachers')->group(function () {
        Route::get('/', [TeachersController::class, 'index'])->name('teachers.index');
        Route::get('/create', [TeachersController::class, 'create'])->name('teachers.create');
        Route::post('/', [TeachersController::class, 'store'])->name('teachers.store');
        Route::get('/{id}', [TeachersController::class, 'show'])->name('teachers.show');
        Route::get('/{id}/edit', [TeachersController::class, 'edit'])->name('teachers.edit');
        Route::put('/{id}', [TeachersController::class, 'update'])->name('teachers.update');
        Route::delete('/{id}', [TeachersController::class, 'destroy'])->name('teachers.destroy');
    });

    // Student Management
    Route::prefix('admin/students')->group(function () {
        Route::post('enrol', [StudentAdmissionController::class, 'store'])->name('student-admission.store');
        Route::get('student_list', [StudentAdmissionController::class, 'StudentAdmissionView'])->name('student_view');
        Route::get('ViewStudents', [StudentAdmissionController::class, 'ViewStudentByClass'])->name('view_student_by_class');
        Route::get('admission-letter/{id}', [StudentAdmissionController::class, 'PrintAdmissionLetter'])->name('admission_letter');
        Route::get('profile/{id}', [StudentAdmissionController::class, 'ViewStudentProfile'])->name('view_student_profile');
        Route::get('update/{id}', [StudentAdmissionController::class, 'EditStudentRecord'])->name('edit_student_record');
        Route::post('update/{id}', [StudentAdmissionController::class, 'UpdateStudentRecord'])->name('update_student_record');
        Route::get('delete_student_record/{id}', [StudentAdmissionController::class, 'DeleteStudentRecord'])->name('delete_student_record');
        Route::get('houses', [StudentAdmissionController::class, 'StudentHousesView'])->name('student_houses');
        Route::get('promotion', [StudentPromteController::class, 'Index'])->name('student_promotion_index');
        Route::get('promotion/view', [StudentPromteController::class, 'ViewCurrentStudents'])->name('student_promotion_view');
        Route::post('promotion', [StudentPromteController::class, 'Promote'])->name('student_promotion');
        Route::get('generate-roll-number', [StudentsClassController::class, 'index'])->name('generate_reg_no');
        Route::post('generate-roll-number', [StudentsClassController::class, 'store_reg_no'])->name('store_reg_no');
        Route::patch('Suspend/{student_id}', [StudentsClassController::class, 'suspend_student'])->name('suspend_student');
        Route::get('/', [StudentPromteController::class, 'ReEnrol'])->name('re_enrol_student');
        Route::get('ReEnrol', [StudentPromteController::class, 'CreateReEnrol'])->name('create_re_enrol');
        Route::post('ReEnrol', [StudentPromteController::class, 'UpdateReEnrol'])->name('update_re_enrol');
    });

    // Academic Management
    Route::prefix('admin/academics')->group(function () {
        // School Classes routes        
        Route::post('school-classes', [SchoolClassController::class, 'storeSchoolClass'])->name('save_school_class');
        Route::get('class-profile/{class_id}', [SchoolClassController::class, 'classProfile'])->name('class_profile');

        // School Class Arms Routes
        Route::get('school-classes-arms', [SchoolArmsController::class, 'schoolArm'])->name('school-classes-arms');
        Route::post('school-arms', [SchoolArmsController::class, 'storeSchoolArm'])->name('store_school_arm');
        Route::post('class-disciplines', [SchoolArmsController::class, 'storeClassDiscipline'])->name('store_class_discipline');
        Route::post('class-arm', [SchoolArmsController::class, 'storeClassArm'])->name('store_class_arm');

        // School Academic Session routes
        Route::get('academic-session-terms', [AcademicSessionController::class, 'academicSession'])->name('academic_session');
        Route::post('store-academic-session', [AcademicSessionController::class, 'storeAcademicSession'])->name('store_academic_session');
        Route::post('academic-session-dates', [AcademicSessionController::class, 'storeAcademicSessionDates'])->name('set-term-dates');
        Route::post('set-current-session/{academic_session_id}', [AcademicSessionController::class, 'setCurrentSession'])->name('set-current-session');

        // School Term Routes        
        Route::post('store-school-term', [SchoolTermController::class, 'storeSchoolTerm'])->name('store_school_term');
        Route::put('store-school-term', [SchoolTermController::class, 'storeUpdate'])->name('school-term.update');
        Route::post('set-current-term/{term_id}', [AcademicSessionController::class, 'setCurrentTerm'])->name('set-current-term');

        // School Subjects Routes
        Route::get('subjects', [AcademicController::class, 'schoolSubjects'])->name('school_subjects');
        Route::post('subjects', [AcademicController::class, 'storeSchoolSubjects'])->name('store_school_subject');
        Route::post('discipline-subjects', [AcademicController::class, 'storeDisciplineSubjects'])->name('store_discipline_subjects');
        Route::post('class-subjects', [AcademicController::class, 'storeClassSubjects'])->name('store_class_subject');
        Route::get('marks-grades', [MarksGradeController::class, 'MarksGrades'])->name('marks_grades');
        Route::post('marks-grades', [MarksGradeController::class, 'StoreMarksGrades'])->name('store_marks_grades');
    });
});

// Staff Routes
Route::middleware(['staff'])->group(function () {
    // Dashboard Route
    Route::get('/staff/dashboard', fn() => view('Teachers.dashboard'))->name('staff.dashboard');

    // Form Teacher Routes
    Route::middleware(['isClassTeacher'])->group(function () {
        // Students Routes
        Route::prefix('/students')->group(function () {
            Route::get('/', [TeachersController::class, 'viewStudents'])->name('teachers.students.view');
        });

        // Reports Routes
        Route::prefix('/reports')->group(function () {
            Route::get('/academic', [TeachersController::class, 'profile'])->name('reports.academic');
            Route::get('/attendance', [TeachersController::class, 'editProfile'])->name('reports.attendance');
            Route::post('/behavioural', [TeachersController::class, 'updateProfile'])->name('reports.behavioural');
        });

        // Attendance Routes
        Route::prefix('/attendance')->group(function () {
            Route::get('/mark', [TeachersController::class, 'markAttendance'])->name('attendance.mark');
            Route::post('/store', [TeachersController::class, 'storeAttendance'])->name('attendance.store');
            Route::patch('/update', [TeachersController::class, 'updateAttendance'])->name('attendance.update');
        });

        // Examination Routes
        Route::prefix('/examinations')->group(function () {
            Route::get('/schedule', [TeachersController::class, 'scheduleExaminations'])->name('examinations.schedule');
            Route::post('/create', [TeachersController::class, 'createExamination'])->name('examinations.create');
        });

        //Assessment Upload
        Route::prefix('/upload')->group(function () {
            Route::get('/assessments', [TeachersController::class, 'uploadAssessments'])->name('upload.assessment');
            Route::post('/assessments', [TeachersController::class, 'storeAssessment'])->name('store.assessment');
            Route::patch('/assessments', [TeachersController::class, 'updateAssessment'])->name('update.assessment');
        });

        // Announcements Routes
        Route::prefix('/announcements')->group(function () {
            Route::get('/compose', [TeachersController::class, 'composeAnnouncement'])->name('announcements.compose');
            Route::post('/store', [TeachersController::class, 'storeAnnouncement'])->name('announcements.store');
            Route::get('/{id}', [TeachersController::class, 'viewAnnouncement'])->name('announcements.view');
            Route::get('/lists/{composer_id}', [TeachersController::class, 'listAnnouncements'])->name('announcements.sent');
            Route::delete('/{id}', [TeachersController::class, 'deleteAnnouncement'])->name('announcements.delete');
            Route::patch('/{id}', [TeachersController::class, 'updateAnnouncement'])->name('announcements.update');

        });

        // Notifications Routes
        Route::prefix('/notifications')->group(function () {
            Route::get('/', [TeachersController::class, 'notifications'])->name('notifications.index');
            Route::get('/{id}', [TeachersController::class, 'viewNotification'])->name('notifications.view');
        });
    });
});

// Student Routes
Route::middleware(['student'])->group(function () {
    Route::get('/students/dashboard', fn() => view('Students.dashboard'))->name('student.dashboard');
});

// Admission Officer Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/Admissions', fn() => view('Admission_Officer.dashboard'))->name('admissions_dashboard');
});

Route::middleware(['admission_officer', 'admin'])->group(function () {
    Route::prefix('/Admissions')->group(function () {
        // Route::get('StudentEntrollment', [AdmissionsController::class, 'admission'])->name('admissions');
        Route::post('StudentEntrollment', [AdmissionsController::class, 'store_student_enrolment'])->name('store_student_enrolment');
        Route::get('', [AdmissionsController::class, 'admission_index'])->name('admissions');
        Route::get('Enroled', [AdmissionsController::class, 'admission_list'])->name('admissions_list');
        Route::get('AdmissionLetter/{student_id}', [AdmissionsController::class, 'admission_letter'])->name('student_admission_letter');
    });
});

//Users Routes
Route::prefix('Users')->group(function () {
    Route::get('view', [userController::class, 'UserView'])->name('user.view');
    Route::post('store', [userController::class, 'StoreUser'])->name('store_user');
    Route::get('edit/{id}', [userController::class, 'EditUser'])->name('user.edit');
    Route::get('delete/{id}', [userController::class, 'DeleteUser'])->name('user.delete');
    Route::get('profile/{id}', [userController::class, 'UserProfile'])->name('user.view_profile');
    Route::post('update/{id}', [userController::class, 'UpdateUser'])->name('user.update');

});

// User Profile and Change password
Route::prefix('Profile')->group(function () {
    Route::get('view', [ProfileController::class, 'ProfileView'])->name('user.view-profile');
});

Route::prefix('Setup')->group(function () {
    Route::get('/', [SchoolSetupController::class, 'index'])->name('schoolsetup.index');
    Route::post('/', [SchoolSetupController::class, 'store'])->name('schoolsetup.store');
    Route::put('/', [SchoolSetupController::class, 'edit'])->name('schoolsetup.edit');
});

Route::prefix('/Examination')->group(function () {
    Route::get('ExamCard', [ExaminationController::class, 'Index'])->name('ExamCard');
    Route::get('ExamCardView', [ExaminationController::class, 'GenerateExamCard'])->name('GenerateExamCard');
    Route::get('Attendance', [ExaminationController::class, 'Attendance'])->name('exam_attendance');
    Route::get('ExamAttendanceView', [ExaminationController::class, 'AttendanceGenerate'])->name('exam_attendance_view');
});

Route::prefix('/')->group(function () {
    Route::get('AssRegistration', [AssessmentController::class, 'Index'])->name('ass_registration');
    Route::post('AssStore', [AssessmentController::class, 'StoreAssessment'])->name('store_assessment_type');
    Route::get('AsignAssessment', [AssessmentController::class, 'AssIndex'])->name('asign_assessment');
    Route::post('AsingAssessmentStore', [AssessmentController::class, 'StoreAsignAssessment'])->name('store_asign_assessment');
    Route::get('ScoreSheet', [AssessmentController::class, 'ScoreSheetIndex'])->name('score_sheet_form');
    Route::get('ScoresheetView', [AssessmentController::class, 'ViewScoreSheet'])->name('score_sheet_view');
    Route::get('ResultSeummary', [CassViewController::class, 'resultSummary'])->name('result_summary');
    Route::get('ViewResultSeummary', [CassViewController::class, 'viewResultSummary'])->name('view_result_summary');
});

Route::prefix('UploadResult')->group(function () {
    Route::get('/', [CassScoresController::class, 'upload'])->name('input_cass_scores');
    Route::get('Scores', [CassScoresController::class, 'uploadForm'])->name('cass_scores_form');
    Route::post('Scores', [CassScoresController::class, 'uploadScores'])->name('store_scores');
    Route::get('UpdateUploadedCass', [CassScoresController::class, 'updateUploadedCass'])->name('update_uploaded_cass');
    Route::post('OfflineUpload', [CassScoresController::class, 'offlineUpload'])->name('upload_offline');
    Route::get('DownloadOffline', [CassScoresController::class, 'downloadOffline'])->name('download_offline');
    Route::get('ViewUploadedResult', [CassViewController::class, 'viewCass'])->name('view_cass_scores');
});

Route::prefix('ResultManagement')->group(function () {
    Route::get('/', [ExaminationController::class, 'resultIndex'])->name('compute_result');
    Route::post('ComputeResult', [ExaminationController::class, 'storeComputeResult'])->name('store_compute_result');
    Route::get('Broadsheet', [CassViewController::class, 'broadsheet'])->name('broadsheet');
    Route::get('AnnualBroadsheet', [CassViewController::class, 'annualBroadsheet'])->name('annual_broadsheet');
    Route::get('ClassReportCards', [ReportController::class, 'classReport'])->name('class_report_cards');
    Route::get('StudentReportCard', [ReportController::class, 'studentReport'])->name('student_report_card');
    Route::get('AnnualStudentReport', [ReportController::class, 'annualStudentReport'])->name('annual_student_report');
});

Route::middleware('admin')->prefix('Staff')->group(function () {
    Route::get('/', [StaffController::class, 'Staff'])->name('staff');
    Route::post('store_staff_enrollment', [StaffController::class, 'StoreStudentAdmission'])->name('store_staff_enrollment');
    Route::get('EmploymentLetter/{id}', [StaffController::class, 'employmentLetter'])->name('employment_letter');
    Route::get('Profile/{id}', [StaffController::class, 'StaffProfile'])->name('staff_profile');
    Route::get('EditStaffRecord/{id}', [StaffController::class, 'EditStaffRecord'])->name('edit_staff_record');
    Route::post('update_staff_record/{id}', [StaffController::class, 'UpdateStudentRecord'])->name('update_staff_record');
    Route::get('delete_staff_record/{id}', [StaffController::class, 'DeleteStudentRecord'])->name('delete_staff_record');
});

Route::prefix('SchoolFees')->group(function () {
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

Route::prefix('CheckResult')->group(function () {
    Route::get('/', [CheckResultController::class, 'index']);
    Route::get('/Result', [CheckResultController::class, 'processResult'])->name('check_result');
});

Route::prefix('SchoolClasses')->group(function () {
    Route::get('/', [CheckResultController::class, 'index']);
    Route::get('/Result', [CheckResultController::class, 'processResult'])->name('student.result');
    Route::get('/Update', [SchoolClassController::class, 'StoreClassInfo'])->name('update_class_info');
});


Route::get('FeesResponse/{id}', [GeneralController::class, 'SchoolFees'])->name('fees_response');
Route::get('GetStudent/{id}', [GeneralController::class, 'StudentByClass'])->name('students');
Route::get('FeesDue/{id}', [GeneralController::class, 'FeesDue'])->name('students.fees_due');
Route::get('GetClass/{id}', [GeneralController::class, 'getSubject'])->name('get_class');
Route::get('GetLGA/{id}', [GeneralController::class, 'GetLGA'])->name('get_lgas');
Route::get('AdmittedStudents/{class_info}', [GeneralController::class, 'AdmittedStudents'])->name('number_of_admitted');
Route::get('GetStudents/{students}', [GeneralController::class, 'students'])->name('get_students');

