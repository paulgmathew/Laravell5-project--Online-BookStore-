@extends('layouts.master_admin')

@section('styles')
<!--<link rel="stylesheet" href="{{ URL::secure('src/css/sidebar.css')}}" type="text/css" />-->
@endsection
@section('navbarli')
        <li class="active"><a href="{{ route('managementaction',['action'=> 'dashboard']) }}">Dashboard</a></li>
        <li><a href="{{ route('managementaction',['action'=> 'bookmanager']) }}">Book Management</a></li>
        <li><a href="{{ route('managementaction',['action'=> 'itemmanager']) }}">Item Management</a></li>
        <li><a href="{{ route('managementaction',['action'=> 'categorymanager']) }}">Category Management</a></li>
@endsection
@section('content')
<div class="container-fluid contentcontainer">
  <div class="row content center">
    <div class = "welcome">
      Welcome to the Admin System for online book store!
    </div>
    
    <!--<div class="col-sm-12">-->
    <!--  <div class="row">-->
    <!--    <div class="col-sm-3">-->
    <!--      <div class="well">-->
    <!--        <h4>Users</h4>-->
    <!--        <p>1 Million</p> -->
    <!--      </div>-->
    <!--    </div>-->
    <!--    <div class="col-sm-3">-->
    <!--      <div class="well">-->
    <!--        <h4>items</h4>-->
    <!--        <p>100 Million</p> -->
    <!--      </div>-->
    <!--    </div>-->
    <!--    <div class="col-sm-3">-->
    <!--      <div class="well">-->
    <!--        <h4>books</h4>-->
    <!--        <p>10 Million</p> -->
    <!--      </div>-->
    <!--    </div>-->
    <!--    <div class="col-sm-3">-->
    <!--      <div class="well">-->
    <!--        <h4>orders</h4>-->
    <!--        <p>1 Million</p> -->
    <!--      </div>-->
    <!--    </div>-->
    <!--  </div>-->
    <!--  <div class="row">-->
    <!--    <div class="col-sm-4">-->
    <!--      <div class="well">-->
    <!--        <h4>Hot Members</h4>-->
    <!--        <p>Text</p> -->
    <!--        <p>Text</p> -->
    <!--        <p>Text</p>-->
    <!--        <p>Text</p> -->
    <!--        <p>Text</p> -->
    <!--        <p>Text</p>-->
    <!--        <p>Text</p> -->
    <!--        <p>Text</p> -->
    <!--        <p>Text</p> -->
    <!--        <p>Text</p>-->
    <!--        <p>more...</p>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--    <div class="col-sm-4">-->
    <!--      <div class="well">-->
    <!--        <h4>Best Seller</h4>-->
    <!--        <p>Text</p> -->
    <!--        <p>Text</p> -->
    <!--        <p>Text</p>-->
    <!--        <p>Text</p> -->
    <!--        <p>Text</p> -->
    <!--        <p>Text</p>-->
    <!--        <p>Text</p> -->
    <!--        <p>Text</p> -->
    <!--        <p>Text</p> -->
    <!--        <p>Text</p>-->
    <!--        <p>more...</p>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--    <div class="col-sm-4">-->
    <!--      <div class="well">-->
    <!--        <h4>recent orders</h4>-->
    <!--        <p>Text</p> -->
    <!--        <p>Text</p> -->
    <!--        <p>Text</p>-->
    <!--        <p>Text</p> -->
    <!--        <p>Text</p> -->
    <!--        <p>Text</p>-->
    <!--        <p>Text</p> -->
    <!--        <p>Text</p> -->
    <!--        <p>Text</p> -->
    <!--        <p>Text</p>-->
    <!--        <p>more...</p>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--  </div>-->
    <!--</div>-->
  </div>
</div>

@endsection