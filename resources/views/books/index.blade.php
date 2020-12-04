  @php
      use Carbon\Carbon;
  @endphp
<x-app-layout>
    <x-slot name="header">
      <div class="row">
        <div class="col-md-8 col-12">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Books') }}
            </h2>
        </div>
        <div class="col-md-4 col-12">
          @php
          $user = auth()->user();
          @endphp
           @if (Auth::user()->hasPermissionTo('add books')) 
                   <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addBookModal">
                    Add Book
                  </button>       


           @endif
          
        </div>
      </div>     
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                
        @if (isset($categories) && count($categories)>0)
        @foreach ($categories as $category)
            <table class="table table-striped table-bordered">
              <h3> {{ $category->name }} </h3>
              
              <div class="card-deck">
                @foreach($books as $book)
                  @if (isset($books) && count($books)>0 && ($book->Category_id == $category->id))
                  <div class="card" style="max-width: 20%; min-width: 20%; margin-bottom: 50px; margin-left: 3.3%;">
                                  <img class="card-img-top" src="{{url('carrucel1.jpg')}}" alt="Card image cap">
                                  <div class="card-body">
                                    <h5 class="card-title">{{ $book->title }}</h5>
                                    <p class="card-text">{{ $book->description }}</p>
                                    <div style="display: inline-block; list-style: none">

                                        <li style="margin-bottom: 5px;">
                                            <button onclick="requestBook({{  $book->id }},{{  $user->id }},'{{ Carbon::now()->timezone('America/Hermosillo')}}', this)" class="btn btn-success"  >
                                              <span>Solicitar</span>
                                            </button>
                                        </li>
                                        @if(Auth::user()->hasPermissionTo('update books'))
                                        <li style="margin-bottom: 5px;"> 
                                          <button   onclick="editBook({{  $book->id }}, '{{  $book->title }}', '{{  $book->description }}', {{  $book->year }}, {{  $book->pages }}, '{{  $book->isbn }}', '{{  $book->editorial }}', {{  $book->edition }}, '{{  $book->autor }}', {{  $book->Category_id }}, this)" class="btn btn-warning" data-toggle="modal" data-target="#editBookModal">
                                              <span>Edit book</span>
                                            </button>
                                          </li>
                                          <button style="margin-bottom: 5px;" onclick="removeBook({{  $book->id }}, this)" class="btn btn-danger">
                                                <span>Remove</span>
                                            </button>
                                        <li>
                                          <a href="{{url('/books/'.$book->id)}}" >
                                              <button class="btn btn-primary float-right">
                                                 <span>Registro</span>
                                              </button>
                                          </a>
                                        </li>
                                          @endif
                                    </div>
                                  </div>
                  </div>
                  @endif
                @endforeach
              </div>
          </table>
        @endforeach
        @endif

        {{-- @if (isset($categories) && count($categories)>0)
        @foreach ($categories as $category)
            <table class="table table-striped table-bordered">
              <h3> {{ $category->name }} </h3>
              
              <div class="card-deck">
                @foreach($books as $book)
                  @if (isset($books) && count($books)>0 && ($book->Category_id == $category->id))
                    @if (isset($loans) && count($loans)>0)
                      @php
                      $boolean = 0;
                      @endphp
                        @foreach($loans as $loan)
                          @if($loan->book_id==$book->id)
                              
                            @if($loan->status==0 && $boolean==0)
                              @php
                              $boolean = 1;
                              @endphp
                               <div class="card" style="max-width: 20%; min-width: 20%; margin-bottom: 50px; margin-left: 3.3%;">
                                  <img class="card-img-top" src="{{url('carrucel1.jpg')}}" alt="Card image cap">
                                  <div class="card-body">
                                    <h5 class="card-title">{{ $book->title }}</h5>
                                    <p class="card-text">{{ $book->description }}</p>
                                    <div style="display: inline-block; list-style: none">

                                        <li style="margin-bottom: 5px;">
                                            <button onclick="requestBook({{  $book->id }},{{  $user->id }},'{{ Carbon::now()->timezone('America/Hermosillo')}}', this)" class="btn btn-success"  >
                                              Solicitar
                                            </button>
                                        </li>
                                        @if(Auth::user()->hasPermissionTo('update books'))
                                        <li style="margin-bottom: 5px;"> 
                                          <button   onclick="editBook({{  $book->id }}, '{{  $book->title }}', '{{  $book->description }}', {{  $book->year }}, {{  $book->pages }}, '{{  $book->isbn }}', '{{  $book->editorial }}', {{  $book->edition }}, '{{  $book->autor }}', {{  $book->Category_id }}, this)" class="btn btn-warning" data-toggle="modal" data-target="#editBookModal">
                                              Edit book
                                            </button>
                                          </li>
                                        <li>
                                          <button onclick="removeBook({{  $book->id }}, this)" class="btn btn-danger">
                                                Remove
                                            </button>
                                        </li>
                                          @endif
                                    </div>
                                  </div>
                               </div>
                                 
                            @endif
                            @endif
                        @endforeach
                          @if($boolean==0)
                               <div class="card" style="max-width: 20%; min-width: 20%; margin-bottom: 50px; margin-left: 3.3%;">
                                  <img class="card-img-top" src="{{url('carrucel1.jpg')}}" alt="Card image cap">
                                  <div class="card-body">
                                    <h5 class="card-title">{{ $book->title }}</h5>
                                    <p class="card-text">{{ $book->description }}</p>
                                    <div style="display: inline-block; list-style: none">

                                        <li style="margin-bottom: 5px;">
                                            <button onclick="requestBook({{  $book->id }},{{  $user->id }},'{{ Carbon::now()->timezone('America/Hermosillo')}}', this)" class="btn btn-success"  >
                                              Solicitar
                                            </button>
                                        </li>
                                        @if(Auth::user()->hasPermissionTo('update books'))
                                        <li style="margin-bottom: 5px;"> 
                                          <button   onclick="editBook({{  $book->id }}, '{{  $book->title }}', '{{  $book->description }}', {{  $book->year }}, {{  $book->pages }}, '{{  $book->isbn }}', '{{  $book->editorial }}', {{  $book->edition }}, '{{  $book->autor }}', {{  $book->Category_id }}, this)" class="btn btn-warning" data-toggle="modal" data-target="#editBookModal">
                                              Edit book
                                            </button>
                                          </li>
                                        <li>
                                          <button onclick="removeBook({{  $book->id }}, this)" class="btn btn-danger">
                                                Remove
                                            </button>
                                        </li>
                                          @endif
                                    </div>
                                  </div>
                               </div>
                          @endif
                    @else
                       <div class="card" style="max-width: 20%; min-width: 20%; margin-bottom: 50px; margin-left: 3.3%;">
                          <img class="card-img-top" src="{{url('carrucel1.jpg')}}" alt="Card image cap">
                          <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">{{ $book->description }}</p>
                            <div style="display: inline-block; list-style: none">

                                <li style="margin-bottom: 5px;">
                                    <button onclick="requestBook({{  $book->id }},{{  $user->id }},'{{ Carbon::now()->timezone('America/Hermosillo')}}', this)" class="btn btn-success"  >
                                      Solicitar
                                    </button>
                                </li>
                                @if(Auth::user()->hasPermissionTo('update books'))
                                <li style="margin-bottom: 5px;"> 
                                  <button   onclick="editBook({{  $book->id }}, '{{  $book->title }}', '{{  $book->description }}', {{  $book->year }}, {{  $book->pages }}, '{{  $book->isbn }}', '{{  $book->editorial }}', {{  $book->edition }}, '{{  $book->autor }}', {{  $book->Category_id }}, this)" class="btn btn-warning" data-toggle="modal" data-target="#editBookModal">
                                      Edit book
                                    </button>
                                  </li>
                                <li>
                                  <button onclick="removeBook({{  $book->id }}, this)" class="btn btn-danger">
                                        Remove
                                    </button>
                                </li>
                                  @endif
                            </div>
                          </div>
                       </div>
                    @endif
                  @endif
               @endforeach
              </div>
            </table>
        @endforeach
        @endif --}}


  

            </div>
        </div>
    </div>

    <div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add new Book</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" action="{{ url('books')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-body">
                      <div class="form-group">
                          <label for="exampleInputEmail1">Title</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="text" name="title" class="form-control" placeholder="Title" aria-label="Title" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book title.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Description</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <textarea class="form-control" id="input_description" name="description" aria-label="With textarea"></textarea>
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book title.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Year</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="number" id="input_year" name="year" class="form-control" placeholder="year" aria-label="year" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="bookYear" class="form-text text-muted">Book year.</small>
                        </div>
                        
                        <div class="form-group">
                          <label for="exampleInputEmail1">Pages</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="number" id="input_pages" name="pages" class="form-control" placeholder="Pages" aria-label="Pages" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book pages.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">ISBN</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="text" name="isbn" id="input_isbn" class="form-control" placeholder="ISBN" aria-label="ISBN" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book ISBN.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Editorial</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="text" id="input_editorial" name="editorial" class="form-control" placeholder="Editorial" aria-label="Editorial" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book Editorial.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Edition</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="number" id="input_edition" name="edition" class="form-control" placeholder="Edition" aria-label="Edition" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book Edition.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Autor</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="text" id="input_autor" name="autor" class="form-control" placeholder="Autor" aria-label="Autor" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book Autor.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Cover</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="file" id="input_cover" id="input_cover" name="cover" class="form-control" name="cover">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book Cover Image.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Category</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <select class="form-control" id="category_id" name="category_id">
                                @if (isset($categories) && count($categories)>0)
                                @foreach ($categories as $category)

                                <option value="{{ $category->id }}"> {{ $category->name }}</option>

                                @endforeach
                                @endif
                              </select>
                            </div>                          
                        </div>
                  </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
          
        </div>
      </div>
    </div>

    <div class="modal fade" id="editBookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit book</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form method="POST" action="{{ url('books')}}" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="modal-body">
                      <div class="form-group">
                          <label for="exampleInputEmail1">Title</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="text" id="title" name="title" class="form-control" placeholder="Title" aria-label="Title" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book title.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Description</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <textarea class="form-control" id="description" name="description" aria-label="With textarea"></textarea>
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book title.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Year</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="number" id="year" name="year" class="form-control" placeholder="year" aria-label="year" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="bookYear" class="form-text text-muted">Book year.</small>
                        </div>
                        
                        <div class="form-group">
                          <label for="exampleInputEmail1">Pages</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="number" id="pages" name="pages" class="form-control" placeholder="Pages" aria-label="Pages" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book pages.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">ISBN</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="text" name="isbn" id="isbn" class="form-control" placeholder="ISBN" aria-label="ISBN" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book ISBN.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Editorial</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="text" id="editorial" name="editorial" class="form-control" placeholder="Editorial" aria-label="Editorial" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book Editorial.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Edition</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="number" id="edition" name="edition" class="form-control" placeholder="Edition" aria-label="Edition" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book Edition.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Autor</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="text" id="autor" name="autor" class="form-control" placeholder="Autor" aria-label="Autor" aria-describedby="basic-addon1">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book Autor.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Cover</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <input type="file" id="cover" name="cover" class="form-control" name="cover">
                            </div>                          
                          <small id="emailHelp" class="form-text text-muted">Book Cover Image.</small>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Category</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                              </div>
                              <select class="form-control" id="category" name="category_id">
                                @if (isset($categories) && count($categories)>0)
                                @foreach ($categories as $category)

                                <option value="{{ $category->id }}"> {{ $category->name }}</option>

                                @endforeach
                                @endif
                              </select>
                            </div>                          
                        </div>
                  </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary">Save</button>
                      <input type="hidden" name="id" id="id">
                    </div>
                </form>
          
        </div>
      </div>
    </div>

    <script type="text/javascript">
      function requestBook(idBook,idUser,title,target){

            swal({
           title :" ¿Está seguro que quiere solicitar este libro? ",
           text :title,
           icon :"warning",
            buttons : true,
            dangerMode: true,
            })
            .then((willDelete) =>{

              if(willDelete){
                axios.delete('{{  url('book') }}/'+id,{

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

      function editBook(id,title,description,year,pages,isbn,editorial,edition,autor,category_id){

            $("#id").val(id);
            $("#title").val(title);
            $("#description").val(description);
            $("#year").val(year);
            $("#pages").val(pages);
            $("#isbn").val(isbn);
            $("#editorial").val(editorial);
            $("#edition").val(edition);
            $("#autor").val(autor);
            $("#category").val(category_id);
            
        }

        function requestBook(book_id, user_id, loan_date, target) {
                swal({
                    title: "Are you sure?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: false,
                })
                .then((willDelete) => {
                  if (willDelete) {
                     console.log("willDelete");
                        axios.post('/loans', {
                            book_id: book_id,
                            user_id: user_id,
                            loan_date: loan_date,
                            status: 1
                        })
                    .then(function (response) {
                        if (response.data.code == 200) {
                          console.log("success");
                            swal( response.data.message, {
                              icon: "success",
                            });
                            $(target).parent().parent().parent().remove();
                        } else {
                          console.log("error");
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

            
         
      function removeBook(id,target){
            swal({
           title :" ¿Esta seguro?",
           text :" Se va a eliminar el libro de la base de datos ",
           icon :"warning",
            buttons : true,
            dangerMode: true,
            })
            .then((willDelete) =>{

              if(willDelete){ 
                axios.delete('{{  url('books') }}/'+id,{

                  id: id,
                  _token: '{{  csrf_token()  }}'
                })
                .then(function(response){
                  
                  if(response.data.code==200){
                    swal(response.data.message ,{
                       icon: "success"
                    });
                    $(target).parent().parent().parent().remove();
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