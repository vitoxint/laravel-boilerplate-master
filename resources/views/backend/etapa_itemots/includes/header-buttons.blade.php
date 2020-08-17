<div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">

    <a href="{{ route('admin.etapa_itemots.create',$item_ot ,$trabajo) }}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
 
    @can('administrar ordenes de trabajo')
    <a href="{{ route('admin.etapa_itemots.exportarxls') }}" class="btn  ml-1" style="background-color:#006400; color:white;" data-toggle="tooltip" title="Exportar Excel"><i class="fas fa-file-excel"></i> Exportar</a>
    @endcan
</div><!--btn-toolbar-->
