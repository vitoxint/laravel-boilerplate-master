
        

<div class="btn-group btn-group-sm" role="group" aria-label="@lang('labels.backend.access.users.user_actions')">
        <a href="{{ route('admin.item_ots.editTaller', [$item_ot , $trabajo]) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.view')">
            <i class="fas fa-search"></i>
        </a>
        <a href="{{ route('admin.item_ots.print_etq',[$item_ot , $trabajo]) }}" target="_blank" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Imprimir Etiqueta">
            <i class="fas fa-print" style="color:white;"></i>
        </a>
        <a href="{{ route('admin.orden_trabajos.printTaller',$trabajo) }}" target="_blank" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Imprimir OT Asociada">
            <i class="fas fa-file-pdf" style="color:red;"></i>
        </a>

<!--         <a href="{{ route('admin.item_ots.destroy', [$item_ot , $trabajo]) }}"
           data-method="delete"
           data-trans-button-cancel="@lang('buttons.general.cancel')"
           data-trans-button-confirm="@lang('buttons.general.crud.delete')"
           data-trans-title="@lang('strings.backend.general.are_you_sure')"
           class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.delete')">
           <i class="fas fa-trash"></i>
        </a> -->
 </div>