@extends('managecp.app')

@section('dashboard_content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Agen</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Agen</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="add_agen" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Data</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputFirstName">First Name</label>
                                <input type="text" name="inputFirstName" id="inputFirstName" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="inputLastName">Last Name</label>
                                <input type="text" name="inputLastName" id="inputLastName" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="inputUsername">Username</label>
                                <input type="text" name="inputUsername" id="inputUsername" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Email</label>
                                <input type="email" name="inputEmail" id="inputEmail" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword">Password</label>
                                <input type="password" name="inputPassword" id="inputPassword" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="inputPasswordConfirmation">Confirm Password</label>
                                <input type="password" name="inputPasswordConfirmation" id="inputPasswordConfirmation" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="inputNoHP">No. HP</label>
                                <input type="number" name="inputNoHP" id="inputNoHP" class="form-control" required>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <a href="{{route('agenlist')}}" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Submit" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection