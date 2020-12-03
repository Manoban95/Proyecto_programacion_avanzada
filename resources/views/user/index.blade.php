<x-app-layout>
    <x-slot name="header">
      <div class="row">
        <div class="col-md-8 col-12">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>
        </div>
        <div class="col-md-4 col-12">
          <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addUserModal">
            Add user
          </button>       
        </div>
      </div>     
    </x-slot>

         
        <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"> 
              <table class="table table-striped table-bordered">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Password</th>
              <th scope="col">Rol</th>
              <th scope="col">Update</th>
              <th scope="col">Remove</th>


            </tr>
          </thead>
          <tbody>

         
            @if (isset($users) && count($users)>0)
            @foreach($users as $user)
            
            @php
             $USER = auth()->user();
            @endphp
            @if($USER->id!=$user->id)

            <tr>
              <th scope="row">
                {{ $user->id }}
              </th>
              <td>
                {{ $user->name }}
              </td>
              <td>
                {{ $user->email }}
              </td>

              <td>
                {{ $user->password }}
              </td>

               <td>
                @if($user->role_id == 2)
                      usuario
                 @endif
                 @if($user->role_id == 1)
                      Admin
                 @endif 
     
               </td>
                <td>
                 
                <button   onclick="editUser({{  $user->id }},'{{  $user->name }}','{{ $user->email }}','{{  $user->password }}', this)" class="btn btn-warning" data-toggle="modal" data-target="#editUserModal">
                  Editar usuario
                </button>

               </td>
                <td>
                 <button onclick="removeUser({{  $user->id }})" class="btn btn-danger">
                   Remover
                 </button>
               </td>
             
            </tr>

            @endif
      
            
            @endforeach
            @endif
          </tbody>
        </table>

            </div>
        </div>
    </div> 

    

{{--  Modal para añadir usuario --}}
     <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <form onSubmit="return validatePassword()"method="POST" action="{{ url('user') }}">
                @csrf
                <div class="modal-body">   

                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" class="form-control" placeholder="User Name" id="input_name" name="name" aria-label="User Name" aria-describedby="basic-addon1">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">E-Mail</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" class="form-control" name="email" id="input_email" placeholder="E-Mail">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="password" class="form-control" name="password" id="password" placeholder="">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </div>
            </form>
        </div>
      </div>
    </div>
    </div>
  </div>


 {{--  fin del metodo add --}}
  {{--  inicio del metodo update --}}

    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit user</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form method="POST" action="{{ url('user') }}">
          @csrf
          @method('PUT')

           <div class="modal-body">
                                   <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" class="form-control" placeholder="User Name" id="name" name="name" aria-label="User Name" aria-describedby="basic-addon1">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">E-Mail</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" class="form-control" name="email" id="email" placeholder="E-Mail">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="password" class="form-control" name="password" id="password" placeholder="">
                        </div>
                    </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save category</button>
          <input type="hidden" name="id" id="id">

        </div>
        </form>
      </div>
    </div>
  </div>

{{--   fin del metodo update  --}}



<script type="text/javascript">
         
      function editUser(id,name,email,password){
       
            $("#id").val(id)
            $("#name").val(name)
            $("#email").val(email)
            $("#password").val(password)

                
        }
    
 
   


   function removeUser(id,target){
           
            swal({
           title :" are you sure ",
          text :" are you sure ",
           icon :"warning",
            buttons : true,
            dangerMode: true,
            })
            .then((willDelete) =>{

              if(willDelete){
                axios.delete('{{  url('user') }}/'+id,{

                  id: id,
                  _token: '{{  csrf_token()  }}'
                })
                .then(function(response){
                  
                  if(response.data.code==200){
                    swal(response.data.message ,{
                       icon: "sucess"
                    });
                    $(target).parent().parent().remove();
                  }
                })
                .catch(function (error){
                   
                   swal('Error ocurred');

                });
              }

            });
        }



</script>





  </x-app-layout>




