@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }},   {{ __('You are logged in!') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" action="{{ route('processGitHubSearch') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="searchKey" class="col-md-4 col-form-label text-md-right"> Type github username for a single search result, or submit an empty text field to get the 10 listings of Github usernames. </label>
                            <div class="col-md-6">
                                <input id="searchKey" name="searchKey" placeholder="Type a github username" type="text" class="form-control" autofocus>

                                <button type="submit" class="btn btn-primary">
                                    {{ __('SEARCH') }}
                                </button>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">

                            </div>
                        </div>

                    </form>

                    <?php if(isset($rs)) {
                     //echo $searchResult;
                     ?>

                     <table class="table">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Login</th>
                            <th>Company</th>
                            <th>No. of Followers</th>
                            <th>No. of Public Repo</th>
                            <th>Average no. of followers per public repo</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php

                                if(count($rs) == 30){
                                  $x=0;
                                  foreach($rs as $d){
                                  $x++;
                                ?>
                                <tr>
                                    <td>{{ empty($d['name']) ? '-' : $d['name'] }}</td>
                                    <td>{{ empty($d['login']) ? '-' : $d['login'] }}</td>
                                    <td>{{ empty($d['company'])? '-' : $d['company'] }}</td>
                                    <td>{{ empty($d['followers'])? '-' : $d['followers'] }}</td>
                                    <td>{{ empty($d['public_repos'])? '-' : $d['public_repos'] }}</td>
                                    <td>
                                        <?php
                                    $fol = (int) empty($d['followers'])? 0 : $d['followers'];
                                    $pubr = (int) empty($d['public_repos'])? 0 : $d['public_repos'];
                                    if($fol == 0 || $pubr == 0){
                                        echo 0;
                                    }else{
                                    echo ($fol/$pubr);
                                    }
                                        ?>
                                    </td>
                                  </tr>

                             <?php
                                    if($x == 10){
                                        break;
                                    }
                                   }

                                } else {
                                ?>

                                <tr>
                                    <td>{{ empty($rs['name']) ? '-' : $rs['name'] }}</td>
                                    <td>{{ empty($rs['login']) ? '-' : $rs['login'] }}</td>
                                    <td>{{ empty($rs['company'])? '-' : $rs['company'] }}</td>
                                    <td>{{ empty($rs['followers'])? '-' : $rs['followers'] }}</td>
                                    <td>{{ empty($rs['public_repos'])? '-' : $rs['public_repos'] }}</td>
                                    <td>
                                        <?php
                                    $fol = (int) empty($rs['followers'])? 0 : $rs['followers'];
                                    $pubr = (int) empty($rs['public_repos'])? 0 : $rs['public_repos'];
                                    if($fol == 0 || $pubr == 0){
                                        echo 0;
                                    }else{
                                    echo ($fol/$pubr);
                                    }
                                        ?>
                                    </td>
                                  </tr>

                               <?php
                                }

                             ?>
                        </tbody>
                    </table>

                     <?php
                     } ?>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
