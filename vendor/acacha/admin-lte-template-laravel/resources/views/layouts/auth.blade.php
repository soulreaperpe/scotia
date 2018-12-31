<!DOCTYPE html>
<html>

@include('adminlte::layouts.partials.htmlheader')

@yield('content')
	<div class="modal fade" id="myModalLg" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" type="button">
                        ×
                    </button>
                    <h4 class="modal-title" id="tituloModalLg">
                    </h4>
                </div>
                <div class="modal-body" id="contentModalLg">
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="myModalMd" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" type="button">
                        ×
                    </button>
                    <h4 class="modal-title" id="tituloModalMd">
                    </h4>
                </div>
                <div class="modal-body" id="contentModalMd">
                </div>
            </div>
        </div>
    </div>


</html>