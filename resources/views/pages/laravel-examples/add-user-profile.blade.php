<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="user-profile"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
       
        <div class="container-fluid px-0 px-md-0">
          
            <div class="card card-body mx-3 mx-md-4 mt-n0">
              
                <div class="card card-plain h-100">
                   
                    <div class="card-body p-3">
                        
                   
                             
                       
                        <form method='POST' action="events/create">
                            @csrf
                            <div class="row">
                                
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="search" class="form-control border border-2 p-2" value=''>
                                    @error('email')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                                </div>
                                
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Slug</label>
                                    <input type="text" name="slug" class="form-control border border-2 p-2" value=''>
                                    @error('name')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                                </div>
                               
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Start Date</label>
                                    <input type="datetime-local"  name="startAt" class="form-control border border-2 p-2" value=''>
                                    @error('phone')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">End Date</label>
                                    <input type="datetime-local"  name="endAt" class="form-control border border-2 p-2" value=''>
                                    @error('location')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                
                                
                            </div>
                            <button type="submit" class="btn bg-gradient-dark">Submit</button>
                           
                        </form>

                    </div>
                </div>
            </div>

        </div>
        <x-footers.auth></x-footers.auth>
    </div>
    <x-plugins></x-plugins>

</x-layout>
