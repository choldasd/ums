@extends('layouts.adminlist')
@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User List</div>

                <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="" autocomplete="off" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="" autocomplete="off" >
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="search">&nbsp;</label>
                        <button type="text" class="form-control btn btn-primary" id="search" name="search"  value=""  >Search</button>
                    </div>
                    <div class="col-md-2">
                        <label for="clear">&nbsp;</label>
                        <button type="text" class="form-control btn btn-danger" id="clear" name="clear"  value=""  >Clear</button>
                    </div>
                </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success" role="alert" id="list-msg" style="display:none;"></div>
                            <div class="alert alert-danger" role="alert" id="list-err-msg" style="display:none;"></div>
                            
                            <div class="col-4 offset-md-8 text-right">
                                <a href="javascript:void(0)" class="btn btn-primary add" >New User</a>
                            </div><br>
                            
                            <table class="table" id="userTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- col-md-8 -->

        <!-- Start Show User-->
        <div class="modal fade" id="ajax-show-crud-modal" tabindex="-1" aria-labelledby="userShowModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userShowModal"></h5>     
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <tbody>
                                        <tr><th scope="row">ID</th><td id="shid"></td></tr>
                                        <tr><th scope="row">Name</th><td id="shname"></td></tr>
                                        <tr><th scope="row">Email</th><td id="shemail"></td></tr>
                                        <tr><th scope="row">Status</th><td id="shstatus"></td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="" class="btn btn-secondary mclose" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Show User-->

        <!-- Add User-->
        <div class="modal fade" id="ajax-add-crud-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="userAddModalTitle"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" role="alert" id="addUserError" style="display:none;"></div>
                        <form id="addUserForm" name="addUserForm" class="form-horizontal" method="post">
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-12">
                                    <input type="text" id="name" class="form-control" name="name" value="" required autofocus>
                                    <span id="nameError" class="alert-message" style="color:red;"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="email">Email</label>
                                <div class="col-sm-12">
                                    <input type="email" id="email" class="form-control" name="email" value="" required>
                                    <span id="emailError" class="alert-message" style="color:red;"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="password">Password</label>
                                <div class="col-sm-12">
                                    <input type="password" id="password" class="form-control" name="password" required >
                                    <span id="passwordError" class="alert-message" style="color:red;"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-6 control-label" for="password_confirmation">Confirm Password</label>
                                <div class="col-sm-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required >
                                    <span id="password_confirmationError" class="alert-message" style="color:red;"></span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn-save" value="create">Save</button>
                        <button type="button" class="btn btn-info" id="btn-clear" value="clear">Clear</button>
                        <button type="button" class="btn btn-secondary mclose" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Router-->

        <!-- Edit User-->
        <div class="modal fade" id="ajax-edit-crud-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="userEditModalTitle"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" role="alert" id="editUserError" style="display:none;"></div>
                        <form id="editUserForm" name="editUserForm" class="form-horizontal" method="post">
                            <input type="hidden" name="user_id" id="user_id" value="">
                            @method('PUT')
                            <div class="form-group">
                                <label for="edname" class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-12">
                                    <input type="text" id="edname" class="form-control" name="name" value="" required autofocus>
                                    <span id="ednameError" class="alert-message" style="color:red;"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="edemail">Email</label>
                                <div class="col-sm-12">
                                    <input type="email" id="edemail" class="form-control" name="email" value="" required>
                                    <span id="edemailError" class="alert-message" style="color:red;"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status" class="col-sm-3 control-label">Status</label>
                                <div class="col-sm-12">
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="A">Active</option>
                                        <option value="D">Disable</option>
                                    </select>
                                    <span id="statusError" class="alert-message" style="color:red;"></span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="edpassword">Password</label>
                                <div class="col-sm-12">
                                    <input type="password" id="edpassword" class="form-control" name="password" >
                                    <span id="edpasswordError" class="alert-message" style="color:red;"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-6 control-label" for="password_confirmation">Confirm Password</label>
                                <div class="col-sm-12">
                                    <input id="edpassword-confirm" type="password" class="form-control" name="password_confirmation" >
                                    <span id="edpassword_confirmationError" class="alert-message" style="color:red;"></span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn-update" value="update">Update</button>
                        <button type="button" class="btn btn-secondary mclose" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit Router-->

    </div>
</div>
<script>
    
    function load_data(){
        var name = $("#name").val();
        var email = $("#email").val();
        var table = $('#userTable').DataTable({
            processing: true,
            serverSide: true,
            ajax:{ 
                url:"{{ route('users.index') }}",
                data:{name:name, email:email}
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    }

    //Load Listing
    load_data();

    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $("#search").click(function(){
            $('#userTable').DataTable().destroy();
            load_data();
        });

        $("#clear").click(function(){
            $('#name').val('');
            $('#email').val('');
            $('#userTable').DataTable().destroy();
            load_data();
        });

        $("#userTable").on("click", ".show", function(event) {            
            event.preventDefault();
            $('#userShowModal').html("User Details");
            var action = $(this).attr('action');
            
            $.ajax({
                type : 'GET',
                url  : action,
                aysnc:true,
                success:function(resp){
                    if(resp.data != ""){
                        var data = resp.data;
                        var status = 'Active';

                        $('#shid').html(data.id);
                        $('#shname').html(data.name);
                        $('#shemail').html(data.email);
                        if(data.status === 'D'){ status = 'Disable'; }
                        $('#shstatus').html(status);
                        
                        $('#ajax-show-crud-modal').modal({
                            backdrop: 'static',
                            keyboard: false
                        });
                        
                    }
                }
            });
        });

        $("#userTable").on("click", ".edit", function(event) {            
            event.preventDefault();
            $(".alert-message").html("");
            $('#userEditModalTitle').html("Edit User");
            var action = $(this).attr('action');
            
            $.ajax({
                type : 'GET',
                url  : action,
                aysnc:true,
                success:function(resp){
                    if(resp.data != ""){
                        var data = resp.data;
                        $("#user_id").val(data.id);
                        $('#edname').val(data.name);
                        $('#edemail').val(data.email);
                        $('#status option:selected', '#ajax-edit-crud-modal').removeAttr('selected');
                        $('#status').find('option[value="'+data.status+'"]').attr('selected','selected');
                        $('#btn-update').html('Update');

                        //Open modal
                        $('#ajax-edit-crud-modal').modal({
                            backdrop: 'static',
                            keyboard: false
                        });
                        
                    }
                }
            });
        });

        $("#btn-update").click(function(){
            if ($("#editUserForm").length > 0) {
                var user_id = $("#user_id").val();
                if(user_id > 0 && user_id != ''){
                    
                    $.ajax({
                        data: $('#editUserForm').serialize(),
                        url: "users/"+user_id,
                        type: "POST",
                        dataType: 'json',
                        beforeSend: function() {
                            $('#btn-update').html('Updating..');
                            $("#editUserError").html('').hide();
                            $('#list-err-msg').html('').hide();
                        },
                        success: function (resp) {
                            var data = resp.data;
                            
                            if(resp.status === true){
                                $('#btn-update').html('Updated');
                                $('#editUserForm').trigger("reset");
                                $('#ajax-edit-crud-modal').modal('hide');
                                $('#list-msg').show().html(resp.message);

                                $('#userTable').DataTable().destroy();
                                load_data();
                            }else{
                                $("#editUserError").show().html(resp.message);
                                $('#btn-update').html('Update');
                            }
                        
                        },
                        error: function (data) {
                            console.log('Error:', data);
                            $('#btn-update').html('Update');
                            $(".alert-message").html("");
                            $('#list-msg').html("").hide();
                            $('#ednameError').text(data.responseJSON.errors.name);
                            $('#edemailError').text(data.responseJSON.errors.email);
                            $('#edpasswordError').text(data.responseJSON.errors.password);
                            $('#edpassword_confirmationError').text(data.responseJSON.errors.password_confirmation);
                        }
                    });
                }
            }
        });

        $(".add").click(function(){
            //clear validation mesage and form field
            $('#addUserForm').trigger("reset");
            $(".alert-message").html("");

            $('#userAddModalTitle').html("Add New User");
            $('#ajax-add-crud-modal').modal({
                backdrop: 'static',
                keyboard: false
            });
        });

        
        $("#btn-save").click(function(){
            if ($("#addUserForm").length > 0) {
                $.ajax({
                    data: $('#addUserForm').serialize(),
                    url: "{{ route('users.store') }}",
                    type: "POST",
                    dataType: 'json',
                    beforeSend: function() {
                        $('#btn-save').html('Saving..');
                        $("#addUserError").html('').hide();
                        $('#list-err-msg').html('').hide();
                    },
                    success: function (resp) {
                        var data = resp.data;
                        
                        if(resp.status === true){
                            $('#btn-save').html('Saved');
                            $('#addUserForm').trigger("reset");
                            $('#ajax-add-crud-modal').modal('hide');
                            $('#list-msg').show().html(resp.message);

                            $('#userTable').DataTable().destroy();
                            load_data();
                        }else{
                            $("#addUserError").show().html(resp.message);
                        }
                    
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#btn-save').html('Save');
                        $(".alert-message").html("");
                        $('#list-msg').html("").hide();
                        $('#nameError').text(data.responseJSON.errors.name);
                        $('#emailError').text(data.responseJSON.errors.email);
                        $('#passwordError').text(data.responseJSON.errors.password);
                        $('#password_confirmationError').text(data.responseJSON.errors.password_confirmation);
                    }
                });
            }
        });

        $("#userTable").on("click", ".delete", function(event) {
            var dc = confirm("Are you sure? You want to delete user?");
            if (dc == true) {
                var daction = $(this).attr("action");
                $.ajax({
                    url: daction,
                    type: 'DELETE',
                    dataType: 'json',
                    beforeSend: function() {
                        $('#list-msg').html('').hide();
                        $('#list-err-msg').html('').hide();
                    },
                    success: function (resp){
                        if(resp != ''){
                            if(resp.status === true){
                                $('#list-msg').show().html(resp.message);
                                $('#userTable').DataTable().destroy();
                                load_data();
                            }else{
                                $('#list-err-msg').show().html(resp.message);
                            }
                        }
                    },
                    error: function(resp){
                        $('#list-err-msg').html('').hide();
                        $('#list-msg').html('').hide();
                    }
                });
            }
        });
        
        //close modal
        $(".mclose").click(function(){
            $(this).closest('.modal').modal('hide');
        });

        //clear form
        $("#btn-clear").click(function(){
            $('#addUserForm')[0].reset();
        });
        
    });
</script>
@endsection
