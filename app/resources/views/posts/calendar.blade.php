@extends('layouts.app')

@section('content')


<div class="container">
    <h3><a href="?ym=<?php echo $prev; ?>">&lt;</a><?php echo $html_title; ?><a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
    <table class="table table-bordered">
        <tr>
            <th>日</th>
            <th>月</th>
            <th>火</th>
            <th>水</th>
            <th>木</th>
            <th>金</th>
            <th>土</th>
        </tr>
        <tr>
        <td></td>
        <td></td>
        <td>1</td>
            ~~~
        <td>5</td>
        </tr>
        <tr>
        <td>6</td>
            ~~~
        <td>12</td>
        </tr>
        <tr>
        <td>13</td>
            ~~~
        <td>19</td>
        </tr>
        <tr>
        <td>20</td>
            ~~~
        <td>26</td>
        </tr>
        <tr>
        <td>27</td>
            ~~~
        <td>31</td>
        <td></td>
        <td></td>
        </tr>
    </table>
</div>

@endsection