@extends('layouts.master')
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>-->
<?php
Cookie::queue("name","Paul", 10);
?>
@section('content')
  @include('includes.mainbody')
@endsection
