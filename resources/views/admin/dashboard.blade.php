@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>
        Dashboard
    </h3>
</div>

<div class="row">

  <!-- Card 1 -->
  <div class="col-md-3 stretch-card grid-margin">
    <div class="card card-tale">
      <div class="card-body">
        <p class="mb-4">Total Counter</p>
        <p class="fs-30 mb-2">{{ $counters }}</p>
      </div>
    </div>
  </div>

  <!-- Card 2 -->
  <div class="col-md-3 stretch-card grid-margin">
    <div class="card card-dark-blue">
      <div class="card-body">
        <p class="mb-4">Total Product</p>
        <p class="fs-30 mb-2">{{ $products }}</p>
      </div>
    </div>
  </div>

  <!-- Card 3 -->
  <div class="col-md-3 stretch-card grid-margin">
    <div class="card card-light-blue">
      <div class="card-body">
        <p class="mb-4">Total Staff</p>
        <p class="fs-30 mb-2">{{ $staff }}</p>
      </div>
    </div>
  </div>

  <!-- Card 4 -->
  <div class="col-md-3 stretch-card grid-margin">
    <div class="card card-light-danger">
      <div class="card-body">
        <p class="mb-4">Total Promo</p>
        <p class="fs-30 mb-2">{{ $promos }}</p>
      </div>
    </div>
  </div>

</div>

@endsection
