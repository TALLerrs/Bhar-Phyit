<?php

use Illuminate\Support\Facades\Route;
use Tallerrs\BharPhyit\Http\Livewire\BharPhyit as LivewireBharPhyit;
use Tallerrs\BharPhyit\Http\Livewire\BharPhyitDetail as LivewireBharPhyitDetail;

// http://filament.test/bhar-phyit
Route::get('bhar-phyit', LivewireBharPhyit::class)->name('bhar-phyit');
Route::get('bhar-phyit/{id}', LivewireBharPhyitDetail::class)->name('bhar-phyit-detail');
