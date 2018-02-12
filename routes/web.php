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

Route::get('/', 'MatriculaController@index')->name('matriculas.dashboard');
Route::get('/matriculas/create', 'MatriculaController@create')->name('matriculas.create');
Route::post('/matriculas/store', 'MatriculaController@store')->name('matriculas.store');
Route::get('/matriculas/{matricula}', 'MatriculaController@show')->name('matriculas.show');
Route::get('/matriculas/cancelar/{matricula}', 'MatriculaController@cancelar')->name('matriculas.cancelar');
Route::delete('/matriculas/{matricula}', 'MatriculaController@destroy')->name('matriculas.destroy');
Route::get('/matriculas/pagamento/{pagamento}', 'MatriculaController@pagamento')->name('matriculas.pagamento');
Route::post('/matriculas/pagamento/{pagamento}', 'MatriculaController@pagar')->name('matriculas.pagar');
Route::post('/matriculas/calculo-troco', 'MatriculaController@calculoTroco')->name('matriculas.calculo-troco');

Route::resource('alunos', 'AlunoController');
Route::resource('cursos', 'CursoController');
