@extends('layouts.dashboard.master')
@section("title","Home")
@section('content')


<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>
    <div class="section-body">
            <div class="card">
              <div class="card-header">
                <h4>Informasi Data</h4>
              </div>
              <div class="card-body">
              <div class="row">
              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1">
                    <div class="card-wrap">
                      <div class="card-header">
                        <h5>Member</h5>
                      </div>
                      <div class="card-body">
                        5 Orang
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1">
                    <div class="card-wrap">
                      <div class="card-header">
                        <h5>Spesies</h5>
                      </div>
                      <div class="card-body">
                        100 Data
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1">
                    <div class="card-wrap">
                      <div class="card-header">
                        <h5>Valid</h5>
                      </div>
                      <div class="card-body">
                        80 Data
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1">
                    <div class="card-wrap">
                      <div class="card-header">
                        <h5>Tidak Valid</h5>
                      </div>
                      <div class="card-body">
                        20 Data
                      </div>
                    </div>
                  </div>
                </div>
              </div>    
              </div>
              <div class="card-footer bg-whitesmoke">
                Anda Login Sebagai ( Admin )
              </div>
            </div>
          </div>
  </section>
</div>

@endsection