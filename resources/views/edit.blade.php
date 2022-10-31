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
        <form action="/editdata" method="get" role="form text-left" enctype="multipart/form-data">
            <input class="form-control"  type="hidden" placeholder="Search" id="user-name" name="id" value={{$result[0]->id}}>
        <input class="form-control"  type="text" placeholder="Search" id="user-name" name="name" value={{$result[0]->name}}>
        
        <input class="form-control"  type="date" placeholder="Search" id="user-name" name="datestart">
        <input class="form-control"  type="date" placeholder="Search" id="user-name" name="dateend">
            <button type="submit" >{{ 'edit' }}</button>
        
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





</table>
    </body>
</html>