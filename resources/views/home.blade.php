@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->

    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <small>Welcome back!  {{ Auth::user()->name }} </small>
                    <h1 class="m-0 text-dark"> Your TodoList <span class="right text-sm badge badge-primary">0</span></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Striped Full Width Table</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm">
                                    <button type="submit" class="btn btn-success btn-sm btn-cricle" data-toggle="modal"
                                        data-target="#add-todo-modal"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">Status</th>
                                        <th style="width: 40%">Date</th>
                                        <th style="width: 50%">Task</th>
                                        <th style="width: 5%">Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                            </div>
                                        </td>
                                        <td>Aug 30, 2020</td>
                                        <td>Update software</td>
                                        <td>
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-outline-primary btn-sm">
                                                    <input type="radio" name="options" id="option1" autocomplete="off"> <i
                                                        class="fas fa-pen"></i>
                                                </label>
                                                <label class="btn btn-outline-danger btn-sm">
                                                    <input type="radio" name="options" id="option2" autocomplete="off">
                                                    <i class="fas fa-times"></i>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </div>

    <div class="modal fade" id="add-todo-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Todo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="todo-date">Date</label>
                            <input type="date" class="form-control" id="todo-date" placeholder="Date">
                        </div>
                        <div class="form-group">
                            <label for="todo-task">Task</label>
                            <input type="text" class="form-control" id="todo-task" placeholder="Task">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save Todo</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection
