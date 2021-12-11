@extends('adminlte::page')

@section('title', 'NEGO | E-com')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
    
@stop

@section('content')

    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-body bg-primary">
                    <h3 class="h3">{{ $customer_count }}</h3>
                    <p>Clients in your store </p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body bg-info">
                    <h3 class="h3">Ksh. {{ $average_purchase_price }} </h3>
                    <p>Average spent in Product Purchase </p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body bg-success">
                    <h3 class="h3">Ksh. {{ $average_income }}</h3>
                    <p>Average Sales Income</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row pt-5 pb-3">
        
        <div class="col-12 col-sm-12 col-md-5">
            <div class="card">
                <div class="card-body pt-3">
                    <h3 class="h3">Store Status</h3>

                    <div class="row pt-5 bg-success">
                        <div class="col-12 col-md-12 col-lg-12 col-sm-12 pt-2 pb-2">
                            <h4 class="text-white"><span><i class="fa fa-chevron-circle-up" aria-hidden="true"></i>
                        </span> Running</h4>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <p class="text-mute">Last Downtime</p>
                            <p class="">Never</p>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <p class="text-mute">Response Time</p>
                            <p class="">00:00:00</p>
                        </div>
                    </div>

                    <div class="row pt-4 bg-light">
                        <div class="col-12 col-sm-12 col-md-12 pt-2 pb-2">
                            <h4>Engineer On Call</h4>
                            <p>Irungu Edwin</p>
                        </div>
                    </div>
                    
                    <div class="row pt-4">
                        <div class="col-12 col-sm-12 col-md-12">
                            <h4>Contact Information</h4>
                            <p><span><i class="fa fa-phone" aria-hidden="true"></i>
                                </span> +25479940111</p>
                            <p><span><i class="fa fa-envelope" aria-hidden="true"></i>
                                </span> edwin.irungu.8042@gmail.com</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-7">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="mb-3 btn btn-block btn-info" data-toggle="modal" data-target="#addTask">Add Task + </button>

                    <h4 class="pb-3 h4">Task List</h4>


                    <table class="table table-responsive">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Task</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col">Deadline</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col">Urgency</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col">Actions</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3">This is a sample task</td>
                                <td colspan="3">12/12/2021</td>
                                <td colspan="3"><p class="btn btn-solid btn-warning">Semi Urgent</p></td>
                                <td colspan="3"><p class="btn btn-solid btn-primary">In Progress</p></td>
                                <td colspan="3">
                                    <div class="row">
                                        <div class="col-6">
                                            <button class="btn btn-solid btn-info"><i class="fa fa-eye" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-solid btn-danger"><i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>



    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">More Stuff Coming Soon</p>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="addTask" tabindex="-1" role="dialog" aria-labelledby="addTask" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Task Card</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form>
             <div class="form-group row">
                 <label for="task">Task</label>
                 <input type="text" name="task" class="form-control">
             </div>
             <div class="form-group row">
                 <label for="deadline">Deadline</label>
                 <input type="date" name="deadline" class="form-control">
             </div>
             <div class="form-group row">
                  <div class="col-12 col-sm-12 col-md-6">
                      <label for="urgency">Urgency</label>
                      <select class="form-control" name="urgency">
                          <option value="1">Very Urgent</option>
                          <option value="2">Urgent</option>
                          <option value="3">Important</option>
                          <option value="4">Not Urgent</option>
                      </select>
                  </div>
                  <div class="col-12 col-sm-12 col-md-6">
                      <label for="status">Task Status</label>
                      <select class="form-control" name="status">
                          <option value="0">Scheduled</option>
                          <option value="1">In Progress</option>
                          <option value="2">Completed</option>
                      </select>
                  </div>
             </div>
             <div class="form-group row p-3">
                 <div class="col-12 text-center">
                     <input type="submit" name="submit" class="btn btn-block btn-info" value="Create Task">
                 </div>
             </div>

         </form>
      </div>
    </div>
  </div>
</div>



@stop
