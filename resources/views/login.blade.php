@extends('layouts.app')

@section('content_login')
<section class="page-section mb-0" id="form-login">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="shape">
                    <h2>Masuk</h2>
                    <div class="line-border"></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-10 col-lg-8">
                                <form action="" method="POST" id="FormLogin">
                                    <div class="form-group">
                                        <label for="exampleInputUsernameEmail">Username/Email</label>
                                        <input type="text" class="form-control" id="exampleInputUsernameEmail" aria-describedby="username">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div id="message-error" class="mb-4 message-error"></div>
                                    <div class="form-group mb-2 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Ingat Saya</label>
                                    </div>
                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn-submit btn btn-primary">Masuk</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection