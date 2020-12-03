<x-app-layout>
    <x-slot name="header">
      <div class="row">
        <div class="col-md-8 col-12">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Usuarios') }}
            </h2>
        </div>
        <div class="col-md-4 col-12">
          <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addUserModal">
            Añadir usuario
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
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
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
                @if($user->role_id == 2)
                      Usuario
                 @endif
                 @if($user->role_id == 1)
                      Admin
                 @endif 
     
               </td>
                <td>
                 
                <button   onclick="editUser({{  $user->id }},'{{  $user->name }}','{{ $user->email }}','{{  $user->role_id }}', this)" class="btn btn-warning" data-toggle="modal" data-target="#editUserModal">
                  Nombre/Email/Rol
                </button>

               </td>
                <td>
                 <button onclick="removeUser({{  $user->id }}, this)" class="btn btn-danger">
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

    <div>
               <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Crear usuario nuevo</h5>
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
                                        <input type="text" required class="form-control" placeholder="User Name" id="name_input" name="name" aria-label="User Name" aria-describedby="basic-addon1">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">E-Mail</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">@</span>
                                        </div>
                                        <input type="email" required class="form-control" name="email" id="email_input" placeholder="E-Mail">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">@</span>
                                        </div>
                                        <input type="password" required class="form-control" name="password" id="password_input" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Rol</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">@</span>
                                        </div>
                                          <select class="custom-select" name="role_id" id="role_id_input">
                                                <option value="{{1}}">Admin</option>
                                                <option value="{{2}}">Usuario</option>
                                          </select>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Crear</button>
                            </div>
                        </form>
                    </div>
                  </div>
               </div>

               <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="addBook" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Edit new User</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <form method="POST" action="{{ url('user') }}" enctype="multipart/form-data">
                              @csrf
                              @method('PUT')
                              <div class="modal-body">
                                  
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Name</label>
                                      <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                            <label class="input-group-text" for="arole_id">@</label>
                                          </div>
                                          <input type="text" id="name" name="name" class="form-control" placeholder="Robert James" aria-label="Name" aria-describedby="basic-addon1">
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Email</label>
                                      <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                            <label class="input-group-text" for="arole_id">@</label>
                                          </div>
                                          <input type="email" id="email" name="email" class="form-control" placeholder="ejemplo@dominio.com" aria-label="Email" aria-describedby="basic-addon1">
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Role</label>
                                      <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                              <label class="input-group-text" for="arole_id">@</label>
                                          </div>
                                          <select class="custom-select" name="role_id" id="role_id">
                                              <option value="1">Administrator</option>
                                              <option value="2">Client</option>
                                          </select>
                                      </div>
                                  </div>

                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                                  <input type="hidden" id="id" name="id" value="">
                                  <button type="submit" class="btn btn-primary">Save</button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>

              

      </div>  

    



<script type="text/javascript">
         
      function editUser(id, name, email, role_id){
            $('#id').val(id);
            $('#name').val(name);
            $('#email').val(email);
            $('#role_id').val(role_id);
        }
    
 
   function removeUser(id,target){
           
         swal({
          title: "¿Está seguro que quiere eliminar el usuario?",
          text: "Una vez eliminada no se podrá recuperar",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            axios.delete('{{ url('user') }}/'+id, {
              id: id,
              _token: '{{ url( csrf_token() ) }}'
            })
            .then(function (response) {
                    if (response.data.code == 200) {
                        swal( response.data.message, {
                          icon: "success",
                        });
                        $(target).parent().parent().remove();
                    } else {
                        swal( response.data.message, {
                          icon: "error",
                        });
                    }
                  })
                  .catch(function (error) {
                });
              }
            });
        
        }



</script>





  </x-app-layout>




