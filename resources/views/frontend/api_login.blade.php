@extends('layouts.frontend')
<div id="app">
    <login-api-component action-url="http://localhost:8081/api/auth/login"></login-api-component>
</div>
<script src="{{asset('js/app.js')}}"></script>


