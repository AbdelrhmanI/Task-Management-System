 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Custom Authentication</title>
     <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
 </head>
 <body>
     <div class="container">
         <div class="row">
             <div class="col-md-4" style="margin-top: 20px">
                 <h4>Dashboard</h4>
                 <hr>
                 <table>
                     <thead>
                         <th>Name</th>
                         <th>Email</th>
                         <th>Action</th>
                     </thead>
                     <tbody>
                         <tr>
                             <td>{{$data->name}}</td>
                             <td>{{$data->email}}</td>
                             <td><a href="logout">Logout</a></td>
                         </tr>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
     <!-- Second table -->
     <div class="container">
         <div class="row">
             <div class="col-md-4 second-table" style="margin-top: 20px">
                 <h4>Tasks</h4>
                 <hr>
                 <table>
                     <thead>
                         <th>Name</th>
                         <th>Description</th>
                         <th>Status</th>
                         <th>Action</th>
                     </thead>
                     <tbody>
                         @foreach($tasks as $task)
                         <tr>
                             <td>{{$task->name}}</td>
                             <td>{{$task->description}}</td>
                             <td>{{$task->status ? 'Completed' : 'Incomplete'}}</td>
                             <td>
                                 <a href="{{route('task-edit',['task'=>$task])}}">Edit</a>
                                 <form action="{{ route('delete-task', ['task' => $task->id]) }}" method="post" style="display: inline;">
                                     @csrf
                                     @method('DELETE')
                                     <button type="submit" class="delete-btn">Delete</button>
                                 </form>
                             </td>
                         </tr>
                         @endforeach
                     </tbody>
                 </table>
                 <button onclick="window.location.href='{{ route('create') }}'" class="create-task-btn">Create New Task</button>
             </div>
         </div>
     </div>
 </body>
 </html>
 