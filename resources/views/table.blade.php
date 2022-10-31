<!DOCTYPE html>
<html>

    <head>
        <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
        <style>
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }
        
        td, th {
          border: 1px solid #dddddd;
          text-align: left;
          padding: 8px;
        }
        
        tr:nth-child(even) {
          background-color: #dddddd;
        }
        </style>
        </head>


    <body>
        <form action="/addnewpointpackages" method="POST" role="form text-left" enctype="multipart/form-data">
        <input class="form-control"  type="text" placeholder="Search" id="user-name" name="search">
       
            <button type="submit" >{{ 'Search' }}</button>
        
        </form>
<table>
<tr>
 
    <th>
        id
    </th>
  
    <th>
        name
    </th>
   
    <th>
        slug
    </th>
    <th>
        
    </th>
    <th>
        
    </th>
    
</tr>

@for($i=0; $i < $result->count();$i++)
<tr>
    <td>
        {{$result[$i]->id}}
    </td>
     <td>
        {{$result[$i]->name}}
     </td>
     <td>
        {{$result[$i]->slug}}
     </td>
     <td>
      
        <form action="/show" method="get" role="form text-left" enctype="multipart/form-data">
            <input class="form-control"  type="hidden" placeholder="Search" id="user-name" name="id" value="{{$result[$i]->id}}">
           
                <button type="submit" >{{ 'Show' }}</button>
            
            </form>
           
     </td>
     <td>
      
        <form action="/edit" method="get" role="form text-left" enctype="multipart/form-data">
            <input class="form-control"  type="hidden" placeholder="Search" id="user-name" name="id" value="{{$result[$i]->id}}">
           
                <button type="submit" >{{ 'edit' }}</button>
            
            </form>
           
     </td>
     <td>
      
        <form action="/delete" method="POST" role="form text-left" enctype="multipart/form-data">
            <input class="form-control"  type="hidden" placeholder="Search" id="user-name" name="id" value="{{$result[$i]->id}}">
           
            <button type="submit" >{{ 'delete' }}</button>
        
        </form>
       
 </td>
</tr>
<i class="fas fa-band-aid"></i>
@endfor



</table>
    </body>
</html>