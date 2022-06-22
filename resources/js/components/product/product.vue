<template>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Products Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->


        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <!-- ################################ -->
                <div class="col-md-12">
                    <div class="card card-primary collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title">Create a new Product here</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="inputName">Arabic Name</label>
                                    <input type="text" id="inputName" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputName">English Name</label>
                                    <input type="text" id="inputName" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="inputName">Arabic Description</label>
                                    <textarea class="form-control" id="inputDescription" rows="3"></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputName">English Description</label>
                                    <textarea class="form-control" id="inputDescription" rows="3"></textarea>
                                </div>
                            </div>
                           <div class="row">
                             <div class="form-group  col-md-3">
                                <label for="inputStatus">Category</label>
                                <select id="inputStatus" class="form-control custom-select">
                                    <option disabled selected>Select Category</option>
                                    <option>On Hold</option>
                                    <option>Canceled</option>
                                    <option>Success</option>
                                </select>
                            </div>
                            <div class="form-group  col-md-3">
                                <label for="inputClientCompany">price</label>
                                <input type="text" id="inputClientCompany" class="form-control">
                            </div>
                            <div class="form-group  col-md-3">
                                <label for="inputProjectLeader">Calories</label>
                                <input type="text" id="inputProjectLeader" class="form-control">
                            </div>

                            <div class="form-group  col-md-3">
                                <label for="inputProjectLeader">Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile"></label>
                                </div>
                            </div>

                           </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                </div>

                <!-- ################################ -->


                <!-- **************************** -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Categories table</h3>

                        <div class="card-tools">
                            <ul class="pagination pagination-sm float-right">
                                <li class="page-item"><a class="page-link" href="#">«</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">»</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Category name</th>
                                    <th>Products</th>
                                    <th style="width: 40px">Label</th>
                                    <th style="width: 50px">Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>Update software</td>
                                    <td>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-danger">55%</span></td>
                                    <td><img class="direct-chat-img" src="dist/img/user3-128x128.jpg"
                                            alt="message user image" /></td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Clean database</td>
                                    <td>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-warning" style="width: 70%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-warning">70%</span></td>
                                    <td><img class="direct-chat-img" src="dist/img/user3-128x128.jpg"
                                            alt="message user image" /></td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>Cron job running</td>
                                    <td>
                                        <div class="progress progress-xs progress-striped active">
                                            <div class="progress-bar bg-primary" style="width: 30%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-primary">30%</span></td>
                                    <td><img class="direct-chat-img" src="dist/img/user3-128x128.jpg"
                                            alt="message user image" /></td>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <td>Fix and squish bugs</td>
                                    <td>
                                        <div class="progress progress-xs progress-striped active">
                                            <div class="progress-bar bg-success" style="width: 90%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-success">90%</span></td>
                                    <td><img class="direct-chat-img" src="dist/img/user3-128x128.jpg"
                                            alt="message user image" /></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

                <!-- **************************** -->




            </div>
        </div>
        <!-- /.content -->


    </div>

</template>
