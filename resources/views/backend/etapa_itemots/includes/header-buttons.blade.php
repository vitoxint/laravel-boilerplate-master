<div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">

    
 
    @can('administrar ordenes de trabajo')
    <a href="{{ route('admin.etapa_itemots.exportarxls') }}" class="btn  ml-1" style="background-color:#006400; color:white;" data-toggle="tooltip" title="Exportar Excel"><i class="fas fa-file-excel"></i> Exportar</a>
    @endcan
</div><!--btn-toolbar-->
