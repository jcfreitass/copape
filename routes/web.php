<?php

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

Route::get ('/', 'planoController@index')->name('home');;

Auth::routes();

Route::get ('/search', 'planoController@search');

Route::get ('/validacao/{id}', 'planoController@validacao');
Route::get ('/recusar/{id}', 'planoController@recusarPlano'); // recusar o plano de aula

Route::get ('/create_plano', 'planoController@create');
Route::post ('/create_plano', 'planoController@store');
Route::get ('/download/{idx_file}', 'planoController@download')->name('downloadFile');
Route::get ('/downloadMaterialExtra/{idx_file}', 'planoController@downloadMatrialExtra')->name('downloadMaterialExtra');

Route::get ('/perfil_aluno', 'planoController@perfilAluno');
Route::get ('/handle_plan_student', 'planoController@handlePlanStudent');
Route::get ('/perfil_professor', 'planoController@perfilProfessor');
Route::get ('/handle_plan_teacher', 'planoController@handlePlanTeacher');



Route::get('/edit_plano/{id}', 'planoController@edit');
Route::post('/edit_plano/{id}', 'planoController@update');


Route::delete ('/delete_plano/{id}', 'planoController@destroy');
Route::delete ('/delete_course/{id}', 'planoController@destroyCourse');


Route::get('/select_plano/{id}', 'planoController@select')->name('selectPlan');

//Route::redirect('/choose_type_student', '/'); 

Route::get('autocomplete', 'planoController@autocomplete')->name('autocomplete');

Route::get ('/choose_type', 'planoController@chooseType');
Route::get ('/choose_type_teacher', 'planoController@chooseTypeTeacher');
Route::get ('/choose_type_student', 'planoController@chooseTypeStudent');
Route::get ('/choose_type_update', 'planoController@chooseTypeUpdate');
Route::get ('/choose_type_teacher_update', 'planoController@chooseTypeTeacherUpdate');
Route::get ('/choose_type_student_update', 'planoController@chooseTypeStudentUpdate');

Route::get ('/choose_course', 'planoController@chooseCourse')->name('chooseCourse');
Route::post ('/choose_course', 'planoController@createCourse');

Route::get ('/update_user', 'planoController@editUser');
Route::post('/update_user', 'planoController@updateUser');

Route::get('/changePassword','planoController@showChangePasswordForm');
Route::post('/changePassword','planoController@changePassword')->name('changePassword');

Route::get ('/auth_user', 'planoController@authUser');
Route::get ('/accept_course/{id}', 'planoController@acceptCourse');
Route::get ('/refuse_course/{id}', 'planoController@refuseCourse');
Route::get ('/again_course/{id}', 'planoController@againCourse');

Route::get('/select_modal/{id}', 'planoController@selectModal');

Route::get('/managementUser', 'planoController@management_user')->name('managementUser');
Route::delete ('/delete_user/{id}', 'planoController@destroyUser');
Route::get ('/search_user', 'planoController@searchUser');
