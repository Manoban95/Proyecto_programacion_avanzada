  @php
      use Carbon\Carbon;
  @endphp
<x-app-layout>
    <x-slot name="header">
      <div class="row">
        <div class="col-md-8 col-12">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Préstamos') }}
            </h2>
        </div>
        <div class="col-md-4 col-12">
        </div>
      </div>     
    </x-slot>   

    	@if (isset($loans) && count($loans)>0)

		    		<div class="py-12">
		          
		                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
		                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
		                          <table class="table table-striped table-bordered">
		                      <thead class="thead-dark">
		                        <tr>
		                          <th scope="col">Usuario</th>
		                          <th scope="col">Libro</th>
		                          <th scope="col">Fecha de préstamo</th>
		                          <th scope="col">Fecha de devolución </th>
		                          <th scope="col">Estado </th>

		                        </tr>
		                      </thead>
		                      <tbody>

		                        
		                        @foreach($loans as $loan)
    	   							@if($loan->book_id==$book->id)
		                              <tr class="loan_Table" >
		                              		<td>
		                              		@foreach($users as $user)
		                              			@if($user->id==$loan->user_id)
			                                 	 {{ $user->name }}
			                                  	@endif
			                                @endforeach
			                                </td>
		                              	@foreach($books as $bok)
		                              	  @if($bok->id==$loan->book_id)
			                                <td>
			                                  {{ $book->title }}
			                                </td>
			                              @endif
		                                @endforeach
			                              <td>
			                             	{{ $loan->loan_date }}
			                              </td>
			                              <td>
			                              	{{ $loan->return_date }}
			                              </td>
			                              <td>
			                              	@if($loan->status==1)
			                              		<span>En posesión</span>
			                              	@else
			                              		<span>Devuelto</span>
			                              	@endif
			                              </td>
		                              </tr>
		                            @endif
		                        @endforeach
		                      </tbody>
		                    </table>

		                        </div>
		                    </div>
		            </div>
        @endif

    

    

    <script type="text/javascript">

    	
       
    </script>


</x-app-layout>