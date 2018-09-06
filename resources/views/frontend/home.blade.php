@extends('layouts.frontend')
<div id="app">
    <combo-component data-url="http://localhost:8081/api/catelory/all"></combo-component>
</div>
<script src="{{asset('js/app.js')}}"></script>


