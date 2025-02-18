<?php

 use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\OfficeHours;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\AnnouncemetsController;

use App\Http\Controllers\ScheudleController;
use App\Http\Controllers\Top50Controller;
use App\Http\Controllers\ExamHallController;
use App\Http\Controllers\gpController;
use App\Http\Controllers\courseEvaluation;
use App\Http\Controllers\PrerequisiteCousreController;
use App\Http\Controllers\CourseReigesterController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProgramPerferenceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\professorAndTa;
use App\Http\Controllers\TAController;


use App\Http\Controllers\adminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// test2
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('data',[OfficeHours::class,'index']);
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    // Route::post('/returnType', [AuthController::class, 'returnType']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);   
    Route::post('sendPasswordResetLink', 'App\Http\Controllers\PasswordResetRequestController@sendEmail');
    Route::post('resetPassword', 'App\Http\Controllers\ChangePasswordController@passwordResetProcess');

});
Route::post('sendEmail',[MailController::class,'sendEmail']);


Route::get('/getAllAnnouncemets',[AnnouncemetsController::class,'getAllAnnouncment']);
Route::get('/getTopLevel50/{level}',[Top50Controller::class,'getTopLevel50']);
Route::get('/getTopLevelAndDept/{level}/{dept}',[Top50Controller::class,'getTopLevelAndDept']);
Route::get('/getTopDept50/{dept?}',[Top50Controller::class,'getTopDept50']);
Route::get('/getTopCourse50/{CourseName}',[Top50Controller::class,'getTopCourse50']);
Route::get('/getAllCourses',[Top50Controller::class,'getAllCourses']);
Route::get('/getAllDepartmentswithGeneral',[Top50Controller::class,'getAllDepartments']);
Route::get('/downloadScheudle/{Scheudle_Name}',[ScheudleController::class,'downloadScheudle']);
Route::get('/getexamHall/{studentID}',[ExamHallController::class,'ExamHalls']);


Route::get('/student_info/{token}',[AuthController::class,'getStudentInfo']);
Route::get('/getAdminInfo/{token}',[AuthController::class,'getAdminInfo']);
Route::get('/getCourseGroup/{courseID}',[CourseReigesterController::class,'getCourseGroup']);
Route::get('/getCourseInfo/{courseID}',[CourseReigesterController::class,'getCourseInfo']);
Route::post('/registerCourse',[CourseReigesterController::class,'registerCourse']);
Route::get('/returnCourseResult/{studentid}',[CourseReigesterController::class,'returnCourseResult']);
Route::get('/returnScheudule/{studentid}',[CourseReigesterController::class,'returnScheudule']);
Route::get('/getTAId/{groupNumber}/{courseId}',[CourseReigesterController::class,'getTAId']);
Route::post('/registerCourses',[CourseReigesterController::class,'registerCourses']);

Route::post('/registerGP',[gpController::class,'insert']);
Route::get('/returnAllProfessor',[gpController::class,'returnAllProfessor']);
Route::get('/returnAllTAs',[gpController::class,'returnAllTAs']);
Route::post('/courseEvaluation',[courseEvaluation::class,'insertCourseEvaluation']);

Route::get('/returnAllLocations',[OfficeHours::class,'returnAllLocations']);
Route::get('/returnAllDepartments',[OfficeHours::class,'returnAllDepartments']);
Route::get('/selectTeacherOfficeHour/{teacherName}',[OfficeHours::class,'selectTeacherOfficeHour']);
// Route::get('/courseEvaluationDetails/{courseID}',[courseEvaluation::class,'getCourseDetails']);
Route::get('/CourseeForSemester/{level}/{semester}/{id}',[PrerequisiteCousreController::class,'getCourses_Student']);
// Route::get('/getCourseID/{courseName}',[courseEvaluation::class,'getCourseID']);
Route::get('/getProfessorDetails/{studId}/{courseID}',[courseEvaluation::class,'getProfessorDetails']);
Route::get('/getTADetails/{studId}/{courseID}',[courseEvaluation::class,'getTADetails']);
Route::get('/getStudentCourses/{studId}/{term}',[courseEvaluation::class,'getStudentCourses']);

// Endpoint for registering a new user
Route::post('/register', 'AuthController@register');

Route::get('/getAllDepartments',[ProgramPerferenceController::class,'getAllDepartments']);
Route::post('/registerPerefernces',[ProgramPerferenceController::class,'registerPerefernces']);
Route::put('/updateProfile/{id}',[ProfileController::class,'updateProfile']);
///////////////////////////////////////
//new for chat

// Route::middleware('auth:api')->group(function () {
//     // Endpoint for retrieving the list of chat users
Route::get('/students', [ChatController::class,'listStudents']);

// Endpoint for retrieving the chat history between two users
Route::get('/getHistory/{user1}/{user2}', [ChatController::class,'getHistory']);

// Endpoint for sending a message from one user to another
Route::post('/message', [ChatController::class,'sendMessage']);

Route::get('/receive', [ChatController::class,'receive']);
Route::get('/professorsDetails', [ChatController::class,'getProfessorDetails']);
Route::get('/TADetails', [ChatController::class,'getTADetails']);

// });
// Route::middleware('auth:api')->group(function () {
//     // Endpoint for retrieving the list of chat users
Route::get('/students', [ChatController::class,'listStudents']);
Route::get('/professorsAndTas', [ChatController::class,'listProfessorsAndTAs']);
// Endpoint for retrieving the chat history between two users
Route::get('/history/{user1}/{user2}', [ChatController::class,'getHistory']);

// Endpoint for sending a message from one user to another
Route::post('/message', [ChatController::class,'sendMessage']);

Route::get('/receive', [ChatController::class,'receive']);
Route::get('/professorsDetails', [ChatController::class,'getProfessorDetails']);
Route::get('/TADetails', [ChatController::class,'getTADetails']);
Route::get('/getStudentsDetails', [ChatController::class,'getStudentsDetails']);
/////////////
// block student
Route::post('/updateStudentStatus/{studentId}/{status}', [ChatController::class,'updateStudentStatus']);
Route::get('/getStudentStatus/{studentId}', [ChatController::class,'getStudentStatus']);
////////////


// });
// Endpoint for authenticating a user
Route::post('/login', 'AuthController@login');
Route::post('/returnType', 'AuthController@returnType');

// Endpoint for registering a new user
Route::post('/register', 'AuthController@register');



//////Professor part////////////////
Route::get('/returnProfScheudule/{professorID}/{Semester}', [ProfessorController::class,'returnProfScheudule']);
Route::get('/returnAllPlaces', [ProfessorController::class,'returnAllPlaces']);
Route::get('/returnPlaceScheduale/{place}/{Semester}', [ProfessorController::class,'returnPlaceScheduale']);
Route::get('/returnCourseScheudule/{courseid}/{Semester}', [ProfessorController::class,'returnCourseScheudule']);
Route::post('/insertOfficeHour/{id}', [ProfessorController::class,'insertOfficeHour']);
Route::get('/returnProfOfficeHours/{id}', [ProfessorController::class,'returnProfOfficeHours']);
Route::get('/returnTAOfficeHours/{id}', [ProfessorController::class,'returnTAOfficeHours']);
Route::delete('/deleteOfficeHours/{id}', [ProfessorController::class,'deleteOfficeHours']);
Route::put('/updateProfProfile/{id}',[ProfessorController::class,'updateProfProfile']);
Route::put('/updateTAProfile/{id}',[ProfessorController::class,'updateTAProfile']);
Route::put('/updateProfOfficeHour/{id}',[ProfessorController::class,'updateProfOfficeHour']);


Route::get('/getStudentData/{id}',[ProfessorController::class,'getStudentData']);
////////////TA part
Route::get('/returnTAScheudule/{TAID}/{Semester}', [TAController::class,'returnTAScheudule']);


/////////////professor and ta section////////////////
Route::get('/myCourses/{professorId}', [professorAndTa::class,'getMyCourses']);
Route::get('/selectLevel/{level}', [professorAndTa::class,'selectLevel']);
Route::get('/selectGrade_level_course/{grade}/{level}/{course}', [professorAndTa::class,'selectGrade_level_course']);
Route::get('/returnTeacherGPs/{teacherId}', [professorAndTa::class,'returnTeacherGPs']);
Route::get('/selectLevel_Course/{level}/{course}', [professorAndTa::class,'selectLevel_Course']);

Route::get('/getCourseProfYears/{professorId}/{courseID}', [professorAndTa::class,'getCourseProfYears']);
Route::get('/getCourseProfYears2/{professorId}/{courseName}', [professorAndTa::class,'getCourseProfYears2']);
Route::get('/getCourseTAYears/{TAId}/{courseName}', [professorAndTa::class,'getCourseTAYears']);
Route::get('/getCourseYears', [professorAndTa::class,'getCourseYears']);
Route::get('/getTACourses/{TAId}', [professorAndTa::class,'getTACourses']);
Route::get('/getMyStudents/{professorId}', [professorAndTa::class,'getMyStudents']);
Route::get('/getGrades/{professorId}', [professorAndTa::class,'getGrades']);
Route::get('/selectCourse/{courseName}/{teacherId}', [professorAndTa::class,'selectCourse']);
Route::get('/selectGrade/{courseGrade}', [professorAndTa::class,'selectGrade']);
Route::get('/returnCourseTAS/{courseid}', [ProfessorController::class,'returnCourseTAS']);
Route::get('/returnCourseStat/{courseid}/{Year}/{Deparment}', [ProfessorController::class,'returnCourseStat']);
Route::get('/returnCourseStudent/{courseid}/{Year}/{Deparment}', [ProfessorController::class,'returnCourseStudent']);
Route::get('/returnGradeAvg/{courseid}/{Year}/{Deparment}', [ProfessorController::class,'returnGradeAvg']);
Route::get('/searchByStudent/', [ProfessorController::class,'searchByStudent']);
Route::get('/returnRequestsGP/{Type}/{id}', [ProfessorController::class,'returnRequestsGP']);
Route::put('/acceptGP_prof/{id}', [ProfessorController::class,'acceptGP_prof']);
Route::put('/rejectGP_prof/{id}', [ProfessorController::class,'rejectGP_prof']);
Route::put('/acceptGP_TA/{id}', [ProfessorController::class,'acceptGP_TA']);
Route::put('/rejectGP_TA/{id}', [ProfessorController::class,'rejectGP_TA']);
Route::get('/returnAllProfessor', [ProfessorController::class,'returnAllProfessor']);
Route::post('/AddCourse', [ProfessorController::class,'AddCourse']);
Route::get('/returnAllTAs', [ProfessorController::class,'returnAllTAs']);


Route::get('/professor_info/{token}', [AuthController::class,'getProfessorInfo']);
Route::get('/ta_info/{token}', [AuthController::class,'getTaInfo']);
Route::get('/getUserType/{token}', [AuthController::class,'getUserType']);

Route::post('/store', [ChatController::class,'store']);
Route::post('/addAnnouncments', [AnnouncemetsController::class,'addAnnouncment']);
////////Get feebacks//////////
Route::get('/getFeedbacks/{courseName}/{professorId}/{year}', [courseEvaluation::class,'getFeedbacks']);
Route::get('/getTAs_Feedbacks_for_specific_course/{courseName}/{professorId}/{year}', [courseEvaluation::class,'getTAs_Feedbacks_for_specific_course']);

/////////////admin section///////////////
Route::get('/returnAcceptedRequestsGP', [adminController::class,'returnAcceptedRequestsGP']);
Route::post('/updateAnnouncmentStatus/{annID}', [AnnouncemetsController::class,'updateAnnouncmentStatus']);

Route::get('/get_Number_Of_Students_In_Department/{year}', [adminController::class,'get_Number_Of_Students_In_Department']);
Route::get('/get_GPA_distribution_In_Department/{year}', [adminController::class,'get_GPA_distribution_In_Department']);
Route::get('/getPreferencesYears', [adminController::class,'getPreferencesYears']);
Route::post('/calculateGPA', [adminController::class,'calculateGPA']);
Route::put('/setDepatmentToStudent', [ProgramPerferenceController::class,'setDepatmentToStudent']);

Route::get('/getAllCourses', [adminController::class,'getAllCourses']);
Route::get('/getStudentInCourse/{courseId}', [adminController::class,'getStudentInCourse']);

Route::post('/addGrade/{courseId}/{studentId}', [adminController::class,'addGrade']);
Route::put('/setEvaluationStatus/{status}',[adminController::class,'setEvaluationStatus']);
Route::put('/setGPFormStatus/{status}',[adminController::class,'setGPFormStatus']);
Route::get('/getAdminControlStatus',[adminController::class,'getAdminControlStatus']);

Route::put('/updateRegisterationStatus/{status}', [adminController::class,'updateRegisterationStatus']);

Route::put('/updateprogramSelectionStatus/{status}', [adminController::class,'updateprogramSelectionStatus']);
Route::post('/AddGroup', [adminController::class,'AddGroup']);
Route::get('/getRegisterationStatus', [adminController::class,'getRegisterationStatus']);
/////////////////////////chat updates
Route::get('/getAllContacts/{senderID}/{sendertype}', [ChatController::class,'getAllContacts']);
Route::get('/getUserInfo/{token}', [AuthController::class,'getUserInfo']);
Route::get('/getRecentContacts/{senderID}', [ChatController::class,'getRecentContacts']);

Route::post('/blockUser/{userId1}/{userId2}', [ChatController::class,'blockUser']);
Route::delete('/unBlockUser/{userId1}/{userId2}', [ChatController::class,'unBlockUser']);
Route::get('/getBlockedUsers/{userId1}/{userId2}', [ChatController::class,'getBlockedUsers']);
Route::put('/updateSeenStatus/{userId1}/{userId2}', [ChatController::class,'updateSeenStatus']);
Route::post('/sendNotification/{mailMessage}', [ChatController::class,'sendNotification']);