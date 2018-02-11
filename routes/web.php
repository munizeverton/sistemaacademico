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
Route::delete('/matriculas/{matricula}', 'MatriculaController@cancelar')->name('matriculas.destroy');

Route::resource('alunos', 'AlunoController');
Route::resource('cursos', 'CursoController');
