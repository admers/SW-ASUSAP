<div class="card">
    <div class="card-header text-center">
    
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h3 class="display-2">SUMINISTROS CON CORTE</h3>
                
                <div class="form-group row">
                    <label for="btnBuscarSumCorte" class="col-sm-1 col-form-label"><i class="zmdi zmdi-search zmdi-hc-2x pull-left"></i></label>
                    <div class="col-sm-11">
                        <input type="search" id="btnBuscarSumCorte" class="form-control" placeholder="BUSCAR SUMINISTRO POR CÓDIGO-DNI">
                    </div>
                </div> 
                
            </div>
        </div>        

    </div>
    <div class="card-body">        
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Suministro</th>
                        <th scope="col">Nombre Asociado</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Categoría</th>
                        <th scope="col" class="text-center">Deudas Acum.</th>
                        <th scope="col" class="text-center">CONDICIÓN</th>
                    </tr>
                </thead>
                <tbody id="tblSumCorte">
                <!--
<tr>
    <th scope="row">1</th>
    <td>kevin</td>
    <td>Quispe lima</td>
    <td>Andahuaylas - perú</td>
    <td class="" >                            
        
        <button type="button" class="btn btn-danger">
            En corte
        </button>                     
    </td>
    <td>
        <a href="#" class="btn btn-success btn-raised btn-md">Restaurar</a>
    </td>
</tr>
-->
                </tbody>
            </table>
        </div> 
    </div>

    <div class="card-footer text-muted">

        <nav aria-label="..." class="card-body">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item active" aria-current="page">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>

</div>
<hr>

