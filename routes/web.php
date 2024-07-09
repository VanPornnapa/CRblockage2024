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

Route::get('/','DataForExpertController@getDataforHome');
Route::get('login', function () {return view('auth/login');});
Route::get('register', function () {return view('auth/register');});
//Route::get('/report/map', function () {return view('pages.testmap');});


//Route::get('/backup', function () {return view('result');});


Route::get('report', 'FormBlockageController@reportBackend');
Route::get('/report/map', 'MapController@getDamageByAmp'); 
Route::get('/report/map', 'MapController@getDamageByAmpG'); 
Route::get('/report/mapCM', 'MapController@getDamageByAmpFang');

// --Drop Down select AMP or tambol to gen pdf --
Route::get('/reports/map', 'MapController@getDamageByAmpG'); 
Route::get('/reports/problem', function () {return view('general/problem');});
Route::get('reports/problem/pdf', "pdfController@tablegen")->name('reports/pdf');
Route::get('/reports/solution', function () {return view('general/solution');});
Route::get('reports/solution/pdf', "DataForExpertController@solutionPDFgen")->name('reports/solution');
Route::get('/reports/summary', function () {return view('general/summary');});

Route::get('report/pdf/amp','DataForExpertController@expertPDFAmp')->name('report/pdf/amp');
// --Drop Down select AMP or tambol to gen pdf --


Route::get('report_admin', 'FormBlockageController@getBlockagebyAdmin');
Route::get('report_all', 'FormBlockageController@getBlockagebyAdminAll');
Route::get('report_detail/{id}', 'FormBlockageController@reportBlockageDetail');
Route::get('blocker', 'FormBlockageController@getBlockagebyUser')->name('blocker');
Route::get('data', 'FormBlockageController@getdata')->name('data');



Route::get('newblockage', 'PagesController@newFormblockage');
Route::get('reportBlockage/{id}', ['as' => 'reportBlockage', 'uses' => 'FormBlockageController@reportBlockage']);

Route::get('upphoto/{id}', ['as' => 'upphoto', 'uses' => 'QuestionController4@BlockageId']);



Route::get('form/questionnaire', "QuestionController@questionnaire");
Route::get('form/questionnaire2', "QuestionController2@questionnaire2")->name('form.Qnaire2');
Route::get('form/questionnaire3', "QuestionController3@questionnaire3")->name('form.Qnaire3');
Route::get('form/questionnaire4', "QuestionController4@questionnaire4")->name('form.Qnaire4');
Route::get('form/questionnaire5/{id}', "QuestionController5@questionnaire5")->name('form.Qnaire5');
Route::get('form/questionnaire6/{id}', "QuestionController6@questionnaire6")->name('form.Qnaire6');
//Route::get('form/questionnaire5/{id}', ['as' => 'form/questionnaire5', 'uses' => 'QuestionController5@BlockageId'])->name('form.Qnaire5');

Route::get('form/map', "MapController@map");

Route::post('form/questionnaire/store', 'QuestionController@store')->name('form.Qnaire.store');
Route::get('form/questionnaire/addBlockage', 'QuestionController@addBlockage')->name('form.Qnaire.addBlockage');
Route::get('form/questionnaire/addXsection', 'QuestionController@addXsection')->name('form.Qnaire.addXsection');
Route::get('form/questionnaire/addCulvert', 'QuestionController@addCulvert')->name('form.Qnaire.addCulvert');
Route::get('form/questionnaire/get', 'QuestionController@getData')->name('form.Qnaire.getData');
Route::get('form/questionnaire/getBlockage', 'QuestionController@getBlockageData')->name('form.Qnaire.getBlockageData');
Route::get('form/questionnaire2/addProblem', 'QuestionController2@addProblem')->name('form.Qnaire2.addProblem');

Route::get('form/questionnaire3/addSolution', 'QuestionController3@addSolution')->name('form.Qnaire3.addSolution');

Route::get('form/questionnaire/get', 'QuestionController@getData')->name('form.Qnaire.getData');
Route::get('form/questionnaire/getBlockage', 'QuestionController@getBlockageData')->name('form.Qnaire.getBlockageData');
Route::post('form/questionnaire4', "QuestionController4@uploadImage")->name('form.Qnaire4.uploadImage');
Route::post('form/questionnaire5', "QuestionController5@uploadImage")->name('form.Qnaire5.uploadImage');
Route::post('form/questionnaire6', "QuestionController6@uploadImage")->name('form.Qnaire6.uploadImage');


Route::get('/upphoto1', "QuestionController4@uploadImageOne")->name('uploadImageOne');

//Route::get('photo', 'PhotoController@index')->name('photo');
//Route::post('photo', 'PhotoController@uploadImage');
Route::get('/indexdistrict', 'PagesController@indexdistrict'); 
Route::get('/blockage/{id}', 'PagesController@formblockage'); 
Route::get('/getdistrict/{id}', 'PagesController@getDistrict');
Route::get('/getTumbol/{id}', 'PagesController@getTumbol');
Route::get('/getVillage/{id}', 'PagesController@getVillage');



Route::get('/editblockage/{id}', 'PagesController@editblockage'); 


//Controller Form_blockage
Route::get('/form_blockage', "FormBlockageController@formblockage");
Route::get('form/storeform', 'FormBlockageController@storeform')->name('form.storeform');
Route::get('form/getBlockage', 'FormBlockageController@getBlockageData')->name('form.getBlockageData');
Route::get('/getBlockageID/{id}', 'FormBlockageController@getBlockageID');
Route::get('edit/{id}', 'FormBlockageController@editform')->name('editform');


//PD
Route::get('blockagePDFview', "pdfController@viewBlockagePDF");
Route::get('blockagePDF/export', "pdfController@exportPDF");

Route::get('reportblockage/pdf/{id}', "pdfController@view");
Route::get('report/pdf', "pdfController@table")->name('report/pdf');
Route::get('report/pdfCM', "pdfController@tableCM")->name('report/pdfCM');


Route::get('form/getBlockageMap', 'MapController@getBlockageMap')->name('form.getBlockageMap');
//Route::get('getBlockageID/{id}', 'FormBlockageController@getBlockageID')->name('getBlockageID');
Route::get('getBlockageID/{id}', ['as' => 'getBlockageID', 'uses' => 'FormBlockageController@getBlockageID']);
Route::get('getBlockagebyUser/{user}', ['as' => 'getBlockagebyUser', 'uses' => 'FormBlockageController@getBlockagebyUser']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('report/chart', 'HighChartController@index')->name('report/chart');
Route::get('report/chart/{amp}', 'HighChartController@prob');

Route::get('chart', 'HighChartController@indexAll')->name('chartAll');
Route::get('chart/{amp}', 'HighChartController@probAll');

Route::get('report/chartCM', 'HighChartController@indexCM')->name('report/chart');
Route::get('report/chartCM/{amp}', 'HighChartController@probCM');


Route::get('form/getDamage/{amp}', 'MapController@getDamage')->name('form.getDamage');
Route::get('form/getDamagetest/{amp}', 'MapController@getDamage_test');
// Route::get('test', 'MapController@getDamageByAmp');



// CM Fang
Route::get('api/getcm', 'MapController@getDamageByAmpCM');
Route::get('api/getDamageCM/{amp}', 'MapController@getDamageCM');
Route::get('api/blockage', 'DataFangController@getBlockage');
Route::get('api/blockage/{amp}/{tambol}', 'DataFangController@getBlockageAmp');
Route::get('api/reportBlockage/{id}', ['as' => 'reportBlockage', 'uses' => 'DataFangController@reportBlockage']);

Route::get('api/chart/{amp}', 'DataFangController@apiCM');

Route::get('admin',function () {return view('auth/admin');});
Route::get('api/expertPDF/{id}', 'DataFangController@expertPDF');
Route::get('api/solution', "DataForExpertController@getsolutionPDF");

// report Expet
Route::get('/expert','DataForExpertController@getDataforexpert')->name('expert.expert');
Route::get('expert/report/{id}','DataForExpertController@reportExpert');
Route::get('report/pdf/{id}','DataForExpertController@expertPDF')->name('pdf');

Route::get('expert/photo/{id}','DataForExpertController@showPhoto')->name('expert.photo');
Route::post('expert/upphoto', "DataForExpertController@uploadImage")->name('expert.upphoto');
Route::get('report/solution', "DataForExpertController@solutionPDF")->name('report/solution');
Route::get('report/photo/{id}', "DataForExpertController@showPhotoDownload")->name('expert.showphoto');
// Route::get('report/photo',function () {return view('expert/showphoto');});


// menubar
Route::get('homenew',function () {return view('pages/home');});
Route::get('contact',function () {return view('menubar/contact');});
Route::get('floodManage',function () {return view('menubar/flood_manage');});
Route::get('floodPreparedness',function () {return view('menubar/flood_preparedness');});
Route::get('floodProtect',function () {return view('menubar/flood_protect');});
Route::get('floodStructures',function () {return view('menubar/flood_structures');});
Route::get('projectInfomation',function () {return view('menubar/projectInfo');});
Route::get('manual',function () {return view('menubar/manual');});
Route::get('project',function () {return view('menubar/project');});
Route::get('project/{id}', 'ProjectCaseController@case');


// menubar => blackEnd
Route::get('floodmanage',function () {return view('menubar/blackEnd/flood_manage');});
Route::get('Contact',function () {return view('menubar/blackEnd/contact');});
Route::get('floodpreparedness',function () {return view('menubar/blackEnd/flood_preparedness');});
Route::get('floodprotect',function () {return view('menubar/blackEnd/flood_protect');});
Route::get('floodstructures',function () {return view('menubar/blackEnd/flood_structures');});
Route::get('projectinfomation',function () {return view('menubar/blackEnd/projectInfo');});


Route::get('index',function () {return view('pages/index');});

// New
Route::get('/map/{id}', 'MapController@getLocation');

// rain 
Route::get('mapthai',function () {return view('rain/thai');});
Route::get('mapthai/chiangrai',function () {return view('rain/chiangrai');});
Route::get('mapthai/chiangrai/{amp}', 'RaindataController@getIDF');


///////////admin

Route::get('usermanagement', 'UserController@getUser');
Route::get('admin/register',function () {return view('admin/register');});
Route::get('admin/edit/{id}','UserController@getdetailUser');
