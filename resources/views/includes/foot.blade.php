<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
   
    <div class="footer">
        {{-- <div class="container-fluid">
            <div class="row">
               
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    
                    <div class="table-responsive">
                        <table align="center" width=80%>
                            <tr>
                                <td><a href="#"> <img src="{{ asset('images/logo/footer/cr.png') }}" width="37%"></a></td>
                                <td><a href="#"> <img src="{{ asset('images/logo/footer/ddpm.png') }}" width="35%"></a></td>
                                <td><a href="#"> <img src="{{ asset('images/logo/footer/cmu.png') }}" width="45%"></a></td>
                                <td> <a href="#"> <img src="{{ asset('images/logo/footer/cendim.jpg') }}" width="45%"></a></td>
                                <td><a href="https://www.landslide-chiangrai.net/"> <img src="{{ asset('images/logo/footer/landslide1.jpg') }}" width="37%"></a></td>
                            </tr>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div> --}}


        <div class="card-header">
            
                <div class="row justify-content-md-center" align="center">
                    <div class="col-md-2" style="margin-top: 10px;">
                        <a href="http://www.chiangrai.net/cpwp/"> <img src="{{ asset('images/logo/footer/cr.png') }}" width="37%"></a>
                    </div>
                    <div class="col-md-2"style="margin-top: 10px;">
                       <a href="https://dpmcr.wordpress.com/"> <img src="{{ asset('images/logo/footer/ddpm.png') }}" width="25%"></a>
                    </div>
                    <div class="col-md-2" >
                        <a href="https://eng.cmu.ac.th/"> <img src="{{ asset('images/logo/footer/cmu.png') }}" width="50%"></a>
                    </div>
                    <div class="col-md-2" style="margin-top: 10px;">
                       <a href="https://cendim.eng.cmu.ac.th/">  <img src="{{ asset('images/logo/footer/cendim.jpg') }}" width="55%"></a>
                    </div>
                    <div class="col-md-2" style="margin-top: 10px;">
                       <a href="{{ asset('images/logo/qr.png') }}">  <img src="{{ asset('images/logo/qr.png') }}" width="25%"><br> Scan Me</a>
                    </div>
                </div>           

        </div>
    </div
  

</body>
</html>
